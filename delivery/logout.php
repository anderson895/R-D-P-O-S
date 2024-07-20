<?php
include "../connection.php";

session_start();
//$_SESSION['acc_id'] = "";
$acc_id = $_SESSION["acc_id"];

 // Redirect to customer
 date_default_timezone_set('Asia/Manila');
 $currentDateTime = date('Y-m-d g:i A');

 mysqli_query($connections, "UPDATE system_log SET sys_logout = '$currentDateTime' where sys_user_id ='$acc_id'");



session_unset();
session_destroy();
?>
<script language="javascript">
document.location="../Main/login.php";
</script>
