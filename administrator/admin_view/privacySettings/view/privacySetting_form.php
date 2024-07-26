<form id="uploadForm" method="POST" enctype="multipart/form-data">
<div class="page-wrapper">
<div class="content">
<div class="page-header">
<div class="page-title">
<h4>Privacy Settings</h4>
<h6>User Profile</h6>
</div>
</div>



<div class="card">
<div class="card-body">
<div class="profile-set">
<div class="profile-head" style="background-image: url('../../upload_img/<?= $get_db_acc_cover_img?>'); background-size: cover; background-position: center center; background-repeat: no-repeat; height: 200px;" >
<?php 
if($db_acc_code===$get_db_acc_code_target){ 
echo '
<input style="display:none;" type="file" id="backgroundimage" name="backgroundimage" accept="image/*">
';}?>
<input hidden type="text" id='account_id' name='account_id' value='<?= $account_id?>'>
</div>
<div class="profile-top">
<div class="profile-content">
<div class="profile-contentimg">
<img src="<?php if($get_db_emp_image){ echo "../../upload_img/$get_db_emp_image";}else{ echo "../../upload_system/empty.png";} ?>" alt="img" id="profileImg">


</div>

<div class="profile-contentname">
<h2><?= $get_fullname?></h2>
<h4>Updates your password.</h4>
</div>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="profile/controller/controlls_ui.js"></script>

</div>

<input type="text" value="<?=$account_id?>" name="account_id" id="account_id" hidden>



<div class="col-lg-6 col-sm-12 mt-4">
<div class="form-group">
<label>New password</label>
<input type="password" placeholder="New password" name="newPsw" id="newPsw">
<div  style="color:red;" id="newPswLengthError"></div>
<div style="color:red;" id="newPswError"></div>
</div>
</div>



<div class="col-lg-6 col-sm-12 mt-4">
<div class="form-group">
<label>Confirm password</label>
<input type="password" placeholder="Confirm Password" name="confirmPsw" id="confirmPsw">
<div  style="color:red;" id="confirmPswLengthError"></div>
<div style="color:red;" id="confirmPswError"></div>
</div>
</div>






<?php if($db_acc_code===$get_db_acc_code_target){ 
echo '
<div class="col-lg-6 col-sm-12">
<div class="form-group">
<label>Enter Old Password</label>
<div class="pass-group">
<input type="password" name="Oldpassword" class="pass-input" id="oldPasword">
<div style="color:red;" id="oldpassError"></div>
<span class="fas toggle-password fa-eye-slash"></span>

</div>
</div>
</div>
'; }?>





<?php
if ($db_acc_code === $get_db_acc_code_target) {
    echo '<div class="col-12">
        <button type="button" id="submitButton" class="btn btn-submit me-2 toglerSaveDPandInfo" >Update</button>
        <button type="button" onclick="window.location.href=\'userlist.php\';" class="btn btn-cancel me-2">Cancel</button>
        <div class="error-message" style="color:red;" id="error-message"></div>
        <div class="success-message" style="color:green;" id="success-message"></div>

        
    </div>';
}
?>

</div>
</div>
</div>
</form>