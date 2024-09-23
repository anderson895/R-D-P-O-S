<?php

session_start();
include('backend/class.php');
$db = new global_class();
if (isset($_SESSION['acc_id'])) {
    $checkUser = $db->checkUser($_SESSION['acc_id']);
    if ($checkUser->num_rows > 0) {
        $user = $checkUser->fetch_assoc();
        if ($user['acc_type'] != 'administrator') {
            header('Location: backend/logout.php');
            exit;
        }
    } else {
        header('Location: backend/logout.php');
        exit;
    }
} else {
    header('Location: backend/logout.php');
    exit;
}


function backToPendingOrders()
{
    header("Location: orders.php?page=Pending");
    exit;
}

if (isset($_GET['orderId'])) {
    $orderId = $_GET['orderId'];
    $getOrders = $db->get_orderDetails($orderId); // Fetch order details
    $getMaintinance = $db->getSystemMaintinance($orderId); // Fetch system details

    if ($getOrders->num_rows < 1) {
        backToPendingOrders();
    } else {
        $order = $getOrders->fetch_assoc(); // Fetch the order
        $system = $getMaintinance->fetch_assoc(); // Fetch the order
        $getOrderItems = $db->getUserOrderItems($orderId); // Fetch order items

        if ($getOrderItems->num_rows < 1) {
            backToPendingOrders();
        }
    }
} else {
    backToPendingOrders();
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipment Information</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .document-container {
            margin: 40px auto;
            padding: 30px;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
        }

        .header {
            margin-bottom: 30px;
            text-align: center;
            background-color: rgb(131, 0, 0);
            padding: 20px;
            border-radius: 8px;
            color: white;
        }

        h1 {
            font-size: 28px;
            margin: 10px 0;
        }

        h6 {
            margin-bottom: 10px;
            font-weight: bold;
            color: rgb(131, 0, 0);
        }

        .table {
            margin-top: 20px;
        }

        .table th, .table td {
            text-align: left;
            padding: 12px;
            border: 1px solid #ccc;
        }

        .table th {
            background-color: #e9ecef;
        }

        .logo-container {
            display: inline-block;
            width: 120px;
            height: 120px;
            border: 5px solid white;
            border-radius: 50%;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .logo {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .print-button {
            margin-top: 20px;
        }

       
}

    </style>
    
    
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script>
    function printDocument() {
        var printContent = $('.document-container').clone();
        var printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write('<html><head>');
        printWindow.document.write('<title>Print Receipt</title>');
        printWindow.document.write('<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">');
        printWindow.document.write('<style>');
        printWindow.document.write('body { font-family: Arial, sans-serif; margin: 0; }');
        printWindow.document.write('@media print {');
        printWindow.document.write('    body { font-family: Arial, sans-serif; background-color: #f8f9fa; color: black; }');
        printWindow.document.write('    .document-container {');
        printWindow.document.write('        margin: 40px auto;');
        printWindow.document.write('        padding: 30px;');
        printWindow.document.write('        border-radius: 8px;');
        printWindow.document.write('        background-color: #fff;');
        printWindow.document.write('        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);');
        printWindow.document.write('        max-width: 800px;');
        printWindow.document.write('    }');
        printWindow.document.write('    .header {');
        printWindow.document.write('        background-color: rgb(131, 0, 0);');
        printWindow.document.write('        color: white;');
        printWindow.document.write('    }');
        printWindow.document.write('    .logo-container {');
        printWindow.document.write('        width: 100px;');
        printWindow.document.write('        height: 100px;');
        printWindow.document.write('    }');
        printWindow.document.write('    .print-button { display: none; }');
        printWindow.document.write('}');
        printWindow.document.write('</style>');
        printWindow.document.write('</head><body>');
        printWindow.document.write(printContent.html());
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    }
</script>


</head>
<body>
    <div class="document-container">
        <header class="header">
            <div class="logo-container">
                <img src="../../upload_system/<?=$system['system_logo']?>" alt="Logo" class="img-fluid logo">
            </div>
            <h1 class="mt-3">Shipment Information</h1>
        </header>
        <main class="content">
            <div class="row mt-2">
                <div class="col-md-6">
                    <h6>Rider Information</h6>
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($order['rider_fname'] . ' ' . $order['rider_lname']); ?></p>
                    <p><strong>Contact:</strong> <?php echo htmlspecialchars($order['rider_contact']); ?></p>
                </div>
                <div class="col-md-6">
                    <h6>Receiver Information</h6>
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($order['customer_fname'] . ' ' . $order['customer_lname']); ?></p>
                    <p><strong>Address:</strong> <?php echo htmlspecialchars($order['receiver_address']); ?></p>
                    <p><strong>Contact:</strong> <?php echo htmlspecialchars($order['receiver_contact']); ?></p>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <h6>Shipment Details</h6>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Order ID:</th>
                                <th><?php echo htmlspecialchars($orderId); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Add rows here for item details -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="text-center print-button">
                <button class="btn btn-primary" onclick="printDocument()">Print Receipt</button>
            </div>
        </main>
    </div>
</body>
</html>




