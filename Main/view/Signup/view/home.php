<?php
include "../connection.php";

session_start();
//$_SESSION['acc_id'] = "";
$acc_id = $_SESSION["acc_id"];



session_unset();
session_destroy();
?>
<script language="javascript">
document.location="../signin.php";
</script>
