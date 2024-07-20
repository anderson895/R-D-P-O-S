<?php


include ("connection.php");
session_start();

if(isset($_SESSION["acc_id"])){
    $acc_id = $_SESSION["acc_id"];
    
    $get_record = mysqli_query ($connections,"SELECT * FROM account where acc_id='$acc_id' ");
    $row = mysqli_fetch_assoc($get_record);
    $acc_type = $row ["acc_type"];
    if($acc_type =="administrator"){
             //redirect administrator
             echo "<script>window.location.href='../administrator/adminpages/index.php'</script>";	
 }else if($acc_type =="delivery person"){
             //redirect administrator
                echo "<script>window.location.href='../delivery/';</script>";	      
 }else if($acc_type =="cashier"){
        
                echo "<script>window.location.href='cashier/index.php';</script>";	
}else{
				echo "<script>window.location.href='../login.php';</script>";	  
	  }
 }

?>