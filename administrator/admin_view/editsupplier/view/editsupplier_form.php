<?php 
$spl_id=$_GET["spl_id"];


$get_record = mysqli_query ($connections,"SELECT *
FROM supplier
WHERE spl_id = '$spl_id' ");
		$row = mysqli_fetch_assoc($get_record);
		$spl_id = $row["spl_id"];
         $spl_code = $row["spl_code"];
         $spl_name = $row["spl_name"];
         $spl_email = $row["spl_email"];
         $spl_contact = $row["spl_contact"];
         $spl_address = $row["spl_address"];
         $spl_date_added = $row["spl_date_added"];
         
         date_default_timezone_set('Asia/Manila');
         $currentDateTime = date('Y-m-d g:i:s A');     
?>



<style>
    .alert-danger {
        display: none;
       
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div class="page-wrapper">
<div class="content">
<div class="page-header">
<div class="page-title">
<h4>Supplier Management</h4>
<h6>Add/Update Customer</h6>
</div>
</div>

<div class="container text-center">

<div class="card">
    <div class="card-body">
        <div class="row">
            <input hidden type="text" value=<?=$spl_id?> id="spl_id" name="spl_id">
    <input hidden type="text" name="acc_id" value="<?= $db_acc_id?>" id="acc_id">
        <div class="row justify-content-center align-items-center">
    <div class="col-lg-3 col-sm-6 col-12">
        <div class="form-group">
            <label>Supplier Name</label>
            <input type="text" class="form-control" name="supplierName" id="supplierName" value="<?= $spl_name?>">
            <div style="display:none;" class="alert alert-danger" id="errorSupplierName" ></div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-12">
        <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control"  name="email" id="email" value="<?= $spl_email?>">
            <div style="display:none;" class="alert alert-danger" id="errorEmail"></div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-12">
        <div class="form-group">
            <label>Phone</label>
            <input type="text" class="form-control" name="phone" id="phone" value="<?= $spl_contact?>">
            <div style="display:none;" class="alert alert-danger" id="errorPhone"></div>
        </div>
    </div>
    <div class="col-lg-9 col-12">
        <div class="form-group">
            <label>Address</label>
            <textarea class="form-control" name="Address" id="address"><?= htmlspecialchars($spl_address) ?></textarea>

            <div style="display:none;" class="alert alert-danger" id="errorAddress"></div>
        </div>
    </div>
 

    <div class="col-lg-9">
        <div class="form-group">
        <button  type="button" id="btnAddSupplier" class="btn btn-submit me-2">Update</button>
        <a href="supplierlist.php" class="btn btn-cancel">Cancel</a>
        </div>
    </div>

</div>


        </div>
    </div>
</div>

</div>

</div>
</div>
</div>


<script src='editsupplier/controller/edit_supplier_validation.js'></script>