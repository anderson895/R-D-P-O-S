<?php
include("../../../../connection.php");

session_start();

$db_acc_id = $_SESSION["acc_id"];

$stmt = $connections->prepare("SELECT * FROM account 
LEFT JOIN user_address ON account.acc_code = user_address.user_acc_code 
WHERE account.acc_id = ?");


 
 // Bind the parameter value
 $stmt->bind_param("s", $db_acc_id);
 
 // Execute the prepared statement
 $stmt->execute();
 
 // Get the result
 $result = $stmt->get_result();
 
 if ($result->num_rows > 0) {
     $row = $result->fetch_assoc();
     $db_acc_id = $row["acc_id"];
     $db_acc_fname = $row["acc_fname"];
     $db_acc_lname = $row["acc_lname"];
     $db_emp_image = $row["emp_image"];
     $db_acc_code = $row["acc_code"];
     
     $fullname = ucfirst($db_acc_fname) . " " . $db_acc_lname;
     $db_acc_contact = $row["acc_contact"];
 
     $db_acc_username = $row["acc_username"];
     $db_acc_password = $row["acc_password"];
     $db_acc_username = $row["acc_username"];
     $db_acc_type = $row["acc_type"];
     $db_acc_email = $row["acc_email"];


     $user_acc_code = $row["user_acc_code"];

     $user_complete_address = $row["user_complete_address"];



 }

// Fetch orders from the database

if($db_acc_type=="administrator"){

    
$sql = "SELECT
orders_id,
order_transaction_code,
orders_nickname,
orders_email,
orders_contact,
orders_paymethod,
orders_qty,
orders_prod_id,
SUM(orders_qty) AS qty,
SUM(orders_subtotal) AS subtotal,
orders_voucher_rate,
orders_address,
orders_date,
orders_status,
orders_paymethod,
orders_proof,
orders_customer_id,
product.prod_name,
product.prod_currprice,
product.prod_image,
product.prod_description,
account.emp_image,
CONCAT(account.acc_fname, ' ', account.acc_lname) AS full_name
FROM
orders
LEFT JOIN product
ON orders.orders_prod_id = product.prod_id
LEFT JOIN account
ON orders.orders_customer_id = account.acc_id
WHERE display_status='0'
GROUP BY
order_transaction_code
ORDER BY
orders_id DESC";

}else{

    $sql = "SELECT
    orders.orders_id,
    orders.order_transaction_code,
    orders.orders_nickname,
    orders.orders_email,
    orders.orders_contact,
    orders.orders_paymethod,
    orders.orders_qty,
    orders.orders_prod_id,
    SUM(orders.orders_qty) AS qty,
    SUM(orders.orders_subtotal) AS subtotal,
    orders.orders_voucher_rate,
    orders.orders_address,
    orders.orders_date,
    orders.orders_status,
    orders.orders_paymethod,
    orders.orders_proof,
    orders.orders_customer_id,
    product.prod_name,
    product.prod_currprice,
    product.prod_image,
    product.prod_description,
    account.emp_image,
    CONCAT(account.acc_fname, ' ', account.acc_lname) AS full_name
FROM
    orders
LEFT JOIN product ON orders.orders_prod_id = product.prod_id
LEFT JOIN account ON orders.orders_customer_id = account.acc_id
WHERE
    orders.display_status='0' AND
    orders.orders_status != 'Pending'
GROUP BY
    orders.order_transaction_code
ORDER BY
    orders.orders_id DESC";


}


$result = $connections->query($sql);

if ($result->num_rows > 0) {
    $data = array();

    // Fetch rows and push them into the data array


    while ($row = $result->fetch_assoc()) {
        // Convert MySQL date to word format

        
        $row['orders_date'] = date('F j, Y h:i A', strtotime($row['orders_date']));

        $row['db_acc_type'] =$db_acc_type;
        
        $data[] = $row;
        
    }

    // Encode the data as JSON and echo it
    if ($data) {
        echo json_encode($data);
    } else {
        echo json_encode([]); // Return an empty array instead of "empty"
    }
} else {
    echo "0 results";
}

$connections->close();
?>
