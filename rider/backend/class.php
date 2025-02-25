<?php
include('db.php');
date_default_timezone_set('Asia/Manila');

class global_class extends db_connect
{
    public function __construct()
    {
        $this->connect();
    }

    public function getOrderStatusCounts($acc_id)
{
    $query = $this->conn->prepare("
       SELECT  
            COUNT(CASE WHEN `status` = 'Pending' THEN 1 END) AS Pending,
            COUNT(CASE WHEN `status` = 'Accepted' THEN 1 END) AS Accepted,
            COUNT(CASE WHEN `status` = 'Ready For Delivery' THEN 1 END) AS ReadyForDelivery,
            COUNT(CASE WHEN `status` = 'Shipped' THEN 1 END) AS Shipped,
            COUNT(CASE WHEN `status` = 'Delivered' THEN 1 END) AS Delivered
        FROM `new_tbl_orders` where rider_id=$acc_id;

    ");

    if ($query->execute()) {
        $result = $query->get_result()->fetch_assoc();
        // Return the result as JSON
        echo json_encode($result);
        return;
    }
}


    public function checkUser($userId)
    {
        $query = $this->conn->prepare("SELECT * FROM `account` WHERE `acc_id` = '$userId'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function checkId($tableName, $columnName, $id)
    {
        $query = $this->conn->prepare("SELECT * FROM `$tableName` WHERE `$columnName` = '$id'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function getOrdersSetToRider($riderId, $status)
    {
        $query = $this->conn->prepare("SELECT * FROM `new_tbl_orders` WHERE `rider_id` = '$riderId' AND `status` = '$status'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    
            public function getCodCollected($session_id)
        {
            $query = $this->conn->prepare("SELECT 
    orders.order_id,
    orders.rider_id,
    customer.acc_code as customer_code,
    CONCAT(customer.acc_fname, ' ', customer.acc_lname) AS customer_name,
    orders.c_status,
    orders.delivered_date,
    orders.total AS total_sales
FROM 
    new_tbl_orders AS orders
LEFT JOIN 
    account AS customer ON orders.cust_id = customer.acc_id
WHERE 
    orders.status = 'Delivered'
    AND orders.payment_id = 'COD' 
    AND orders.c_status = 'Not_Collected' AND rider_id='$session_id'
ORDER BY 
    total_sales DESC;

            ");
            
            if ($query->execute()) {
                $result = $query->get_result();
                return $result;
            } else {
                // Handle query execution failure
                return null;
            }
        }

                
        public function getCodCollectedCount($session_id)
        {
            $query = $this->conn->prepare("
                SELECT COUNT(*) AS record_count
                FROM (
                    SELECT 1
                    FROM new_tbl_orders AS orders
                    LEFT JOIN account AS acc ON orders.rider_id = acc.acc_id
                    WHERE orders.status = 'Delivered'
                    AND orders.payment_id = 'COD'
                    AND c_status='Not_Collected' AND rider_id='$session_id'
                    GROUP BY rider_id
                ) AS subquery;
            ");
            
            if ($query->execute()) {
                $result = $query->get_result();
                $row = $result->fetch_assoc();
                echo json_encode($row['record_count']);
            } else {
                // Handle query execution failure
                return null;
            }
        }



    public function getOrderUsingOrderId($riderId, $orderId)
    {
        $query = $this->conn->prepare("SELECT * FROM `new_tbl_orders` WHERE `rider_id` = '$riderId' AND `order_id` = '$orderId'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function getUserOrderItems($orderId)
    {
        $query = $this->conn->prepare("SELECT i.qty, p.* FROM `new_tbl_order_items` AS i JOIN `product` AS p ON i.product_id = p.prod_id WHERE i.order_id = '$orderId'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function productDelivered($orderId, $file)
    {
        $fileName = 'proof_of_del_' . str_pad(random_int(0, 9999999999), 10, '0', STR_PAD_LEFT);
        
         if (!empty($_FILES['proofOfDel']['size'])) {
            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];
            $extension = pathinfo($file_name, PATHINFO_EXTENSION);
            $destinationDirectory = __DIR__ . '/proof-of-del/';
            $newFileName = $fileName . '.' . $extension;
            $destination = $destinationDirectory . $newFileName;
            if (is_uploaded_file($file_tmp)) {
                if (move_uploaded_file($file_tmp, $destination)) {
                    // Add in sales
                    $dateTime = date('Y-m-d H:i:s');
                    $query = $this->conn->prepare("UPDATE `new_tbl_orders` SET `status`='Delivered', `delivered_date` = '$dateTime', `proof_of_del` = '$newFileName' WHERE `order_id` = '$orderId'");
                    
                    if ($query->execute()) {
                        return 200;
                    }
                } else {
                    // return 'Uploading file unsuccessfull';
                    return $destination;
                }
            } else {
                return "Error: File upload failed or file not found.";
            }
        } else {
            return 'File is empty';
        }
    }



    public function productUnsucessful($orderId, $unsuccessReason)
    {
                    // Add in sales
                    $dateTime = date('Y-m-d H:i:s');
                    $query = $this->conn->prepare("UPDATE `new_tbl_orders` SET `status`='Pending', `delivered_date` = '$dateTime', `unsucessful_reason` = '$unsuccessReason' WHERE `order_id` = '$orderId'");
                    
                    if ($query->execute()) {
                        return 200;
                    }
             
    }
    
    public function getUserAddress($userId)
    {
        $query = $this->conn->prepare("SELECT ua.user_complete_address, a.acc_fname, a.acc_lname, a.acc_contact FROM `account` AS a JOIN `user_address` AS ua ON a.acc_code = ua.user_acc_code WHERE a.acc_id = '$userId'");
        if($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }





}
