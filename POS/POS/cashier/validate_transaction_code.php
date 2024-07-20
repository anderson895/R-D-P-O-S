
<?php
include("connection.php");
// Initialize variables to store error messages
$transaction_code = "";
$transaction_codeErr = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $transaction_codeErr="";
  $transaction_code=$_POST["transaction_code"];
  //$product_code=$_POST["product_code"];
  // Retrieve the form data
  //$check_prod_code = mysqli_query($connections,"SELECT * from product WHERE prod_code='$product_code'");
	//$check_prod_code_row = mysqli_num_rows ($check_prod_code);
  //$prod_id  = $row["prod_id"];


  $check_transaction_code = mysqli_query($connections,"SELECT * from pos_orders WHERE orders_tcode='$transaction_code'");
	$check_transaction_code_row = mysqli_num_rows ($check_transaction_code);

		if($check_transaction_code_row  > 0){
      
      $transaction_codeErr="200";
      
      
    }else{
       $transaction_codeErr="403";
    }

    echo $transaction_codeErr;
}
?>
