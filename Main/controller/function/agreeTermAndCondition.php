<?php 

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";


include("../../../connection.php");


session_start();

$db_acc_id=$_POST["accid"];

$_SESSION['acc_id']=$db_acc_id;





mysqli_query($connections, "UPDATE account SET acc_status='0', Otp='0', incorrect_attempts='0' WHERE acc_id='$db_acc_id'");

?>