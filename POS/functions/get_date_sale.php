<?php
// Database connection parameters
include('../config/config.php');
include('session.php');

// Check if the data is sent via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the order_date from POST data
    $orderDate = isset($_POST['order_date']) ? $_POST['order_date'] : '';
    $sid = isset($_POST['sid']) ? $_POST['sid'] : '';
    $daily_sales = isset($_POST['daily_sales']) ? $_POST['daily_sales'] : '';

    // Check if the connection was successful
    if ($conn->connect_error) {
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'error',
            'message' => 'Connection failed: ' . $conn->connect_error
        ]);
        exit;
    }

    // Prepare SQL statement
    $stmt = $conn->prepare("SELECT orders_tcode, orders_date, orders_subtotal, orders_discount, orders_tax, orders_final, orders_payment, orders_change FROM `pos_orders` WHERE DATE(orders_date) = ?");
    if (!$stmt) {
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'error',
            'message' => 'Statement preparation failed: ' . $conn->error
        ]);
        $conn->close();
        exit;
    }

    // Bind parameters and execute query
    $stmt->bind_param('s', $orderDate);
    if (!$stmt->execute()) {
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'error',
            'message' => 'Query execution failed: ' . $stmt->error
        ]);
        $stmt->close();
        $conn->close();
        exit;
    }

    // Get the result
    $result = $stmt->get_result();

    // Initialize the data array
    $data = [];

    // Fetch data and populate the array
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            't_code' => $row['orders_tcode'],
            'date' => $row['orders_date'],
            'subtotal' => $row['orders_subtotal'],
            'discount' => $row['orders_discount'],
            'tax' => $row['orders_tax'],
            'sales' => $row['orders_final'],
            'payment' => $row['orders_payment'],
            'change' => $row['orders_change']
        ];
    }

    // Close statement
    $stmt->close();

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode([
        'data' => $data,
        'salesInfo' => [
            'sales_id' => $sid,
            'received_order_date' => $orderDate,
            'dailySales' => $daily_sales
        ],
        'status' => 'success'
    ]);

    // Close connection
    $conn->close();
} else {
    // Not a POST request
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method'
    ]);
}
?>
