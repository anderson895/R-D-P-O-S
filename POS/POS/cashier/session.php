
<?php 


session_start();


if(isset($_SESSION["acc_id"])){
	
			include ("../../connection.php");
		$acc_id = $_SESSION["acc_id"];
		$fullname="";		
		$get_record = mysqli_query ($connections,"SELECT * FROM account where acc_id='$acc_id' ");
		$row = mysqli_fetch_assoc($get_record);
		$db_acc_id = $row["acc_id"];
		
		$db_acc_fname = $row["acc_fname"];
		 $db_acc_lname = $row["acc_lname"];
		 $db_emp_image = $row["emp_image"];

		 $fullname=ucfirst($db_acc_fname)." ". $db_acc_lname;
		 $db_acc_contact = $row["acc_contact"];
		 $db_emp_address = $row["emp_address"];
		 $db_acc_username = $row["acc_username"];
		 $db_acc_password = $row["acc_password"];
		 $db_acc_username = $row["acc_username"];
		 $db_acc_type = $row["acc_type"];
		 $db_acc_email = $row["acc_email"];
		
		
		 
}else{
	
	echo "<script>window.location.href='../';</script>";
	
}
?>
