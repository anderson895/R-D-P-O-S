<?php
include "../connection.php";
include("checkout.php");
include("navigation.php");
if(isset($_SESSION["acc_id"])){
    $acc_id = $_SESSION["acc_id"];
    
    $get_record = mysqli_query ($connections,"SELECT * FROM account where acc_id='$acc_id' ");
    $row = mysqli_fetch_assoc($get_record);
    $acc_type = $row ["acc_type"];
    if($acc_type =="administrator"){
             //redirect administrator
             echo "<script>window.location.href='../administrator/'</script>";	
 }else if($acc_type =="delivery person"){
             //redirect administrator
                echo "<script>window.location.href='../delivery/';</script>";	      
 }else if($acc_type =="cashier"){
}else{
				echo "<script>window.location.href='../';</script>";	  
	  }
 }


 $current_date = date("Y-m-d"); // Get the current date
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/pos.css">
    <link rel="icon" href="../assets/images/logos.png" type="image/x-icon">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <title>RDPOS-Pos</title>

</head>
<body>
    
    <div class="main-screen">
        <div class="validation-compatibility">
                    <p class="message">This system isn't compatible with mobile view</p>
        </div>
        <?php 
        include "view/index/list_product.php";
        ?>
         <?php 
        include "view/index/cart_list.php";
        ?>

       
        

    </div>
    
<?php 
include "view/index/modal.php";
?>

<!--START--->
<!-- ========================= SECTION CONTENT END// ========================= -->
<script src="assets/js/jquery-2.0.0.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.bundle.min.js" type="text/javascript"></script>

<script src="function/function.js"></script>
<script src="function/togler.js"></script>

<script>
document.getElementById("finalTotalDisplay").textContent = "<?php echo number_format($totalSum, 2, '.', ',') ?>";


   var finalTotal = <?php echo $finalTotal ?>; // Get the initial final total value from PHP
   var taxRate = <?php echo $db_system_tax ?>;
</script>

    
</body>
</html>