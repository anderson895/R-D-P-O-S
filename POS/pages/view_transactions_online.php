<?php
include('../config/config.php');
include('../functions/session.php');

try {
    // Sanitize and retrieve the ID from GET request
    $id = $_GET['id'] ?? '';
    
    // Prepare your query using prepared statements to prevent SQL injection
    
    $query = "
    SELECT
        o.order_id,	
        o.cust_id,	
        o.payment_id,	
        o.pof,	
        o.subtotal,	
        o.vat,	
        o.sf,	
        o.total,	
        o.order_date,	
        o.delivered_date,	
        o.rider_id,	
        o.status,	
        o.reject_reason,	
        o.proof_of_del,
        CONCAT(c.acc_fname, ' ', c.acc_lname) as cname,
        CONCAT(r.acc_fname, ' ', r.acc_lname) as rname
    FROM 
        new_tbl_orders as o
    JOIN 
        account as c ON c.acc_id = o.cust_id
    JOIN 
        account as r ON r.acc_id = o.rider_id
    WHERE  
        o.order_id = ?;
    ";
    // Prepare statement
    $stmt = $conn->prepare($query);
    
    // Bind parameters
    $stmt->bind_param('s', $id);
    
    // Execute query
    $stmt->execute();
    
    // Get result
    $result = $stmt->get_result();
    
    // Check if query executed successfully
    if ($result->num_rows > 0) {
        // Fetch result as associative array
        $row = $result->fetch_assoc();
        
        // Extract the associative array into variables
        extract($row);
        
    } else {
        echo "No rows found.";
    }

    $query = "
    SELECT             
        i.product_id,	
        i.qty,	
        p.prod_code,	
        p.prod_name,	
        p.prod_currprice
    FROM 
        new_tbl_order_items as i
    JOIN 
        product as p ON p.prod_id = i.product_id
    WHERE  
        i.order_id = ?;
    ";
    // Prepare statement
    $stmt = $conn->prepare($query);
    
    // Bind parameters
    $stmt->bind_param('s', $id);
    
    // Execute query
    $stmt->execute();
    
    // Get result
    $result = $stmt->get_result();
    
    // Check if query executed successfully
    if ($result->num_rows > 0) {
        // Fetch result as associative array
        $row = $result->fetch_assoc();
        
        // Extract the associative array into variables
        extract($row);
        
    } else {
        echo "No rows found.";
    }
    
    // Close statement
    $stmt->close();

    // Second query to fetch order items
    $query2 = "
    SELECT             
        i.product_id,    
        i.qty,    
        p.prod_code,    
        p.prod_name,    
        p.prod_currprice
    FROM 
        new_tbl_order_items as i
    JOIN 
        product as p ON p.prod_id = i.product_id
    WHERE  
        i.order_id = ?;
    ";

    // Prepare and execute the second query
    $stmt2 = $conn->prepare($query2);
    if (!$stmt2) {
        throw new Exception("Query preparation failed: " . $conn->error);
    }
    $stmt2->bind_param('s', $id);
    $stmt2->execute();
    $result2 = $stmt2->get_result();

    if ($result2->num_rows > 0) {
        $orderItems = [];
        while ($item = $result2->fetch_assoc()) {
            $orderItems[] = $item;
        }
    } else {
        throw new Exception("No items found for the given order ID.");
    }

    // Close the second statement
    $stmt2->close();

    // Output the fetched data (for debugging or further processing)
    // echo "Order Details: <pre>" . print_r($orderDetails, true) . "</pre>";
    // echo "Order Items: <pre>" . print_r($orderItems, true) . "</pre>";
} catch(Exception $e) {
    echo "Error: " . $e->getMessage();
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Transaction</title>
    <link rel="icon" href="../assets/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/inventory.css">


    <link rel="stylesheet" href="../../administrator/admin_view/assets/plugins/scrollbar/scroll.min.css">
    <link rel="stylesheet" href="../../administrator/admin_view/assets/plugins/alertify/alertify.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
    .right{
        text-align: end;
    }
    </style>
</head>
<body >

<?php include ('../includes/navigation.php');?>



<div class="container ">
    <div class="row ">
        
        <div class="col-12 col-md-7 mt-3">
            <div class="border rounded p-4 shadow">
            <h5 class="fw-bold">Transaction Details</h5>
            <div class="container border rounded py-2" >
            <table id="productTable" style="width: 100%;">
                <tr>
                    <td>Transaction Code</td>
                    <td class="right"><?php echo $id?></td>
                </tr>
                <tr>
                    <td>Order Date</td>
                    <td class="right"><?php  echo $order_date?></td>


                </tr>
                <tr>
                    <td>Delivered Date</td>
                    <td class="right"><?php  echo $delivered_date?></td>


                </tr>
                <tr>
                    <td>Customer Name</td>
                    <td class="right"><?php echo $cname?></td>
                </tr>
                <tr>
                    <td>Payment</td>
                    <td class="right"><?php echo $payment_id?></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td class="right"><?php echo $status?></td>
                </tr>
            </table>
            </div>
            <div class="container mt-3 border rounded py-2" >
                <div style="overflow: auto; height: 250px;">
                <table class="table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th class="text-end">Qty</th>
                            <th class="text-end">Product Code</th>
                            <th class="text-end">Product Name</th>
                            <th class="text-end">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            foreach ($orderItems as $item) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($item['product_id']) . "</td>";
                                echo "<td class='text-end'>" . htmlspecialchars($item['qty']) . "</td>";
                                echo "<td class='text-end'>" . htmlspecialchars($item['prod_code']) . "</td>";
                                echo "<td class='text-end'>" . htmlspecialchars($item['prod_name']) . "</td>";
                                echo "<td class='text-end'>" . htmlspecialchars($item['prod_currprice']) . "</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>

            </div>
            </div>
            </div>
            
        </div>

        <div class="col-12 col-md-5 mt-3">
            
            <div class="border rounded p-4 shadow">
            <h5 class="fw-bold">Purchased Summary</h5>
            <div class="container border rounded py-2">
            <table style="width: 100%;">
                <tr>
                    <td>Subtotal</td>
                    <td class="right">₱<?php echo $subtotal?></td>
                </tr>
                <tr>
                    <td>Shippimg Fee</td>
                    <td class="right">₱<?php echo $sf?></td>
                </tr>
                <tr class="border-bottom">
                    <td>VAT </td>
                    <td class="right">₱<?php echo $vat?></td>
                </tr>
                <tr >
                    <td class="fw-bold fs-3">₱TOTAL</td>
                    <td class="right fs-3 fw-bold">₱<?php echo $total?></td>
                </tr>
            </table>
            </div>
            <?php
                // Assuming you have an existing database connection in $conn
                $id = $_GET['id']; // Or however you are getting the $id value
                $query = "SELECT t_status FROM new_tbl_orders WHERE order_id = ?";
                
                if ($stmt = $conn->prepare($query)) {
                    $stmt->bind_param("s", $id);
                    $stmt->execute();
                    $stmt->bind_result($button_status);
                    $stmt->fetch();
                    $stmt->close();

                    if ($button_status == 0) {
                        echo '<button class="btn mt-3 w-100 btn-primary " data-bs-toggle="modal" data-bs-target="#return">Return</button>';
                    } elseif ($button_status == 1) {
                        echo '<button disabled class="btn mt-3 w-100 btn-primary " data-bs-toggle="modal" data-bs-target="#return">Return</button>';
                    } else {
                        echo '<button>Error</button>';
                    }
                } else {
                    echo "Error preparing statement: " . $conn->error;
                }
            ?>
            <button class="btn mt-3 w-100 text-primary border-primary ">Print As Document</button>
            <button class="btn mt-3 w-100 text-primary border-primary">Print As Reciept</button>
            


            </div>
        </div>

        
    </div>
</div>







<!-- Modal -->
<div class="modal fade mt-4" id="return" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Select Product to Return</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="container mb-3 border rounded py-2" >
                        <div style="overflow: auto; height: 250px;">
                    <table class="table" style="width: 100%; ">
                    <thead>
                        <td class="text-secondary"><input id="checkAll" type="checkbox" ></td>
                        <th>Return Quantity</th>
                        <th>Product</th>
                        <th class="text-end">Price</th>
                        <th class="text-end">Qty</th>
                        <th class="text-end"></th>
                    </thead>
                        <div >
                        <?php
                        foreach ($orderItems as $item) {
                            echo '<tr>
                                    <td><input class="checked_checkbox" type="checkbox" name="itemReturn" data-prod_id="' . htmlspecialchars($item['product_id']) . '"></td>
                                    <td class="text-end pt-1"> <input class="form-control text-center quantityInput" type="number" value="' . htmlspecialchars($item['qty']) . '" max="' . htmlspecialchars($item['qty']) . '" min="1" data-prod_id="' . htmlspecialchars($item['product_id']) . '"></td>
                                    <td class="pt-1">' . htmlspecialchars($item['prod_name']) . '</td>
                                    <td class="text-end pt-1">₱' . htmlspecialchars($item['prod_currprice']) . ' <input hidden type="text" value="' . htmlspecialchars($item['prod_currprice']) . '" class="currPrice"></td>
                                    <td class="text-end pt-1">' . htmlspecialchars($item['qty']) . '</td>
                                    <td></td>
                                </tr>';
                        }
                        ?>

                        
                        
                        </div>
                    </table>
                    </div>
                    
        </div>

        <div class="row g-2">
            <div class="col-12 col-md-6">
                <label for="reason">Reason</label>
                <select class="form-select mb-3" aria-label="Default select example" id="reason">
                    <option  value="" selected>Select reason</option>
                    <option value="Expired">Expired</option>
                    <option value="Defective">Defective</option>
                    <option value="Wrong Product">Wrong Product</option>
                </select>


                <label for="returnType">Return type</label>
                <select class="form-select mb-3" aria-label="Default select example" id="returnType">
                    <option  value="" selected>Select Type Request</option>
                    <option value="Replace">Replace</option>
                    <!-- You can add more options here if needed -->
                </select>
            </div>
            <div class="col-12 col-md-6">
                <label for="customer">Customer Name</label>
                <input type="text" id="rcustomer" class="form-control mb-3" placeholder="Enter Customer Name">


                <label for="returnType">Upload Verification</label>
                <div class="mb-3">
                    <input class="form-control" type="file" id="rupload">
                </div>
            </div>
        </div>
      <div class="modal-footer">

        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <div id="loadingSpinner"></div>
        <button style="display:block;" id="returnButton" disabled type="button" class="btn w-25 btn-primary">
            <p id="clabel" class="m-0 p-0">Confirm</p>
            <div id="cloader" style="display: none" class="spinner-grow spinner-grow-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </button>
      </div>
    </div>
  </div>
</div>


<script src="../../administrator/admin_view/assets/plugins/alertify/alertify.min.js"></script>
<script src="../../administrator/admin_view/assets/js/jquery.slimscroll.min.js"></script>
<script src="../assets/js/alert_js_fyke.js"></script>
<script>
    $(document).ready(function() {
        const $checkAllBox = $('#checkAll');
        const $checkboxes = $('.checked_checkbox');
        const $quantityInputs = $('.quantityInput');
        const $returnButton = $('#returnButton');
        const $reason = $('#reason');
        const $returnType = $('#returnType');
        const $customer = $('#rcustomer');
        const $upload = $('#rupload');

        // Set the accept attribute to restrict file types
        $upload.attr('accept', 'image/jpeg, image/png');

        // Clear localStorage (ensure this is intended)
        localStorage.clear();

        // Event listeners
        $checkAllBox.on('change', handleCheckAllChange);
        $checkboxes.on('change', handleCheckboxChange);
        $quantityInputs.on('input', handleQuantityChange);
        $reason.on('change input', updateButtonState);
        $returnType.on('change input', updateButtonState);
        $customer.on('change input', updateButtonState);
        $upload.on('change input', updateButtonState);

        function handleCheckAllChange(event) {
            const isChecked = $(event.target).is(':checked');
            $checkboxes.each(function() {
                $(this).prop('checked', isChecked);
                const prodId = $(this).data('prod_id');
                const $quantityInput = $(`.quantityInput[data-prod_id="${prodId}"]`);
                const prodName = $(this).closest('tr').find('td:nth-child(3)').text().trim();
                const quantity = $quantityInput.val();
                const priceString = $(this).closest('tr').find('td:nth-child(4)').text().trim();

                if (isChecked) {
                    addToLocalStorage(prodId, prodName, quantity, priceString);
                } else {
                    removeFromLocalStorage(prodId);
                }
            });
            updateButtonState();
        }

        function handleCheckboxChange(event) {
            const $checkbox = $(event.target);
            const prodId = $checkbox.data('prod_id');
            const $quantityInput = $(`.quantityInput[data-prod_id="${prodId}"]`);
            const prodName = $checkbox.closest('tr').find('td:nth-child(3)').text().trim();
            const quantity = $quantityInput.val();
            const priceString = $checkbox.closest('tr').find('td:nth-child(4)').text().trim();

            if ($checkbox.is(':checked')) {
                addToLocalStorage(prodId, prodName, quantity, priceString);
            } else {
                removeFromLocalStorage(prodId);
            }

            if (!$checkbox.is(':checked')) {
                $checkAllBox.prop('checked', false);
            }

            updateButtonState();
        }

        function handleQuantityChange(event) {
            const $input = $(event.target);
            const prodId = $input.data('prod_id');
            const maxQty = parseInt($input.attr('max'), 10);

            if (parseInt($input.val(), 10) > maxQty) {
                $input.val(maxQty);
            }

            const $checkbox = $(`.checked_checkbox[data-prod_id="${prodId}"]`);
            if ($checkbox.is(':checked')) {
                updateLocalStorage(prodId, $input.val());
            }

            updateButtonState();
        }

        function addToLocalStorage(prodId, prodName, quantity, priceString) {
            const price = parseFloat(priceString.replace('₱', '').trim());
            const items = JSON.parse(localStorage.getItem('selectedItems')) || {};
            items[prodId] = { prodName, quantity, price };
            localStorage.setItem('selectedItems', JSON.stringify(items));
        }

        function removeFromLocalStorage(prodId) {
            const items = JSON.parse(localStorage.getItem('selectedItems')) || {};
            delete items[prodId];
            localStorage.setItem('selectedItems', JSON.stringify(items));
        }

        function updateLocalStorage(prodId, quantity) {
            const items = JSON.parse(localStorage.getItem('selectedItems')) || {};
            if (items[prodId]) {
                items[prodId].quantity = quantity;
                localStorage.setItem('selectedItems', JSON.stringify(items));
            }
        }

        function updateButtonState() {
            const items = JSON.parse(localStorage.getItem('selectedItems')) || {};
            const hasSelectedItems = Object.keys(items).length > 0;
            const hasReason = $reason.val().trim() !== '';
            const hasReturnType = $returnType.val().trim() !== '';
            const hasCustomer = $customer.val().trim() !== '';
            const hasUpload = $upload.val() !== '';
            const isUploadValid = validateUploadFile($upload[0]);

            if (hasSelectedItems && hasReason && hasReturnType && hasCustomer && hasUpload && isUploadValid) {
                $returnButton.prop('disabled', false);
            } else {
                $returnButton.prop('disabled', true);
            }

            console.log('Selected Items:', items); // Log items every time the button state is updated
        }

        function validateUploadFile(fileInput) {
            const file = fileInput.files[0];
            if (!file) {
                return false;
            }
            const fileType = file.type;
            return fileType === 'image/jpeg' || fileType === 'image/png';
        }

        // Initial check to set the correct button state when the page loads
        updateButtonState();

        
        $returnButton.on('click', function() {
                $('#clabel').hide();
                $('#cloader').show();
                $returnButton.prop('disabled', true);

                const rcode = <?php echo json_encode($id); ?>;
                const rreason = $reason.val();
                const rtype = $returnType.val();
                const rcustomer = $customer.val().trim();
                const rupload = $upload[0].files[0];

                // Check if all necessary fields are filled
                if (rcustomer === '' || !rupload || !validateUploadFile($upload[0])) {
                    $('#clabel').show();
                    $('#cloader').hide();
                    showAlert('Please fill in all required fields with valid inputs', 'warning');
                    $returnButton.prop('disabled', false);
                    return;
                }

                var formData = new FormData();
                formData.append('rcode', rcode);
                formData.append('rreason', rreason);
                formData.append('rtype', rtype);
                formData.append('rcustomer', rcustomer);
                formData.append('rupload', rupload);

                // Retrieve and format selectedItems
                var selectedItems = localStorage.getItem('selectedItems');
                if (selectedItems) {
                    selectedItems = JSON.parse(selectedItems); // Parse the JSON string
                } else {
                    selectedItems = {}; // Default to an empty object if no items are selected
                }
                formData.append('selectedItems', JSON.stringify(selectedItems)); // Convert back to JSON string

                setTimeout(function() {
                    $.ajax({
                        url: '../functions/insert_online_return_fyke.php',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            console.log('Success:', response);
                            $('#clabel').show();
                            $('#cloader').hide();
                            console.log(rupload);
                            showAlert('Return Success', 'success');
                            setTimeout(function() {
                                window.location.reload();
                                $returnButton.prop('disabled', false);
                            }, 2000);
                        },
                        error: function(xhr, status, error) {
                            console.log('Error:', error);
                            $('#cloader').hide();
                            $('#clabel').show();
                            showAlert('Internal Server Error', 'danger');
                            setTimeout(function() {
                                $returnButton.prop('disabled', false);
                                window.location.reload();
                            }, 2000);
                        }
                    });
                }, 3000);
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

