<?php 
include ("../connection.php");
$get_record = mysqli_query ($connections,"SELECT * FROM maintinance");
$row = mysqli_fetch_assoc($get_record);
$db_system_name = $row ["system_name"];
$db_system_logo = $row ["system_logo"];
$db_system_banner = $row ["system_banner"];
$db_system_tax = $row ["system_tax"];
$db_system_address = $row ["system_address"];
$db_system_content = $row ["system_content"];


?>	 