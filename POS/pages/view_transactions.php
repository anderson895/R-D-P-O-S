<?php
include('../config/config.php');
include('../functions/session.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

// Execute the SQL query to retrieve all records
$table_sql = "
SELECT
    t.orders_prodQty,
    p.prod_currprice,
    p.prod_name,
    p.prod_id
FROM
    pos_orders AS t
JOIN
    product AS p
ON
    t.orders_prod_id = p.prod_id
WHERE
    t.orders_tcode = '$id' AND return_availability='0'; 
";

$result = $conn->query($table_sql);

if ($result->num_rows > 0) {
    $tbody = '';
    $tbodyModal = '';
    $rows = [];

    // Fetch all rows and store them in an array
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }

    // Loop through the array for the first while loop
    foreach ($rows as $row) {
        $tbody .= '
        <tr>
        
        <td class="pt-1">' . (strlen($row["prod_name"]) > 20 ? substr($row["prod_name"], 0, 20) . '...' : $row["prod_name"]) . '</td>
        <td class="text-end pt-1"> ₱' . $row["prod_currprice"] . '</td>
        <td class="text-end pt-1">' . $row["orders_prodQty"] . '</td>
        <td></td>
      </tr>';
    }

    // Loop through the array for the second while loop
    foreach ($rows as $row) {
        $maxQty = $row["orders_prodQty"];
        $prod_id = $row["prod_id"];
        $prod_name = (strlen($row["prod_name"]) > 20) ? substr($row["prod_name"], 0, 20) . '...' : $row["prod_name"];
        $prod_currprice = $row["prod_currprice"];
        $orders_prodQty = $row["orders_prodQty"];
        $tbodyModal .= '
        <tr>
            <td><input class="checked_checkbox" type="checkbox" name="itemReturn" data-prod_id="' . $prod_id . '"></td>
            <td class="text-end pt-1"> <input class="form-control text-center quantityInput" type="number" value="' . $maxQty . '" max="' . $maxQty . '" min="1" data-prod_id="' . $prod_id . '"></td>
            <td class="pt-1">' . $prod_name . '</td>
            <td class="text-end pt-1">₱' . $prod_currprice . ' <input hidden type="text" value="' . $prod_currprice . '" class="currPrice"></td>
            <td class="text-end pt-1">' . $orders_prodQty . '</td>
            <td></td>
        </tr>';
    }
    
} else {
    echo "No results found.";
}



    // Execute the SQL query
    $sql = "
    SELECT
    t.orders_barcode,
    SUM(t.orders_prodQty * orders_prod_price) Allsubtotal,
        CONCAT(
            t.orders_date, ',',
            t.orders_subtotal, ',',
            t.orders_discount, ', ',
            t.orders_tax, ', ',
            t.orders_final, ', ',
            t.orders_payment, ', ',
            t.orders_change, ', ',
             CONCAT(a.acc_fname, ' ', a.acc_lname)
        ) AS transaction_info
    FROM
        pos_orders AS t
    JOIN
        product AS p
    ON
        t.orders_prod_id = p.prod_id
    JOIN
        account AS a
    ON
        t.orders_user_id = a.acc_id
    WHERE
        t.orders_tcode = '$id';
    ";

    $result = $conn->query($sql);
    
    // Check if there are results
    if ($result->num_rows > 0) {
        
        
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            $db_order_barcode = $row["orders_barcode"];
            $Allsubtotal = $row["Allsubtotal"];
            $data = $row["transaction_info"];
        }
        
        $dataArray = explode(",", $data);

        if (count($dataArray) === 8) {
            list($date, $subtotal, $discount, $tax, $total, $payment, $change, $cashier) = $dataArray;
            
        } else {
            echo "The input data does not contain exactly six values separated by commas.";
        }

    } else {
        echo "No results found.";
    }
} else {
    header("location: pos");
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
                    <td>Transaction Code <input hidden type="text" value="<?=$id?>" id='transactionCode'></td>
                    <td class="right"><?php echo $id?></td>
                </tr>
                <tr>
                    <td>Date <input hidden type="text" value="<?=$date?>" id='datePurchase'></td>
                    <td class="right"><?= date("Y F j H:i A", strtotime($date)) ?></td>


                </tr>
                <tr>
                    <td>Cashier Name</td>
                    <td class="right"><?php echo $cashier?></td>
                </tr>
                <tr>
                    <td>Payment</td>
                    <td class="right">₱<?php echo $payment?></td>
                </tr>
                <tr>
                    <td>Change</td>
                    <td class="right">₱<?php echo $change?></td>
                </tr>
            </table>
            </div>
            <div class="container mt-3 border rounded py-2" >
                <div style="overflow: auto; height: 250px;">
            <table class="table" style="width: 100%; ">
            <thead>
                <th>Product</th>
                <th class="text-end">Price</th>
                <th class="text-end">Qty</th>
                <th class="text-end"></th>
            </thead>
                <div >
                <?php echo $tbody?>
                </div>
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
                    <td class="right">₱<?php echo $Allsubtotal?></td>
                </tr>
                <tr>
                    <td>Discount</td>
                    <td class="right">₱<?php echo $discount?></td>
                </tr>
                <tr class="border-bottom">
                    <td>VAT </td>
                    <td class="right">₱<?php echo $tax?></td>
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
                $query = "SELECT orders_status FROM pos_orders WHERE orders_tcode = ?";
                
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
                        <?php echo $tbodyModal?>
                        
                        </div>
                    </table>
                    </div>
                    
        </div>


        <label for="reason">Reason</label>
        <select class="form-select mb-3" aria-label="Default select example" id="reason">
            <option  value="" selected>Select reason</option>
            <option value="expired">Expired</option>
            <option value="defective">Defective</option>
            <option value="wrongProd">Wrong product</option>
        </select>


        <label for="returnType">Return type</label>
        <select class="form-select mb-3" aria-label="Default select example" id="returnType">
            <option  value="" selected>Select Type Request</option>
            <option value="replace">Replace</option>
            <!-- You can add more options here if needed -->
        </select>

                
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
<script>
    $(document).ready(function() {
        const $checkAllBox = $('#checkAll');
        const $checkboxes = $('.checked_checkbox');
        const $quantityInputs = $('.quantityInput');
        const $returnButton = $('#returnButton');
        const $reason = $('#reason');
        const $returnType = $('#returnType');

        // Clear localStorage (ensure this is intended)
        localStorage.clear();

        $checkAllBox.on('change', handleCheckAllChange);
        $checkboxes.on('change', handleCheckboxChange);
        $quantityInputs.on('input', handleQuantityChange);
        $reason.on('change', updateButtonState); // Added event listener
        $returnType.on('change', updateButtonState); // Added event listener

        function handleCheckAllChange(event) {
            const isChecked = $(event.target).is(':checked');
            $checkboxes.each(function() {
                $(this).prop('checked', isChecked);
                const prodId = $(this).data('prod_id');
                const $quantityInput = $(`.quantityInput[data-prod_id="${prodId}"]`);
                const prodName = $(this).closest('tr').find('td:nth-child(3)').text().trim();
                const quantity = $quantityInput.val();

                if (isChecked) {
                    addToLocalStorage(prodId, prodName, quantity);
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

            if ($checkbox.is(':checked')) {
                addToLocalStorage(prodId, prodName, quantity);
            } else {
                removeFromLocalStorage(prodId);
            }

            // Uncheck the "Select All" checkbox if any individual checkbox is unchecked
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

        function addToLocalStorage(prodId, prodName, quantity) {
            const items = JSON.parse(localStorage.getItem('selectedItems')) || {};
            items[prodId] = { prodName, quantity };
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
            const hasReason = $reason.val() !== '';
            const hasReturnType = $returnType.val() !== '';

            if (hasSelectedItems && hasReason && hasReturnType) {
                $returnButton.prop('disabled', false);
            } else {
                $returnButton.prop('disabled', true);
            }
            console.log('Selected Items:', items); // Log items every time the button state is updated
        }

        // Initial check to set the correct button state when the page loads
        updateButtonState();

        $returnButton.on('click', function() {
            $('#clabel').hide();
            $('#cloader').show();

            // Ensure rcode is properly handled as a JSON object
            const rcode = <?php echo json_encode($id); ?>; // PHP variable encoded as JSON
            const rreason = $reason.val(); // Fixed to .val()
            const rtype = $returnType.val(); // Fixed to .val()

            // Prepare the data to send in the POST request
            const postData = {
                rcode: rcode,
                rreason: rreason,
                rtype: rtype,
                selectedItems: JSON.parse(localStorage.getItem('selectedItems')) || {}
            };

            // Make the POST request
            setTimeout(function() {
                $.ajax({
                    url: '../functions/insert_return.php', // Replace with your server endpoint URL
                    type: 'POST',
                    data: postData,
                    success: function(response) {
                        console.log('Success:', response);
                        $('#clabel').show();
                        $('#cloader').hide();
                        setTimeout(function () {
                            // Reload the current page
                            window.location.reload();
                        }, 2000)
                    },
                    error: function(xhr, status, error) {
                        console.log('Error:', error);
                        $('#cloader').hide();
                        $('#clabel').show();
                        setTimeout(function () {
                            // Reload the current page
                            window.location.reload();
                        }, 2000)
                    }
                });
            }, 3000); // Delay in milliseconds (3000 ms = 3 seconds)


                // console.log(rcode);
                // console.log(rreason);
                // console.log(rtype);
                // console.log('Selected Items:', postData.selectedItems);
            });

    });
</script>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

