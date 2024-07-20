<?php
include '../connection.php';
session_start();

if(!isset($_SESSION['acc_id'])) {
    header("Location: login.php");
    exit();
}

// cashier id
$acc_id= $_SESSION['acc_id'];
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/CSS/pos.css">
    <link rel="icon" href="../assets/images/logos.png" type="image/x-icon">
    <title>RDPOS-Pos</title>
    <style>
    /* Style for the suggestions container */


.suggest-container {
    position: fixed; /* Fixed position */
    z-index: 9999; /* Higher z-index to display in front */
    width: 100%;
    max-height: 500px; /* Limit the suggestions list height */
    margin: 0px 25px;
    border-radius: 4px;
    overflow-y: auto; /* Enable vertical scrolling if needed */
    font-size: 12px;
    display: hide;
}




/* Style for each suggestion item */
.suggestion {
    padding: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.suggestion.hovered {
    background-color: #f0f0f0;
}


    </style>
</head>
<body>
    
<?php include 'navigation.php';?>
    <div class="main-screen">
        <div class="validation-compatibility">
                    <p class="message">This system isn't compatible with mobile view</p>
        </div>
        <div class="tables color-gray">
            <div class="container" style="margin-top: 20px;">
                <h1 class="color-gray">Product Listing </h1>
            </div>
            <div class="category">
                <form action="pos.php" class="form"  method="GET" style="border: none; margin: 0px -px;">
                <input required id="search" type="text" style="margin-right: -15px;" class="button-rounded search" name="query" id="searchInput" 
                    <?php 
                    if (isset($_GET['query'])) {
                    echo 'placeholder="' . htmlspecialchars($_GET['query']) . '" value="' . htmlspecialchars($_GET['query']) . '"';
                    } else {
                    echo 'placeholder="Search"';
                    }
                    ?> 
                >
               </form>
               

                <?php
                $category = "SELECT * FROM `category`";
                $categoryResult = $conn->query($category);
                echo '<a href="pos.php" class="button-rounded">All</a>';
                // Display category buttons
                while ($row = $categoryResult->fetch_assoc()) {
                    echo '<a href="?category=' . urlencode($row["category_id"]) . '" class="button-rounded">' . $row["category_name"] . '</a>';
                }
                ?>
            </div class="category">

            <div class="suggest-container">
                <div id="suggestions"></div>
                <div id="productDetails"></div>
            </div>
            <?php
                if (isset($_GET['query'])) {
                    // Sanitize and store the search query
                    $searchQuery = htmlspecialchars($_GET['query']);                                                                
                    echo '<div class="parent">'; // Opening div tag was missing
                    
                    $productSql = "SELECT product.prod_id, product.prod_name, product.prod_currprice, product.prod_image, SUM(stocks.s_amount) AS total_amount FROM product LEFT JOIN stocks ON product.prod_id = stocks.s_prod_id WHERE prod_status = 0  AND prod_name LIKE '%$searchQuery%' GROUP BY product.prod_id, product.prod_name, product.prod_currprice, product.prod_image";
                    
                    // Check if a category is selected for filtering
                    if (isset($_GET['category'])) {
                        $selectedCategory = $_GET['category'];
                        // Prevent SQL injection using prepared statements
                        $productSql = "SELECT product.prod_id, product.prod_name, product.prod_currprice, product.prod_image, SUM(stocks.s_amount) AS total_amount FROM product LEFT JOIN stocks ON product.prod_id = stocks.s_prod_id WHERE prod_status = 0 AND prod_name LIKE '%$searchQuery%' AND prod_category_id = ? GROUP BY product.prod_id, product.prod_name, product.prod_currprice, product.prod_image";
                        
                        // Prepare and bind the parameter
                        $stmt = $conn->prepare($productSql);
                        $stmt->bind_param("s", $selectedCategory);
                        $stmt->execute();
                        
                        $result = $stmt->get_result();
                    } else {
                        // No category selected, retrieve all products
                        $result = $conn->query($productSql);
                    }

                    // Loop through the result set and display products
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<div class="product">';
                                echo '<div class="image">';
                                
                                if (!empty($row['total_amount'])) {
                                    echo '<a href="#" class="a-class" data-product-id="' . $row["prod_id"] . '" data-product-name="' . $row["prod_name"] . '" data-product-price="' . $row["prod_currprice"] . '" data-product-stocks="' . $row["total_amount"] . '" onclick="openModal(event)">';
                                    if (!empty($row["prod_image"])) {
                                        echo '<img src="upload_prodImg/' . $row["prod_image"] . '" alt="Product">';
                                    } else {
                                        echo '<img src="upload_prodImg/no_available.jpg" alt="No Image">';
                                    }
                                    echo '</a>';
                                } else if (!empty($row["prod_image"])) {
                                    echo '<img src="upload_prodImg/' . $row["prod_image"] . '" alt="Product">';
                                } else {
                                    echo '<img src="upload_prodImg/no_available.jpg" alt="No Image">';
                                }
                                
                                echo '</div>';
                                echo '<div class="description">';
                                echo '<p>' . $row["prod_name"] . '</p>';
                                echo '<p>Price: ₱ ' . $row["prod_currprice"] . '</p>';
                                
                                if ($row["total_amount"] > 0) {
                                    echo '<p>Stocks: ' . $row["total_amount"] . '</p>';
                                } else {
                                    echo '<p>Out of stocks</p>';
                                }
                                
                                echo '</div>';
                                echo '</div>';
                            }
                        } else {
                            echo '<p style="margin-left: 15px;">No results found.</p>';
                        }
                    echo '</div>'; 
                } else {
                    echo '<div class="parent">'; // Opening div tag was missing
                    
                    $productSql = "SELECT product.prod_id, product.prod_name, product.prod_currprice, product.prod_image, SUM(stocks.s_amount) AS total_amount FROM product LEFT JOIN stocks ON product.prod_id = stocks.s_prod_id WHERE prod_status = 0 GROUP BY product.prod_id, product.prod_name, product.prod_currprice, product.prod_image;";
                    
                    // Check if a category is selected for filtering
                    if (isset($_GET['category'])) {
                        $selectedCategory = $_GET['category'];
                        // Prevent SQL injection using prepared statements
                        $productSql = "SELECT product.prod_id, product.prod_name, product.prod_currprice, product.prod_image, SUM(stocks.s_amount) AS total_amount FROM product LEFT JOIN stocks ON product.prod_id = stocks.s_prod_id WHERE prod_status = 0 AND prod_category_id = ? GROUP BY product.prod_id, product.prod_name, product.prod_currprice, product.prod_image";
                        
                        // Prepare and bind the parameter
                        $stmt = $conn->prepare($productSql);
                        $stmt->bind_param("s", $selectedCategory);
                        $stmt->execute();
                        
                        $result = $stmt->get_result();
                    } else {
                        // No category selected, retrieve all products
                        $result = $conn->query($productSql);
                    }

                    // Loop through the result set and display products
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="product">';
                        echo '<div class="image">';
                        
                        if (!empty($row['total_amount'])) {
                            echo '<a href="#" class="a-class" data-product-id="' . $row["prod_id"] . '" data-product-name="' . $row["prod_name"] . '" data-product-price="' . $row["prod_currprice"] . '" data-product-stocks="' . $row["total_amount"] . '" onclick="openModal(event)">';
                            if (!empty($row["prod_image"])) {
                                echo '<img src="upload_prodImg/' . $row["prod_image"] . '" alt="Product">';
                            } else {
                                echo '<img src="upload_prodImg/no_available.jpg" alt="No Image">';
                            }
                            echo '</a>';
                        } else if (!empty($row["prod_image"])) {
                            echo '<img src="upload_prodImg/' . $row["prod_image"] . '" alt="Product">';
                        } else {
                            echo '<img src="upload_prodImg/no_available.jpg" alt="No Image">';
                        }
                        
                        echo '</div>';
                        echo '<div class="description">';
                        echo '<p>' . $row["prod_name"] . '</p>';
                        echo '<p>Price: ₱ ' . $row["prod_currprice"] . '</p>';
                        
                        if ($row["total_amount"] > 0) {
                            echo '<p>Stocks: ' . $row["total_amount"] . '</p>';
                        } else {
                            echo '<p>Out of stocks</p>';
                        }
                        
                        echo '</div>';
                        echo '</div>';
                    }

                    echo '</div>'; 

                    // Close your database connection here
                }
            ?>

            
        </div>


        <div class="items color-gray ">
            <div class="container" style="margin-top: 20px;">
                <h1 class="color-gray">Cart List</h1>
            </div>

            <div class="div-table">
                <table class="table-cart">
                    <tr class="head-row">
                        <td width="30%">Item</td>
                        <td width="20%">Price</td>
                        <td width="25%">Oty</td>
                        <td width="20%" >Total</td>
                        <td width="5%">Action</td>
                    </tr>
                    
                    <?php
                        $query = "SELECT * FROM pos_cart INNER JOIN product ON pos_cart.pos_cart_prod_id = product.prod_id";
                        // Execute the query
                        $result = $conn->query($query);

                        $totalSum = 0; // Initialize total sum

                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while ($row = $result->fetch_assoc()) {
                                $subtotal = $row["prod_currprice"] * $row["cart_prodQty"];
                                $totalSum += $subtotal; // Accumulate subtotals for total sum
                                $string = $row["prod_name"];
                                $maxLength = 17;
                                if (strlen($string) > $maxLength) {
                                    $limitedString = substr($string, 0, $maxLength) . "...";
                                } else {
                                    $limitedString = $string;
                                }
                                $pos_cart_id = $row["pos_cart_id"]; // Add this line to fetch the cart ID
                                echo '
                                <tr>
                                    <td>
                                    '.$limitedString.'
                                    </td>
                                    <td><var class="price price'.$pos_cart_id.'">₱ '. number_format($row["prod_currprice"], 2, '.', ',').'</var></td>
                                    <td>
                                    <div class="m-btn-group m-btn-group--pill btn-group mr-2" role="group" aria-label="...">
                                        <button type="button" class="m-btn btn btn-default decrease" data-id="'.$pos_cart_id.'">-</button>
                                        <button type="button" class="m-btn btn btn-default quantity" data-id="'.$pos_cart_id.'" data-quantity="'. $row["cart_prodQty"] .'">'. $row["cart_prodQty"] .'</button>
                                        <button type="button" class="m-btn btn btn-default increase" data-id="'.$pos_cart_id.'">+</button>
                                    </div>
                                    </td>
                                    <td><var class="price price'.$pos_cart_id.' subtotal">₱ '. number_format($subtotal, 2, '.', ',').'</var></td>
                                    <td><form action="cashier_functions.php" method="POST"><input type="hidden" name="cart_id" value="'.$pos_cart_id.'"><button type="submit" name="btn_delete" class="delete"><img style="width: 25px;" alt="" src="../assets/images/icons8-delete-30.png"></button></form></td>
                                </tr>';
                            }
                        } else {
                            echo '<td colspan="5">Empty Cart</td>';
                        }
                    ?>

                        
                        
                </table>
            </div>
            
            <?php
                // SQL query to calculate the total cost
                $query = "SELECT SUM(product.prod_currprice * pos_cart.cart_prodQty) AS total_cost
                FROM pos_cart 
                INNER JOIN product ON pos_cart.pos_cart_prod_id = product.prod_id 
                WHERE pos_cart_user_id = '$acc_id'";

                $result = $conn->query($query);

                if ($result) {
                $row = $result->fetch_assoc();
                $total = $row['total_cost'];
                $totalCost = number_format($total, 2, '.', ',');

                } else {
                
                }
            ?>

        <div class="cartlist-bottom">
                    <div>
                        <select class="form-control discount" name="discount" id="discountSelect" onchange="updateDiscountId()">
                            <option value="0" disabled selected>DISCOUNT</option>
                            <?php 
                            $discount_query = mysqli_query($connections, "SELECT * FROM `discount` where discount_status='1'");
                            while ($d_row = mysqli_fetch_assoc($discount_query)) {
                                $db_discount_id = $d_row["discount_id"];
                                $db_discount_name = $d_row["discount_name"];
                                $db_discount_rate = $d_row["discount_rate"];
                            ?>
                            <option value="<?php echo $db_discount_rate ?>"><?php echo $db_discount_name ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div>
                        <table class="computation">
                            <tr>
                                <td class="description-left">Tax: </td>
                                <td class="description-right" id="taxValue">0.01</td>
                            </tr>
                            <tr>
                                <td class="description-left">Subtotal: </td>
                                <td class="description-right" id="subtotalValue">₱ 0.00</td>
                            </tr>
                            <tr>
                                <td class="description-left">Discount: </td>
                                <td class="description-right" id="discountValue">₱ 0.00</td>
                            </tr>
                            <tr>
                                <td class="description-left" style="font-size: 25px; color: rgb(59, 59, 59);"><b>TOTAL: </b></td>
                                <td class="description-right" style="font-size: 25px; color: rgb(59, 59, 59);"><b>₱ 0.00</b></td>
                            </tr>
                        </table>
                    </div>
                    <div class="purchase-buttons">
                        <div class="button-down1">
                            <button type="button" class="clear" onclick="clearCart()">CLEAR</button>
                        </div>
                        <div class="button-down2">
                            <button class="checkout" onclick="purchase()">PURCHASE</button>
                        </div>
                    </div>
                </div>
        </div>

        

    </div>
    
    

    <!-- Modal HTML structure -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div class="modal-header">
                <h2>View Product</h2>
            </div>
            <form action="cashier_functions.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="acc_id" value="<?php echo $acc_id?>">
                    <input type="hidden" name="prod_id" id="modal-product-id">
                    <label for="">Product Name: </label><label for="" id="modal-title"></label><br>
                    <label for="" id="modal-price">Price</label><br>
                    <label for="" id="modal-stocks">Stocks</label><br>
                </div>
                <div class="modal-bottom">
                    <input id="quantityInput" type="number" name="quantity" placeholder="Enter Quantity" oninput="validateInput()" required>
                    <button type="submit" name="add_to_cart">ADD</button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
    // JavaScript functions for modal
    function openModal(event) {
        event.preventDefault();
        const modal = document.getElementById("modal");
        const modalTitle = document.getElementById("modal-title");
        const modalPrice = document.getElementById("modal-price"); 
        const modalProductID = document.getElementById("modal-product-id");
        const modalStocks = document.getElementById("modal-stocks");  

        const productID = event.currentTarget.getAttribute("data-product-id");
        const productName = event.currentTarget.getAttribute("data-product-name");
        const productPrice = event.currentTarget.getAttribute("data-product-price");
        const productStocks = event.currentTarget.getAttribute("data-product-stocks");


        modalProductID.value = productID;
        modalTitle.textContent = productName;
        modalPrice.textContent = "Price: " + productPrice;
        modalStocks.textContent = "Stocks: " + productStocks;

        modal.style.display = "block";
    }

    function closeModal() {
        document.getElementById('modal').style.display = 'none';
        document.getElementById('quantityInput').value = ''; // Reset input quantity
    }

    function validateInput() {
            var input = document.getElementById('quantityInput');
            var value = parseFloat(input.value);

            if (isNaN(value) || value < 1) {
                input.setCustomValidity('Invalid Input');
            } else {
                input.setCustomValidity('');
            }
    }

    // Function to update the cart values when a quantity changes
function updateQuantityAndValues(cartItemId, newQuantity) {
    const itemSubtotalElement = document.querySelector('.price.price' + cartItemId + '.subtotal');
    const itemPriceElement = document.querySelector('.price.price' + cartItemId);
    const itemQuantityElement = document.querySelector('.quantity[data-id="' + cartItemId + '"]');
    
    const itemPrice = parseFloat(itemPriceElement.innerText.replace('₱', '').replace(',', ''));
    const newSubtotal = itemPrice * newQuantity;
    
    itemSubtotalElement.innerText = '₱ ' + newSubtotal.toFixed(2);
    itemQuantityElement.textContent = newQuantity;
    
    updateValues(); // Recalculate and update the total values
}

// Attach event listeners to the plus, minus, and quantity buttons
const decreaseButtons = document.querySelectorAll('.decrease');
const increaseButtons = document.querySelectorAll('.increase');
const quantityButtons = document.querySelectorAll('.quantity');

decreaseButtons.forEach(button => {
    button.addEventListener('click', () => {
        const cartItemId = button.getAttribute('data-id');
        const itemQuantityElement = document.querySelector('.quantity[data-id="' + cartItemId + '"]');
        
        let newQuantity = parseInt(itemQuantityElement.textContent) - 1;
        newQuantity = Math.max(newQuantity, 1); // Ensure quantity doesn't go below 1
        
        updateQuantityAndValues(cartItemId, newQuantity);
    });
});

increaseButtons.forEach(button => {
    button.addEventListener('click', () => {
        const cartItemId = button.getAttribute('data-id');
        const itemQuantityElement = document.querySelector('.quantity[data-id="' + cartItemId + '"]');
        
        const newQuantity = parseInt(itemQuantityElement.textContent) + 1;
        updateQuantityAndValues(cartItemId, newQuantity);
    });
});

quantityButtons.forEach(button => {
    button.addEventListener('click', () => {
        const cartItemId = button.getAttribute('data-id');
        const newQuantity = parseInt(button.getAttribute('data-quantity'));
        
        updateQuantityAndValues(cartItemId, newQuantity);
    });
});

         // JavaScript code to calculate and update values
    const discountSelect = document.getElementById('discountSelect');
    const taxValue = document.getElementById('taxValue');
    const subtotalValue = document.getElementById('subtotalValue');
    const discountValue = document.getElementById('discountValue');
    const totalValue = document.querySelector('.description-right b');

    // Function to update the cart values
    function updateValues() {
        const subtotals = document.querySelectorAll('.subtotal');
        let totalSum = 0;
        subtotals.forEach(subtotal => {
            totalSum += parseFloat(subtotal.innerText.replace('₱', '').replace(',', ''));
        });

        const selectedDiscount = parseFloat(discountSelect.value);
        const discountAmount = totalSum * (selectedDiscount / 100);
        const taxAmount = totalSum * parseFloat(taxValue.innerText);

        const finalTotal = totalSum - discountAmount + taxAmount;

        subtotalValue.innerText = '₱ ' + totalSum.toFixed(2);
        discountValue.innerText = '₱ ' + discountAmount.toFixed(2);
        totalValue.innerText = '₱ ' + finalTotal.toFixed(2);
    }

    // Attach event listener to the discount select element
    discountSelect.addEventListener('change', updateValues);

    // Initialize values
    updateValues();
    
    
    

</script>
<script src="../assets/javascript/search.js"></script>
</body>
</html>