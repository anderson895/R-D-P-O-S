<?php
include "../../connection.php";

include("navigation.php");
include "controller/online/insert_data.php";
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
?>


<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="author" content="Bootstrap-ecommerce by Vosidiy">

<title><?php echo $db_system_name ?></title>
<link rel="shortcut icon" type="image/x-icon" href="../upload_system/<?php echo $db_system_logo ?>" >
<link rel="apple-touch-icon" sizes="180x180" href="../upload_system/<?php echo $db_system_logo ?>">
<link rel="icon" type="image/png" sizes="32x32" href="../upload_system/<?php echo $db_system_logo ?>">
<!-- jQuery -->
<!-- Bootstrap4 files-->
<link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css"/> 
<link href="assets/css/ui.css" rel="stylesheet" type="text/css"/>
<link href="assets/fonts/fontawesome/css/fontawesome-all.min.css" type="text/css" rel="stylesheet">
<!--<link href="assets/css/OverlayScrollbars.css" type="text/css" rel="stylesheet"/>-->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">  
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />

    <script>

$(document).ready(function () {
    $('#example').DataTable();
});
</script>
 <!-- Main -->
 <main class="main-container p-5" style="z-index:2" >
 

    <div class="fluid-container">
       <center> <h1>Return Records from Online Orders</h1></center>
                 



        <div class="row">
            <div class="col-auto ms-auto m-3">
                <button class="btn btn-success addToggler" data-bs-toggle="modal" data-bs-target="#request">Add Record</button>
            </div>
        </div>

        <!--newest and oldest dropdown--->
<div class="row mb-3">
    <div class="col-auto "> <!-- Use "mx-auto" class to center the div horizontally -->
        <div class="btn-group">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Sort by Date
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" id="newestToOldestBtn">Newest to Oldest</a>
                <a class="dropdown-item" id="oldestToNewestBtn">Oldest to Newest</a>
            </div>
        </div>
    </div>
