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
    <link rel="stylesheet" href="../assets/CSS/transaction.css">
    <link rel="icon" href="../assets/images/logos.png" type="image/x-icon">
    <title>RDPOS-Transactions</title>
</head>
<body>
<?php include 'navigation.php'?>
    <div class="main-screen">
        <div class="transaction">
            <div class="container" style="margin-top: 20px;">
                <h1 class="color-gray">Transaction List</h1>
            </div>

            <div class="category">
                <form action="" class="button-rounded"  method="GET" style="border: none; margin: 0px -px;">
                <input type="text" style="margin-right: -15px;" class="button-rounded search" name="query" placeholder="Search">
                </form>
                <a href="" class="button-rounded">Sort By</a>
            </div>
            <div class="div-table">
                <table class="table-transaction">
                    <thead>
                    <tr style="font-size: 13px; text-align: left; height: 40px; border-bottom: 1px solid gray;">
                        <th width="10%">Transaction Code</th>
                        <th width="15%">Date</th>
                        <th width="10%"> Amount to Pay</th>
                        <th width="10%"> Discount </th>
                        <th width="10%"> Tax</th>
                        <th width="10%"> Payment</th>
                        <th width="10%">Change</th>
                        <th colspan="3" width="30%" >Actions</th>
                    </tr>
                    </thead>
                    
                    <?php
                    $query = "SELECT * FROM `pos_orders` GROUP BY pos_orders.orders_tcode ORDER BY `orders_orders_id` ASC";
                    $result = $conn->query($query);
                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo '
                            <tbody>
                            <tr>
                            <td width="10%">'.$row["orders_tcode"].'</td>
                            <td width="10%">'.$row["orders_date"].'</td>
                            <td width="10%"> '.$row["orders_final"].'</td>
                            <td width="10%"> '.$row["orders_discount"].'</td>
                            <td width="10%"> '.$row["orders_tax"].'</td>
                            <td width="10%"> '.$row["orders_payment"].'</td>
                            <td stwidth="10%"> '.$row["orders_change"].'</td>
                            <td ><a class="actions" href="transaction.php" data-product-id="' . $row["orders_tcode"] . '" onclick="openModal(event)">VIEW</a></td>
                            <td ><a class="actions" href="">PRINT</a></td>
                            <td ><a class="actions" href="">RETURN</a></td>
                            </tr>
                            </tbody>
                            ';
                        }
                    }
                    ?>

                    
                </table>
            </div>
        </div>
    </div>

<!-- Modal HTML structure -->
<div id="modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div class="modal-header">
                <h2>View Transaction</h2>
            </div>
            <form action="cashier_functions.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="acc_id" value="<?php echo $acc_id?>">
                    <input type="hidden" name="prod_id" id="modal-product-id">
                    <label for=""></label><label for="" id="modal-title"></label><br>
                    
                </div>
                <div class="modal-bottom">
                    
                </div>
            </form>
        </div>
    </div>


<script>
    function openModal(event) {
        event.preventDefault();
        const modal = document.getElementById("modal");
        const modalProductID = document.getElementById("modal-product-id");

        const productID = event.currentTarget.getAttribute("data-product-id");

        modalProductID.value = productID;

        modal.style.display = "block";
    }

    function closeModal() {
        document.getElementById('modal').style.display = 'none';
        document.getElementById('quantityInput').value = ''; // Reset input quantity
    }
</script>
</body>
</html>