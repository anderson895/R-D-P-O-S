<?php

$get_record = mysqli_query ($connections,"SELECT *
FROM maintinance ");
		$row = mysqli_fetch_assoc($get_record);
		 $db_system_id = $row["system_id"];
         $db_system_name = $row["system_name"];
         $db_system_banner = $row["system_banner"];
         $db_system_logo = $row["system_logo"];
         $db_system_content = $row["system_content"];
         $db_system_address = $row["system_address"];
         $db_system_contact = $row["system_contact"];
         $db_system_tax = $row["system_tax"];
        
         
         date_default_timezone_set('Asia/Manila');
         $currentDateTime = date('Y-m-d g:i:s A');     
?>

<form method="POST" enctype="multipart/form-data">
<div class="page-wrapper">
<div class="content">
<div class="page-header">
<div class="page-title">
<h4>Update setting</h4>
</div>
</div>
<input hidden type="text" id="acc_id" name="acc_id" value="<?= $db_acc_id?>">

<div class="card">
<div class="card-body">
<div class="row">


<div class="col-lg-3 col-sm-6 col-12">
<div class="form-group">
<label>System Name</label>
<input type="text" placeholder="System name" value="<?= $db_system_name?>" name="sname" id="sname">
<div style="display:none;" class="alert alert-danger" id="errorSname"></div>
</div>
</div>


<div class="col-lg-3 col-sm-6 col-12">
<div class="form-group">
<label>Contact</label>
<input type="text" placeholder="Product name" value="<?= $db_system_contact?>" name="contact" id="contact">
<div style="display:none;" class="alert alert-danger" id="errorContact"></div>
</div>
</div>



<div class="col-lg-12">
<div class="form-group">
<label>Store address</label>
<textarea class="form-control" name='saddress' id="saddress"><?=$db_system_address?></textarea>
<div style="display:none;" class="alert alert-danger" id="StoreError"></div>
</div>
</div>





<div class="col-lg-12">
<div class="form-group">
<label>Content</label>
<textarea class="form-control" name='scontent' id="scontent"><?=$db_system_content ?></textarea>
<div style="display:none;" class="alert alert-danger" id="contentError"></div>
</div>
</div>



<div class="col-lg-12">
<div class="form-group">
<label style="text-align: left;"> Logo </label>
<div class="image-upload">
<input type="file" name="img_log" id="img_log" accept=".jpg, .jpeg, .png">

<div class="image-uploads" >
<img src="assets/img/icons/upload.svg" alt="img">
<h4 style="text-align: left;">Drag and drop a file to upload</h4>
<div style="display:none; text-align: left;" class="alert alert-danger" id="img_logError"></div>
</div>
</div>
</div>
</div>

<div class="col-12">
    
<div class="product-list">
<ul class="row">
<li>
<div class="productviews">
<div class="productviewsimg">
    <?php 
    if($db_system_logo){
echo '<img id="systemImagePreview_logo" src="../../upload_system/'.$db_system_logo.'" alt="img">';
    }else{
echo '<img id="systemImagePreview_logo" src="#" alt="img">';
    } ?>

</div>

<div class="productviewscontent">
<div class="productviewsname">
<h2><?=$db_system_logo?></h2>

</div>
</div>
</div>
</li>
</ul>
</div>
</div>



<div class="col-lg-12">
<div class="form-group">
<label style="text-align: left;"> Banner</label>
<div class="image-upload">
<input type="file" name="sImg_banner" id="sImg_banner" accept=".jpg, .jpeg, .png, .gif">
<div class="image-uploads" >
<img src="assets/img/icons/upload.svg" alt="img">
<h4 style="text-align: left;">Drag and drop a file to upload</h4>
<div style="display:none; text-align: left;" class="alert alert-danger" id="errorPname_bannerError"></div>
</div>
</div>
</div>
</div>
<div class="col-12">
<div class="product-list">
<ul class="row">
<li>
<div class="productviews">
<div class="productviewsimg">
    <?php 
    if($db_system_banner){
echo '<img id="systemImagePreview_banner" src="../../upload_system/'.$db_system_banner.'" alt="img">';
    }else{
echo '<img id="systemImagePreview_banner" src="#" alt="img">';
    } ?>

</div>

<div class="productviewscontent">
<div class="productviewsname">
<h2><?=$db_system_banner?></h2>

</div>
</div>
</div>
</li>
</ul>
</div>
</div>


<div class="col-lg-3 col-sm-6 col-6">
  <div class="form-group">
    <label>Vat tax</label>
    <div style="position: relative;">
      <input type="text" placeholder="Vat tax" id="tax" value="<?=$db_system_tax?>" style="padding-right: 20px;">
      <span style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);">%</span>
    </div>
  </div>
</div>



<div class="col-lg-12">
<button type="button" class="btn btn-submit me-2" disabled name="btnSubmit" id='btnSubmit'>Save</button>
<a href="productlist.php" class="btn btn-cancel">Cancel</a>
</div>
</div>
</div>
</div>
</form>



<script>
document.getElementById("btnSubmit").addEventListener("click", function() {
  var accId = document.getElementById("acc_id").value;
  var systemName = document.getElementById("sname").value;
  var contact = document.getElementById("contact").value;
  var storeAddress = document.getElementById("saddress").value;
  var content = document.getElementById("scontent").value;
  var tax = document.getElementById("tax").value;
  
  var imgLogFile = document.getElementById("img_log").files[0];
  var sImgBannerFile = document.getElementById("sImg_banner").files[0];
  
  var formData = new FormData();
  formData.append("tax", tax);
  formData.append("acc_id", accId);
  formData.append("sname", systemName);
  formData.append("contact", contact);
  formData.append("saddress", storeAddress);
  formData.append("scontent", content);
  formData.append("img_log", imgLogFile);
  formData.append("sImg_banner", sImgBannerFile);

  
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "managesystem_settings/controller/updateSettingsProcess.php", true);
  xhr.onload = function() {
    if (xhr.status === 200) {
      // Handle the response from the server if needed
      console.log(xhr.responseText);
      location.reload();
    } else {
      // Handle errors here
      console.error("Request failed with status:", xhr.status);
    }
  };
  xhr.send(formData);
});

</script>


<script src='managesystem_settings/controller/validation.js'></script>
