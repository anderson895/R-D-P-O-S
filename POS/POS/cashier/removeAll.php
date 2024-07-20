<?php
include "../../connection.php";

if(isset($_POST["btnRemoveAll"])){

    $pos_cart_user_id=$_POST["pos_cart_user_id"];

 mysqli_query($connections, "DELETE FROM pos_cart WHERE pos_cart_user_id ='$pos_cart_user_id'");
echo "<script>window.location.href='index.php';</script>";	     

}
?>