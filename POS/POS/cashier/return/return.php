<?php 

include("navigation.php");


if(isset($_SESSION["acc_id"])){
    $acc_id = $_SESSION["acc_id"];
    
    $get_record = mysqli_query ($connections,"SELECT * FROM account where acc_id='$acc_id' ");
    $row = mysqli_fetch_assoc($get_record);
    $acc_type = $row ["acc_type"];
    if($acc_type =="customer"){
             //redirect administrator
             echo "<script>window.location.href='../../customer/home.php'</script>";	
 }else if($acc_type =="delivery person"){
             //redirect administrator
                echo "<script>window.location.href='../../delivery/';</script>";	      
    }else if($acc_type =="admin"){
                //redirect administrator
                   echo "<script>window.location.href='../../admin/';</script>";	      
   }
 }
?>

<style>
    .card-title:hover {
        color: red;
        cursor: pointer;
    }


    
</style>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
 
    <title>Return Item</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   
    <script src='js/purchased_method.js'></script>


   </head>
<body >
    <div class="container-fluid d-flex justify-content-center mb-2 text-center">

    <div class="card w-100">
        <div class="card-body">
            <h5>RETURN ITEM</h5>
        </div>
          <div class="container">
                  <div class="row justify-content-center">
                      <div class="col-md-6">
                          <div class="card">
                              <div class="card-body">
                                  <h5 class="card-title"
                                  class="btn btn-danger tugleReturn"  data-bs-toggle="modal" data-bs-target="#ModalReturn" 
                                  >RETURN FOR POS</h5>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="card">
                              <div class="card-body">
                                  <h5 class="card-title">RETURN FOR ONLINE ORDERING</h5>
                              </div>
                          </div>
                      </div>
                  </div>
            </div>
        <br>
        <div class="container-fluid">
        <div class="row justify-content">
            <div class="col-15">
                <div class="container-fluid d-flex justify-content-center mb-2">
                    <div class="card w-100">
                        <div class="card-body">
                            <select class="form-control" style="float: left; width: 15%;" id="purchaseMethod" onchange="showDiv()">
                                <option >PURCHASE METHOD</option>
                                <option value="pos">POINT OF SALE</option>
                                <option value="online">ONLINE ORDERING</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   

<?php include "return/order_in_pos.php"; ?>
<?php include "return/order_in_ordering.php"; ?>

<?php include "returnModal.php"; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
    
</body>
</html>