</div>
<!-- newest and oldest dropdown --->

        <div class="table-responsive card">


            <table id="example" class="table table-striped" style="width:100%">
            
                <thead>
                  
                    <tr>
                      
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Request</th>
                        <th>Quantity</th>
                        <th>Reason</th>
                        <th>Date</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php
                    $view_query = mysqli_query($connections, "SELECT * FROM return_ordering
                    ORDER BY ret_ol_date DESC");



                   while ($row = mysqli_fetch_assoc($view_query)) {
                       $ret_id = $row["ret_ol_id"];
                       $ret_date = $row["ret_ol_date"];
                       $ret_datepurchase = $row["ret_ol_datepurchase"];
                       $ret_transaction_code = $row["ret_ol_transaction_code"];
                       $ret_product_code = $row["ret_ol_product_code"];
                       $ret_qty = $row["ret_ol_qty"];
                       $ret_request = $row["ret_ol_request"];
                       $ret_reason = $row["ret_ol_reason"];
                       $ret_customer_name = $row["ret_ol_customer_name"];
                       $ret_contact_number = $row["ret_ol_contact_number"];
                       $ret_address = $row["ret_ol_address"];
                   
                       $get_prod = mysqli_query($connections, "SELECT * FROM product WHERE prod_code='$ret_product_code'");
                       $prodrow = mysqli_fetch_assoc($get_prod);
                       $get_prod_name = $prodrow["prod_name"];
                       $get_prod_image = $prodrow["prod_image"];
                   
                       $ret_date = date("M j Y, g:ia", strtotime($ret_date));
                       $ret_datepurchase = date("M j Y, g:ia", strtotime($ret_datepurchase));
                   
                        

                        ?>
                        <tr>
                            <td><?= $ret_product_code ?></td>
                            <td><?= $get_prod_name ?></td>
                            <td><?= $ret_request ?></td>
                            <td><?= $ret_qty ?></td>
                            <td><?= $ret_reason ?></td>
                            <td><?= $ret_date ?></td>
                            <td class="text-center">
                                <button class="form-control btn btn-secondary toglerView"
                                data-bs-toggle="modal" data-bs-target="#ModalViewReturn"
                                data-ret_id="<?= $ret_id ?>"
                                data-ret_date="<?= $ret_date ?>"                              
                                data-ret_datepurchase="<?= $ret_datepurchase ?>"
                                data-ret_transaction_code="<?= $ret_transaction_code ?>"
                                data-ret_product_code="<?= $ret_product_code ?>"
                                data-ret_qty="<?= $ret_qty ?>"
                                data-ret_request="<?= $ret_request ?>"
                                data-ret_reason="<?= $ret_reason ?>"
                                data-ret_customer_name="<?= $ret_customer_name ?>"
                                data-ret_contact_number="<?= $ret_contact_number ?>"
                                data-ret_address="<?= $ret_address ?>"
                                data-get_prod_name="<?= $get_prod_name ?>"
                                data-get_prod_image="<?= $get_prod_image ?>"

                                
                                


                                >VIEW</button>

                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="request" tabindex="-1" aria-labelledby="orderLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Return</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!----request info---->
        <div id="viewReceipt" class="col-sm-12 mb-2" >

        
        <form method="POST" action="controller/online/insert_data.php" >
          
        <div class="row">
  <div class="col-sm-auto ms-auto mb-2">
    
    <div class="form-group form-group-default d-flex">
      
      <input style="width:200px;" type="text" value="<?= $tcode ?>" placeholder="Enter Transaction Code" name="tcode" class="form-control" >
      <button class="btn btn-success ml-2" id="displayRecordsBtn">View Record</button>
      
    </div>
    <div  id="statusMessage"></div>
  </div>
</div>

          <div class="table-responsive">
          <div class="container d-flex justify-content-center">
          <table id="productTable" class="table">
              <thead>
                <tr>
                  <th >
                   <div id="checkAllDiv" style="display: none;"> All <input type="checkbox" id="checkAll"></div>
                
                 </th>
                  <th>Code</th>
                  <th>Product</th>
                  <th class="text-center">Return Qty</th>
                  
                  <!-- Add more columns as needed -->
                </tr>
              </thead>
              <tbody id="productTableBody"></tbody>
            </table>
            
          </div>
          </div>
          </div>
        <!----request info---->
<div id="requestInfo" class="col-sm-12 mb-2" style="display: none;">
  <div class="form-group form-group-default">
    <label>Return Request</label>
    <br>
    <select name="Request" id="selectRequest" class="form-control">
      <option value="" disabled> Select </option>
      <option value="return"> Return </option>
      <option value="refund"> Refund </option>
    </select>
  </div>

  <div class="form-group form-group-default">
    <label>Reason for return</label>
    <br>
    <input type="text" class="form-control" name="reason" id="reasonInput" placeholder="Enter Reason">
  </div>
</div>
<!-------->

           <!----Personal info---->
           <div id="Personal_info" class="col-sm-12 mb-2" style="display: none;">
              <div class="form-group form-group-default">
                <label>Customer Name</label>
                <br>
                <input type="text" name="cname" id="cname" class="form-control" placeholder="Enter Name" required>
              </div>

              <div class="form-group form-group-default">
                <label>Contact Number</label>
                <br>
               <input type="text" name="cnom" id="cnom" class="form-control" placeholder="Enter Contact Number" required>
              </div>

              <div class="form-group form-group-default">
                <label>Address</label>
                <br>
               <input type="text" name="address" id="address" class="form-control" placeholder="Enter Address" required>
              </div>
          </div>
          <!-------->


          <div class="modal-footer">
            <!-- Refund Status Display -->
           <!-- page 1-->
           <button id="nextButton" class="btn btn-primary" style="display: none;">Next</button>

            <!-- page2 -->
            <button id="backButton" class="btn btn-primary" style="display: none;">Back</button>
            <button id="nextButton2" class="btn btn-primary" style="display: none;">Next</button>
          <!-- page3 -->
            <button id="backButton2" class="btn btn-primary" style="display: none;">Back</button>
             <button id="buttonSUbmit" name="buttonSUbmit" type="submit" class="btn btn-primary" style="display: none;">Submit</button>
          </div>
        </form>

        <center><i>Note: Medicines cannot be returned</i></center>

      </div>
    </div>
  </div>
</div>



   <!-- Modal -->
<div class="modal fade" id="ModalViewReturn" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">View Return Record</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Return Date</th>
                <th>Transaction#</th>
                <th>Product#</th>
                <th>Product</th>
                <th>Request</th>
                <th>Qty</th>
                <th>Reason</th>
                <th>Customer</th>
                <th>Contact#</th>
                <th>Address</th>
                <th>Image</th>
              </tr>
            </thead>
            <tbody id="tbody">
              <tr>
                <td id="ret_date"></td>
                <td id="ret_transaction_code"></td>
                <td id="ret_product_code"></td>
                <td id="get_prod_name"></td>
                <td id="ret_request"></td>
                <td id="ret_qty"></td>
                <td id="ret_reason"></td>
                <td id="ret_customer_name"></td>
                <td id="ret_contact_number"></td>
                <td id="ret_address"></td>
                <td id="ret_image"></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>





<script src='controller/online/js/checkAll.js'></script>

<script src='controller/online/js/returnAjax.js'></script>

<script src='controller/online/js/divPage.js'></script>

<script src='controller/online/js/form.js'></script>


<script src='controller/online/js/togler.js'></script>

<script src='controller/online/js/table.js'></script>

<script src='controller/online/js/validation.js'></script>
