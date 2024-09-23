<?php 
include ("../../../connection.php");
if(isset($_GET['addressType'], $_GET['id'])){
    $addressType = $_GET['addressType'];
    $id = $_GET['id'];
    $sql = "SELECT * FROM `tbl_address` WHERE `$addressType` = '$id' AND `tbl_address`.`address_display_status`='1'";
    $result = mysqli_query($connections, $sql);
    if($result->num_rows > 0) {
        echo true;
    } else {
        echo 'wala';
    }
} else {
    'wala2';
}