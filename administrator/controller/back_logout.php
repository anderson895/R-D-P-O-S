<?php
session_start();
$_SESSION['acc_id'] = "";
session_unset();
session_destroy();
?>
<script language="javascript">
document.location="../Main/login.php";
</script>