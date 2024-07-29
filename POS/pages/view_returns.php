<?php
include('../config/config.php');
include('../functions/session.php');
$totalAmount = 0; 
try {
    // Sanitize and retrieve the ID from GET request
    $id = $_GET['id'] ?? '';
    
    // Prepare your query using prepared statements to prevent SQL injection
    $query = "SELECT rdate, rcode, rreason, rtype, selected_items, rcustomer, rproof FROM return_pos_table WHERE rcode = ?";
    
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
        
        // Assuming selected_items is JSON, decode it if needed
        $selected_items_array = json_decode($selected_items, true);
    } else {
        echo "No rows found.";
    }
    
    // Close statement
    $stmt->close();
    
} catch(Exception $e) {
    echo "Error: " . $e->getMessage();
}

foreach ($selected_items_array as $key => $item) {
    $total = $item['quantity'] * $item['price'];
    $totalAmount += $total; // Add current total to overall total
}
// Close connection
$conn->close();
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
    .viewUploaded:hover{
        opacity: 50%;
    }
    </style>
</head>
<body >

<?php include ('../includes/navigation.php');?>

<div class="container ">
    <div class="row ">
        <!-- <div class="col-12 col-md-2"></div> -->
        <div class="col-12 col-md-8 mt-3">
            <div class="border rounded p-4 shadow">
            <h5 class="fw-bold">Return Details</h5>
            <div class="container border rounded py-2" >
            <table id="productTable" style="width: 100%;">
                <tr>
                    <td>Transaction Code </td>
                    <td class="right"><?php echo $rcode?></td>
                </tr>
                <tr>
                    <td>Date Return</td>
                    <td class="right"><?php echo $rdate?></td>
                </tr>
                <tr>
                    <td>Customer Name</td>
                    <td class="right"><?php echo $rcustomer?></td>
                </tr>
                <tr>
                    <td>Return Reason</td>
                    <td class="right"><?php echo $rreason?></td>
                </tr>
                <tr>
                    <td>Return Type</td>
                    <td class="right"><?php echo $rtype?></td>
                </tr>
                <tr>
                    <td>Total Amount Return</td>
                    <td class="right">₱ <?php echo $totalAmount?></td>
                </tr>
            </table>
            </div>
            <div class="container mt-3 border rounded py-2" >
                <div style="overflow: auto; height: 250px;">
            <table class="table" style="width: 100%; ">
            <thead>
                <tr>
                    <th>Product</th>
                    <th class="text-end">Price</th>
                    <th class="text-end">Qty</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach ($selected_items_array as $key => $item) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($item['prodName']) . "</td>";
                    echo "<td class='text-end'>" . htmlspecialchars($item['price']) . "</td>";
                    echo "<td class='text-end'>" . htmlspecialchars($item['quantity']) . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>

            </table>
            </div>
            </div>
            </div>
            
        </div>
        <div class="col-12 col-md-4 mt-3">
            <div class="border rounded p-4 shadow">
            <h5 class="fw-bold">Uploaded Verification</h5>
                <div id="viewUpload" class="border rounded viewUploaded" style="width: auto; height: 450px; cursor: pointer">
                    <img id="uploadedImage" class="rounded" style="object-fit: cover; width: 100%; height: 100%" src="../uploads/<?php echo $rproof?>" alt="">
                </div>
            </div>
        </div>
    </div>
</div>


<script src="../assets/js/viewUpload.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

