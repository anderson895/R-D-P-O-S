<?php
include('../class.php');
$db = new global_class();


session_start();

print_r($_SESSION);

    $orders = $db->getOrderStatusCounts();
   
