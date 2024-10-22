<?php
include('../class.php');
$db = new global_class();


    $orders = $db->getCodCollectedCount($_SESSION['acc_id']);
   
