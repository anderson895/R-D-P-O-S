<?php 

include("backend/session.php");
include("backend/back_navbar.php");

include "controller/function/voucher.php";
include "controller/function/count.php";
include "controller/function/session_Dir.php";

?>
<!DOCTYPE html>
<html>
<style>
</style>
<head>
   <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place order</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	
    <link rel="stylesheet" href="css/notification.css">
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="css/location.css">

</head>

<body class="sb-nav-fixed">
       <?php include "view/nav.php";?>
   <div id="layoutSidenav">
       <div id="layoutSidenav_nav">
       <?php include "view/sidebar.php";?>
       </div>
       <div id="layoutSidenav_content">
           <main>
<br><br><br>

  <!-- header -->
  <form action="back_ordering.php" method="POST" enctype="multipart/form-data">

 

    <div class="container">
		<div class="my-3">
			<div class="card rounded-0 shadow">
				<div class="card-body">
					<div class="container-fluid">
						<div class='row'>
                            
<div class="col-md-6 lh-1">
                            
    <?php date_default_timezone_set('Asia/Manila'); $currentDateTime = date('Y-m-d g:i A'); ?>
    <?php SelectAddress($connections); ?>
    <hr>
            <div class="mb-3">
            <div class="row">
                <div class="col text-end">
                    <button class="btn btn-danger btn-sm" >
                        <i class="fa fa-plus"></i> <!-- Pencil icon -->
                    </button>
                    <button class="btn btn-danger btn-sm">
                        <i class="fa fa-trash"></i> <!-- Trash icon -->
                    </button>
                    <button class="btn btn-danger btn-sm" id="sendDataButton">
                        <i class="fa fa-pencil"></i>
                    </button>
                    
                </div>
             </div>
             </div>
    <h3>Date</h3>
    <p class="mb-1"><?php echo $currentDateTime; ?></p>
    <br>
    <p class="mb-1">
    </p>
    <h4>Name on your street</h4>
    <?php echo ucfirst($db_acc_fname) ?>
    </p>
    <h4>Contact</h4>
    <?php echo $db_acc_contact ?>
    </p>
    <h4>Delivery Address</h4>
    <div class="mb-3">
        <?= $user_complete_address ?>
    </div>
    <h4>Email</h4>
    <?php echo $db_acc_email ?>
    </p>
</div>


                            <div class="col-md-6 lh-1" style="display: none;">
        
                            
                            <div class="mb-3 text-end">
                                <button class="btn btn-danger btn-sm" id="saveButton">
                                    <i class="fa fa-save"></i> Save
                                </button>
                                <button class="btn btn-danger btn-sm" id="cancelButton">
                                    <i class="fa fa-close"></i> Cancel
                                </button>
                            </div>

                            <h3>Date</h3>
								<p class="mb-1"><?php echo $currentDateTime;?></p>
                                <input type="hidden" value="<?php echo $currentDateTime; ?>" name="timeOrder">
                                 <input type="hidden" value="PickUp" name="orderMethod">
                                <br>
                                <p class="mb-1">
                                <input type="hidden" class="form-control" name="customer_id" value="<?php echo $db_acc_id?>"  style="width:250;" required>
                                
                               </p>

                             
                               <h4>Name on your street</h4>
                                <input type="text"  class="form-control" name="nickname" value="<?php echo ucfirst($db_acc_fname)?>" placeholder="Item Name" style="width:250;" required>
                               
                            </p>
                          
                               <h4>Contact</h4>
                                <input type="text"  class="form-control" name="contact" value="<?php echo $db_acc_contact?>" placeholder="Item Name" style="width:250;" required>
                               
                            </p>
                               <h4>Delivery Address</h4>
                            <div class="mb-3">
                                <textarea name="deliveryaddress" id="address" class="form-control" rows="3" placeholder="Enter Address" style="width: 100%;" required><?= $user_complete_address?></textarea>
                              
                            </div>
                                <h4>Email</h4>
                                <input type="text" class="form-control" name="email" value=" <?php echo $db_acc_email?>" placeholder="Email" style="width:250;" required>
                              
                            </p>
                            <?php include "view/cart/api/view_mylocation.php"?>   
							</div>


	<div class="col-md-6 lh-1">
    <h3>Order Summary</h3>
  <?php 
  generateDiscountSelect($connections);
  ?>

    <br><br>
   <?php include "controller/function/list_checkout.php"; ?>

   
   <center><p class="mb-4"><strong>Subtotal</strong>:₱ <span id="order-total"><?php echo number_format($total_bill, 2, '.', ',') ?></span></p></center>

    <center><p class="mb-4"><strong>VAT</strong>(<?php echo ($db_system_tax*100) ?>%):₱ <?=number_format($get_taxt_value,2)?> </p></center>
   
    <center><p class="mb-4"><strong >Shipping fee</strong>:₱ <font id="shipFee"><?php echo number_format($address_rate, 2) ?></font></p></center>

    <center>
         <p class="mb-4" hidden><strong>Voucher name: </strong><span id="discountnameTxt"></span>
          
         <span id="voucher_discount"></span>%</p>
         
        
    </center>
    
    <center>
        
        <hr>      
        <p class="mb-4"><strong>Grand Total</strong>:<br>
        <span id="OldTotal_amount"></span>  
        <br>₱
        <span id="total_amount"> <?php echo number_format($order_final= $subtotal_deducted_tax + $address_rate, 2, '.', ',') ?></span></p>
    </center>
</div>
					</div>
				</div>
				<div class="card-footer py-1">
					<div class="row justify-content-center">
						<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
							<div class="d-grid">
                <button type="button" class="btn btn-dark placeOrder" data-bs-toggle="modal" data-bs-target="#exampleModal"> Place Order </button>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
<?php include "view/checkout/modal.php";?>
</form>
</main>


                        <footer >
                             <?php  include "view/footer.php";  ?>
                        </footer>
                     </div>
              </div>
        </div>
    </div>
</body>
</html>