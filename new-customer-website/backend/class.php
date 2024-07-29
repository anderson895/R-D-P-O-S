<?php
include ('db.php');
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

    public function getAllProducts($search, $category)
    {
        if ($search != '') {
            // Get Using Search
            $query = $this->conn->prepare("SELECT * 
                                           FROM `product` 
                                           WHERE (`prod_name` LIKE '%$search%' OR `prod_description` LIKE '%$search%')
                                           AND `prod_status` = '0' 
                                           AND `prod_sell_onlline` = '1'");
        } elseif ($category != 'All') {
            //Get Using Category
            $query = $this->conn->prepare("SELECT * FROM `product` WHERE `prod_status` = '0' AND `prod_sell_onlline` = '1' AND `prod_category_id` = '$category'");
        } else {
            // Get All
            $query = $this->conn->prepare("SELECT * FROM `product` WHERE `prod_status` = '0' AND `prod_sell_onlline` = '1'");
        }

        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function getCategories()
    {
        $query = $this->conn->prepare("SELECT * FROM `category` WHERE `category_status` = '1'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function getBestSellers()
    {
        $query = $this->conn->prepare("SELECT p.*, SUM(po.orders_prodQty) AS total_quantity_sold
                                       FROM `product` AS p 
                                       LEFT JOIN pos_orders AS po ON p.prod_id = po.orders_prod_id 
                                       WHERE p.prod_sell_onlline = 1
                                       AND p.prod_status = 1
                                       GROUP BY p.prod_id, p.prod_name
                                       HAVING total_quantity_sold > 0
                                       ORDER BY total_quantity_sold DESC 
                                       LIMIT 5");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function checkProductQty($productId)
    {
        $query = $this->conn->prepare("SELECT SUM(s_amount) AS total_stock FROM `stocks` WHERE `s_prod_id` = '$productId'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function getNewProducts()
    {
        $query = $this->conn->prepare("SELECT * 
                               FROM `product` 
                               WHERE `prod_status` = '0' 
                               AND `prod_sell_onlline` = '1' 
                               AND `prod_added` >= DATE_SUB(NOW(), INTERVAL 3 WEEK)
                               ORDER BY `prod_added` DESC
                               LIMIT 5");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    // Cart
    public function checkProductInCart($userId, $productId)
    {
        $query = $this->conn->prepare("SELECT * FROM `new_cart` WHERE `prod_id` = '$productId' AND `user_id` = '$userId'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function addToCart($userId, $productId)
    {
        $checkProducyInCart = $this->checkProductInCart($userId, $productId);
        if ($checkProducyInCart->num_rows > 0) {
            $query = $this->conn->prepare("UPDATE `new_cart` SET `qty`= `qty` + '1' WHERE `user_id` = '$userId'");
            $response = 'Cart Updated!';
        } else {
            $query = $this->conn->prepare("INSERT INTO `new_cart`(`prod_id`, `qty`, `user_id`) VALUES ('$productId','1','$userId')");
            $response = 'Added To Cart!';
        }

        if ($query->execute()) {
            return $response;
        } else {
            return 400;
        }
    }

    public function getCartItems($userId)
    {
        $query = $this->conn->prepare("SELECT nc.cart_id, nc.qty, p.* FROM `new_cart` AS nc JOIN `product` AS p ON nc.prod_id = p.prod_id WHERE nc.user_id = '$userId'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function getCartQty($cartId)
    {
        $query = $this->conn->prepare("SELECT * FROM `new_cart` WHERE `cart_id` = '$cartId'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function updateCart($cartId, $updateType)
    {
        $cartQty = 0;
        $getCartQty = $this->getCartQty($cartId);
        if ($getCartQty->num_rows > 0) {
            $cart = $getCartQty->fetch_assoc();
            $cartQty = $cart['qty'];
        }

        if ($updateType == 'inc') {
            $query = $this->conn->prepare("UPDATE `new_cart` SET `qty`= `qty` + '1'  WHERE `cart_id` = '$cartId'");
        } elseif ($updateType == 'desc') {
            if ($cartQty <= 1) {
                return 'Invalid Quantity!';
            }

            $query = $this->conn->prepare("UPDATE `new_cart` SET `qty`= `qty` - '1'  WHERE `cart_id` = '$cartId'");
        } else {
            $query = $this->conn->prepare("DELETE FROM `new_cart` WHERE `cart_id` = '$cartId'");
        }

        if ($query->execute()) {
            return 200;
        }
    }

    public function updateCartQty($cartId, $qty)
    {
        if ($qty < 1) {
            return 400;
        }

        $query = $this->conn->prepare("UPDATE `new_cart` SET `qty`= '$qty'  WHERE `cart_id` = '$cartId'");
        if ($query->execute()) {
            return 200;
        }
    }

    public function deleteAllItemsInCart($userId)
    {
        $query = $this->conn->prepare("DELETE FROM `new_cart` WHERE `user_id` = '$userId'");
        if ($query->execute()) {
            return 200;
        }
    }

    // Maintenance
    public function getMaintenance()
    {
        $query = $this->conn->prepare("SELECT * FROM `maintinance`");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    // Shipping Fee
    public function getUserShippingFee($userId)
    {
        $query = $this->conn->prepare("SELECT tblA.address_rate AS sf, tblA.address_cod AS codAvail FROM `account` AS a 
                                       JOIN `user_address` AS ua ON a.acc_code = ua.user_acc_code
                                       LEFT JOIN tbl_address AS tblA ON ua.user_address_code = tblA.address_code
                                       WHERE a.acc_id = '$userId' AND tblA.address_display_status = 1");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    // Get Payment Types
    public function getPaymentTypes()
    {
        $query = $this->conn->prepare("SELECT * FROM `mode_of_payment` WHERE `payment_status` = '0'");
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

    // Place Order
    public function placeOrderCOD($post)
    {
        $date = date('Y-m-d H:i:s');

        // Order Id
        $orderId = 'ORD-' . random_int(000000, 999999);
        $checkOrderId = $this->checkId('new_tbl_orders', 'order_id', $orderId);
        while ($checkOrderId->num_rows > 0) {
            $orderId = 'ORD-' . random_int(000000, 999999);
            $checkOrderId = $this->checkId('new_tbl_orders', 'order_id', $orderId);
        }

        // Get Tax Rate
        $getMaintenance = $this->getMaintenance();
        if ($getMaintenance->num_rows > 0) {
            $maintenance = $getMaintenance->fetch_assoc();
            $taxRate = $maintenance['system_tax'];
        }

        $userId = $_SESSION['acc_id'];
        $paymentType = $_POST['paymentType'];
        $orderItems = json_decode($_POST['items'], true);

        $subtotal = 0;
        $vat = 0;
        $sf = 0;
        $total = 0;

        // Get SF
        $getUserSF = $this->getUserShippingFee($userId);
        if ($getUserSF->num_rows > 0) {
            $shippingFee = $getUserSF->fetch_assoc();
            $sf = $shippingFee['sf'];
        }

        foreach ($orderItems as $item) {
            $productId = $item['productId'];
            $qty = $item['qty'];

            $productAmount = $item['productPrice'] * $qty;
            $itemVat = $productAmount * $taxRate;

            $subtotal += $productAmount;
            $vat += $itemVat;

            $insertValues[] = "('$orderId', '$productId', '$qty')";

            $deleteItemsInCart = $this->conn->prepare("DELETE FROM `new_cart` WHERE `prod_id` = '$productId' AND `user_id` = '$userId'");
            $deleteItemsInCart->execute();
        }

        $total = $subtotal + $vat + $sf;


        $insertItemQuery = "INSERT INTO `new_tbl_order_items` (`order_id`, `product_id`, `qty`) VALUES " . implode(", ", $insertValues);
        $insertItem = $this->conn->prepare($insertItemQuery);

        $query = $this->conn->prepare("INSERT INTO `new_tbl_orders`(`order_id`, `cust_id`, `payment_id`, `subtotal`, `vat`, `sf`, `total`, `order_date`, `status`) VALUES ('$orderId', '$userId', 'COD', '$subtotal', '$vat', '$sf', '$total', '$date', 'Pending')");

        if ($query->execute() && $insertItem->execute()) {

            return 200;
        } else {
            echo "Error inserting order or order items.";
        }
    }

    public function placeOrderWithPOF($post, $file)
    {
        $date = date('Y-m-d H:i:s');

        // Order Id
        $orderId = 'ORD-' . random_int(000000, 999999);
        $checkOrderId = $this->checkId('new_tbl_orders', 'order_id', $orderId);
        while ($checkOrderId->num_rows > 0) {
            $orderId = 'ORD-' . random_int(000000, 999999);
            $checkOrderId = $this->checkId('new_tbl_orders', 'order_id', $orderId);
        }

        // Get Tax Rate
        $getMaintenance = $this->getMaintenance();
        if ($getMaintenance->num_rows > 0) {
            $maintenance = $getMaintenance->fetch_assoc();
            $taxRate = $maintenance['system_tax'];
        }

        $userId = $_SESSION['acc_id'];
        $paymentType = $_POST['paymentType'];
        $orderItems = json_decode($_POST['items'], true);

        $subtotal = 0;
        $vat = 0;
        $sf = 0;
        $total = 0;

        // Get SF
        $getUserSF = $this->getUserShippingFee($userId);
        if ($getUserSF->num_rows > 0) {
            $shippingFee = $getUserSF->fetch_assoc();
            $sf = $shippingFee['sf'];
        }

        foreach ($orderItems as $item) {
            $productId = $item['productId'];
            $qty = $item['qty'];

            $productAmount = $item['productPrice'] * $qty;
            $itemVat = $productAmount * $taxRate;

            $subtotal += $productAmount;
            $vat += $itemVat;

            $insertValues[] = "('$orderId', '$productId', '$qty')";

            $deleteItemsInCart = $this->conn->prepare("DELETE FROM `new_cart` WHERE `prod_id` = '$productId' AND `user_id` = '$userId'");
            $deleteItemsInCart->execute();
        }

        $total = $subtotal + $vat + $sf;

        if (!empty($_FILES['proofOfPayment']['size'])) {
            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];
            $extension = pathinfo($file_name, PATHINFO_EXTENSION);
            $destinationDirectory = __DIR__ . "/proof-of-payment/";
            $newFileName = $orderId . '.' . $extension;
            $destination = $destinationDirectory . $newFileName;
            if (is_uploaded_file($file_tmp)) {
                if (move_uploaded_file($file_tmp, $destination)) {
                    $insertItemQuery = "INSERT INTO `new_tbl_order_items` (`order_id`, `product_id`, `qty`) VALUES " . implode(", ", $insertValues);
                    $insertItem = $this->conn->prepare($insertItemQuery);
                    $query = $this->conn->prepare("INSERT INTO `new_tbl_orders`(`order_id`, `cust_id`, `payment_id`, `pof`,`subtotal`, `vat`, `sf`, `total`, `order_date`, `status`) VALUES ('$orderId', '$userId', '$paymentType', '$newFileName','$subtotal', '$vat', '$sf', '$total', '$date', 'Pending')");

                    if ($query->execute() && $insertItem->execute()) {
                        return 200;
                    } else {
                        echo "Error inserting order or order items.";
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


    // Orders

    public function getUserOrders($userId, $status)
    {
        $query = $this->conn->prepare("SELECT * FROM `new_tbl_orders` WHERE `cust_id` = '$userId' AND `status` = '$status'");
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

    public function cancelOrder($orderId)
    {
        $query = $this->conn->prepare("UPDATE `new_tbl_orders` SET `status`= 'Cancelled' WHERE `order_id` = '$orderId'");
        if ($query->execute()) {
            return 200;
        }
    }

    public function getUserAddress($userId)
    {
        $query = $this->conn->prepare("SELECT ua.user_complete_address AS address FROM `account` AS a 
                                        LEFT JOIN `user_address` AS ua ON a.acc_code = ua.user_acc_code WHERE a.acc_id = '$userId'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function getUserAddress2($userId)
    {
        $query = $this->conn->prepare("SELECT * FROM `user_address` WHERE `user_acc_code` = '$userId'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function editUser($post, $userId)
    {
        $query = $this->conn->prepare("UPDATE `account` SET `acc_username`=?, `acc_fname`=?, `acc_lname`=?, `acc_birthday`=?, `acc_email`=?, `acc_contact`=? WHERE `acc_id` = ?");

        $query->bind_param("ssssssi", $post['editUsername'], $post['editFName'], $post['editLName'], $post['editBday'], $post['editEmail'], $post['editContact'], $userId);

        if ($query->execute()) {
            return 200;
        } else {
            return "Error updating user: " . $query->error;
        }
    }

    public function checkUserAddress($accId)
    {
        $query = $this->conn->prepare("SELECT * FROM `user_address` WHERE `user_acc_code` = '$accId'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function updateAddress($post)
    {
        $accCode = $post["accCode"];

        $checkUserAddress = $this->checkUserAddress($accCode);

        if ($checkUserAddress->num_rows > 0) {
            // Update
            $query = $this->conn->prepare("UPDATE `user_address` SET `user_address_code`='" . $post['barangayCode'] . "',`user_complete_address`='" . $post['completeAddress'] . "' WHERE `user_acc_code` = '" . $post['accCode'] . "'");
            if ($query->execute()) {
                return 200;
            }
        } else {
            // Add
            $query = $this->conn->prepare("
                INSERT INTO `user_address` (
                    `user_acc_code`,
                    `user_address_fullname`,
                    `user_address_phone`,
                    `user_address_email`,
                    `user_address_code`,
                    `user_complete_address`,
                    `user_active_status`,
                    `user_add_display_status`,
                    `user_add_Default_status`
                ) VALUES (
                    '" . $post['accCode'] . "',
                    '" . $post['userFullName'] . "',
                    '" . $post['userPhone'] . "',
                    '" . $post['userEmail'] . "',
                    '" . $post['barangayCode'] . "',
                    '" . $post['completeAddress'] . "',
                    '1',
                    '1',
                    '1'
                )
            ");
            if ($query->execute()) {
                return 200;
            }
        }
    }






     // Rate
     public function rate($post, $userId)
     {

        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
         // Use date with timezone
         $dateToday = new DateTime("now", new DateTimeZone('Asia/Manila'));
         $formattedDate = $dateToday->format('Y-m-d H:i:s');
     
         // Prepare and execute the insert query with parameterized statements
         $userIdParam = $userId;
         $smesIdParam = $post['id'];
         $rateParam = $post['star'];
         $reviewParam = $post['review'];
     
         $query = $this->conn->prepare("INSERT INTO `rate_reviews` (`r_user_id`, `r_prod_id`, `r_rate`, `r_feedback`) VALUES (?, ?, ?, ?)");
         $query->bind_param('ssss', $userIdParam, $smesIdParam, $rateParam, $reviewParam);
     
         if ($query->execute()) {
           
             return 200;
         }
     
         // Handle errors if needed
         return 500;
     }


     public function getAllReviewsInAccom($id)
     {
        
         $query = $this->conn->prepare("SELECT srr.r_rate,srr.r_feedback,t.acc_username 
         FROM rate_reviews as srr
         LEFT JOIN account as t
         ON t.acc_id = srr.r_user_id where srr.r_prod_id='$id'");
         if ($query->execute()) {
             $result = $query->get_result();
             return $result;
         }
     }
}
