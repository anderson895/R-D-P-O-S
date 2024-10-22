<?php
include('../class.php');
$db = new global_class();

session_start();

    $orders = $db->getCodCollectedCount($_SESSION['acc_id']);
   
