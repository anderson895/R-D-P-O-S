<?php
include "../../connection.php";

if(isset($_POST["btnRemove"])){

 $remove_id=$_POST["removeid"];

 mysqli_query($connections, "DELETE FROM pos_cart WHERE pos_cart_id ='$remove_id'");
 echo "<script>window.location.href='index.php';</script>";	     

}
?>