<?php
include('db.php');
date_default_timezone_set('Asia/Manila');

class global_class extends db_connect
{
    public function __construct()
    {
        $this->connect();
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
    
    
    //Start Jcode
      public function get_orderDetails($id)
    {
        // Prepare the SQL query
        // receiver_address
        $query = $this->conn->prepare("SELECT 
    newOrder.*, 
    rider.acc_fname AS rider_fname, 
    rider.acc_lname AS rider_lname, 
    rider.acc_contact AS rider_contact, 
    customer.acc_fname AS customer_fname, 
    customer.acc_lname AS customer_lname, 
    customer.acc_contact AS receiver_contact, 
    customer.acc_code AS customer_acc_code, 
    uaddress.user_complete_address AS receiver_address
    
FROM 
    new_tbl_orders AS newOrder
LEFT JOIN 
    account AS rider ON rider.acc_id = newOrder.rider_id
LEFT JOIN 
    account AS customer ON customer.acc_id = newOrder.cust_id
LEFT JOIN 
    user_address AS uaddress ON customer.acc_code = uaddress.user_acc_code
WHERE 
    newOrder.order_id = '$id';
");
    
        // Execute the query
        if ($query->execute()) {
            $result = $query->get_result();
            return $result; // Return as an associative array
        }
    
        return null; // Return null if execution fails
    }


    // End Jcode

    public function getUserType($userType)
    {
        $query = $this->conn->prepare("SELECT * FROM `account` WHERE `acc_type` = '$userType' AND `acc_status` = '0'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }


    public function getDelivery()
    {
        $query = $this->conn->prepare("SELECT * FROM `account` WHERE (`acc_type` = 'administrator' OR `acc_type` = 'deliveryStaff') AND `acc_status` = '0'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }


    public function getDeliveryRiderCount($accId)
{
    // Directly include $accId in the SQL query without bind_param
    $query = $this->conn->prepare("SELECT rider_id, COUNT(*) AS order_count FROM new_tbl_orders WHERE rider_id = '$accId'
     AND (`status`='Accepted' OR `status`='Ready For Delivery' OR `status`='Shipped') 
     GROUP BY rider_id");
    
    if ($query->execute()) {
        $result = $query->get_result();
        if ($row = $result->fetch_assoc()) {
            return $row['order_count'];
        }
    }
    return 0; // Return 0 if no orders are found or the query fails
}


    
    
    
    public function getSystemMaintinance()
    {
        $query = $this->conn->prepare("SELECT * FROM `maintinance`");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    // Orders

    public function getCodCollected()
{
    $query = $this->conn->prepare("SELECT CONCAT(acc.acc_fname, ' ', acc.acc_lname) AS rider_name,acc_code as acc_code,order_id, rider_id,c_status,
       SUM(orders.total) AS total_sales
FROM new_tbl_orders AS orders
LEFT JOIN account AS acc ON orders.rider_id = acc.acc_id
WHERE orders.status = 'Delivered'
  AND orders.payment_id = 'COD' AND c_status='Not_Collected'
GROUP BY rider_id
ORDER BY total_sales DESC;

    ");
    
    if ($query->execute()) {
        $result = $query->get_result();
        return $result;
    } else {
        // Handle query execution failure
        return null;
    }
}


public function getCodCollectedCount()
{
    $query = $this->conn->prepare("
        SELECT COUNT(*) AS record_count
        FROM (
            SELECT 1
            FROM new_tbl_orders AS orders
            LEFT JOIN account AS acc ON orders.rider_id = acc.acc_id
            WHERE orders.status = 'Delivered'
              AND orders.payment_id = 'COD'
              AND c_status='Not_Collected'
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

public function getEachCodCollected($session_id)
{
            $query = $this->conn->prepare("SELECT 
    orders.cust_id,
    orders.order_id,
    orders.rider_id,
    customer.acc_code as customer_code,
    CONCAT(customer.acc_fname, ' ', customer.acc_lname) AS customer_name,
    orders.c_status,
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


public function getOrderStatusCounts()
{
    $query = $this->conn->prepare("
       SELECT  
            COUNT(CASE WHEN `status` = 'Pending' THEN 1 END) AS Pending,
            COUNT(CASE WHEN `status` = 'Accepted' THEN 1 END) AS Accepted,
            COUNT(CASE WHEN `status` = 'Ready For Delivery' THEN 1 END) AS ReadyForDelivery,
            COUNT(CASE WHEN `status` = 'Shipped' THEN 1 END) AS Shipped,
            COUNT(CASE WHEN `status` = 'Rejected' THEN 1 END) AS Rejected,
            COUNT(CASE WHEN `status` = 'Cancelled' THEN 1 END) AS Cancelled,
            COUNT(CASE WHEN `status` = 'Delivered' THEN 1 END) AS Delivered
        FROM `new_tbl_orders` ;

    ");

    if ($query->execute()) {
        $result = $query->get_result()->fetch_assoc();
        // Return the result as JSON
        echo json_encode($result);
        return;
    }
}




    public function getOrders($status)
    {
        $query = $this->conn->prepare("SELECT * FROM `new_tbl_orders` WHERE `status` = '$status' ORDER BY `new_tbl_orders`.`order_date` DESC");
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

    public function rejectOrder($orderId,$reason)
    {
        $query = $this->conn->prepare("UPDATE `new_tbl_orders` SET `status`='Rejected',reject_reason='$reason' WHERE `order_id` = '$orderId'");
        if ($query->execute()) {
            return 200;
        }
    }

    public function MarkAs_Collected($riderId)
    {
        $query = $this->conn->prepare("UPDATE `new_tbl_orders` SET `c_status`='Collected' WHERE `rider_id` = '$riderId'");
        if ($query->execute()) {
            return 200;
        }
    }


    public function changeOrderStatus($orderId,$estimatedDelivery)
    {
        $dateTime = date('Y-m-d H:i:s');
        $getOrder = $this->checkId('new_tbl_orders', 'order_id', $orderId);
        if ($getOrder->num_rows > 0) {
            $order = $getOrder->fetch_assoc();
            $orderStatus = $order['status'];
            if ($orderStatus == 'Pending') {
                $newStatus = 'Accepted';
            } elseif ($orderStatus == 'Accepted') {
                $newStatus = 'Ready For Delivery';
            } elseif ($orderStatus == 'Ready For Delivery') {
                
                $newStatus = 'Shipped';
                if ($order['rider_id'] == '') {
                    return 'Please select rider!';
                }
            } elseif ($orderStatus == 'Shipped') {
                $newStatus = 'Delivered';
                $query = $this->conn->prepare("UPDATE `new_tbl_orders` SET `status`='$newStatus', `delivered_date` = '$dateTime' WHERE `order_id` = '$orderId'");
                if ($query->execute()) {
                    return 200;
                } else {
                    return 400;
                }
            } else {
                return 400;
            }

            if ($newStatus == 'Ready For Delivery') {
                // // Deduct to the inventory
               

                                    // Deduct from the inventory
                    $getItems = $this->conn->prepare("SELECT * FROM `new_tbl_order_items`
                    LEFT JOIN product
                    ON product.prod_id  = new_tbl_order_items.product_id
                    WHERE `order_id` = '$orderId'");
                    if ($getItems->execute()) {
                        $items = $getItems->get_result();
                        while ($item = $items->fetch_assoc()) {
                            $productId = $item['product_id'];
                            $prod_code = $item['prod_code'];
                            $qty = $item['qty'];

                            // First, calculate total available stock for this product
                            $totalStockSql = $this->conn->prepare("SELECT SUM(s_amount) as total_stock 
                                FROM `stocks` 
                                WHERE `s_prod_id` = '$productId' 
                                AND `s_amount` > 0 
                                AND (DATE(s_expiration) >= CURDATE() OR s_expiration = '0000-00-00') 
                                AND `s_status` = '1'");
                            
                            if ($totalStockSql->execute()) {
                                $totalStockResult = $totalStockSql->get_result();
                                $totalStockRow = $totalStockResult->fetch_assoc();
                                $totalAvailableStock = $totalStockRow['total_stock'];

                                // Check if there's enough stock for the requested quantity
                                if ($totalAvailableStock < $qty) {
                                    return 'Not enough stock for product code: ' . $prod_code;
                                }

                                // Proceed with stock deduction if enough stock is available
                                $inventorySql = $this->conn->prepare("SELECT * FROM `stocks` 
                                    WHERE `s_prod_id` = '$productId' 
                                    AND `s_amount` > 0 
                                    AND (DATE(stocks.s_expiration) >= CURDATE() OR stocks.s_expiration = '0000-00-00') 
                                    AND `s_status` = '1' 
                                    ORDER BY `s_expiration` ASC, `s_amount` DESC");

                                if ($inventorySql->execute()) {
                                    $inv = $inventorySql->get_result();
                                    $detailQty = $qty;

                                    while ($inventoryRow = $inv->fetch_assoc()) {
                                        $availableQty = $inventoryRow['s_amount'];
                                        $subtractedQty = min($detailQty, $availableQty);

                                        $stockId = $inventoryRow['s_id'];
                                        $updateInvQty = $this->conn->prepare("UPDATE `stocks` SET `s_amount` = `s_amount` - $subtractedQty WHERE `s_id` = '$stockId'");

                                        if ($updateInvQty->execute()) {
                                            if ($subtractedQty > 0) {
                                                // Subtract from remaining quantity
                                                $detailQty -= $subtractedQty;
                                            }
                                        } else {
                                            return 'Update Stock SQL Error!';
                                        }

                                        if ($detailQty <= 0) {
                                            break;
                                        }
                                    }
                                } else {
                                    return 'Inventory SQL Error!';
                                }
                            } else {
                                return 'Total Stock SQL Error!';
                            }
                        }
                    } else {
                        return 'Get Items SQL Error';
                    }

            }


            if($estimatedDelivery){

                $query = $this->conn->prepare("UPDATE `new_tbl_orders` SET `status`='$newStatus',`estimated_delivery`='$estimatedDelivery' WHERE `order_id` = '$orderId'");
                if ($query->execute()) {
                    return 200;
                }

            }else{
                $query = $this->conn->prepare("UPDATE `new_tbl_orders` SET `status`='$newStatus' WHERE `order_id` = '$orderId'");
                if ($query->execute()) {
                    return 200;
                }
            }
           

            return $newStatus;
        } else {
            return 400;
        }
    }
    
    public function changeOrderStatusToDelivered($orderId, $file) {
        $fileName = 'proof_of_del_' . str_pad(random_int(0, 9999999999), 10, '0', STR_PAD_LEFT);
        
         if (!empty($_FILES['proofOfDel']['size'])) {
            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];
            $extension = pathinfo($file_name, PATHINFO_EXTENSION);
            $destinationDirectory = __DIR__ . '/../../../rider/backend/proof-of-del/';
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

    public function changeOrderRider($orderId, $riderId)
    {
        $query = $this->conn->prepare("UPDATE `new_tbl_orders` SET `rider_id`='$riderId' WHERE `order_id` = '$orderId'");
        if ($query->execute()) {
            return 200;
        }
    }

    public function getOrderSales()
    {
        $query = $this->conn->prepare("SELECT o.*, a.acc_fname AS cust_fname, a.acc_lname AS cust_lname, r.acc_fname AS db_fname, r.acc_lname AS db_lname, mop.payment_name AS payment
                                       FROM `new_tbl_orders` AS o 
                                       JOIN `account` AS a ON o.cust_id = a.acc_id
                                       JOIN `account` AS r ON o.rider_id = r.acc_id
                                       LEFT JOIN `mode_of_payment` AS mop ON o.payment_id = mop.payment_id
                                       WHERE `status` = 'Delivered' ORDER BY o.order_date ASC");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function getSalesInPOS()
    {
        $query = $this->conn->prepare("SELECT *, SUM(orders_subtotal) AS subtotal FROM `pos_orders` GROUP BY `orders_tcode` ORDER BY `orders_date` DESC");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }
    
    public function getUserAddress($userId)
    {
        $query = $this->conn->prepare("SELECT a.acc_code,tbladd.address_rider,ua.user_complete_address, a.acc_fname, a.acc_lname 
        FROM `account`
         AS a JOIN `user_address` AS ua 
         ON a.acc_code = ua.user_acc_code
         LEFT JOIN tbl_address as tbladd
         ON tbladd.address_code = ua.user_address_code
         WHERE a.acc_id = '$userId'");
        if($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }




    // rates



    public function getRates()
    {
        $query = $this->conn->prepare("SELECT * FROM `rate_reviews` ORDER BY `r_rate_id` DESC");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function getUsertUsingId($id)
    {
        $query = $this->conn->prepare("SELECT * FROM `account` WHERE `acc_id` = '$id'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }


    public function checkSmesId($id)
    {
      
            $query = $this->conn->prepare("SELECT * FROM `product` WHERE `prod_id` = '$id'");
      

        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }


    public function deleteRevs($id)
    {
        $query = $this->conn->prepare("DELETE FROM `rate_reviews` WHERE `r_rate_id` = '$id'");
        if ($query->execute()) {
            echo "success";
        }else{
            echo "errorsssss";
        }
    }


    public function AllowedRevs($id)
    {
        $query = $this->conn->prepare("UPDATE `rate_reviews` SET `r_status` = '1' WHERE `r_rate_id` = '$id'");
        if ($query->execute()) {
            echo "success";
        }else{
            echo "errorsssss";
        }
    }

    public function RestrictRevs($id)
    {
        $query = $this->conn->prepare("UPDATE `rate_reviews` SET `r_status` = '2' WHERE `r_rate_id` = '$id'");
        if ($query->execute()) {
            echo "success";
        }else{
            echo "errorsssss";
        }
    }

}
