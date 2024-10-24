<form id="uploadForm" method="POST" enctype="multipart/form-data">
<div class="page-wrapper">
<div class="content">
<div class="page-header">
<div class="page-title">
<h4>Profile</h4>
<h6>Customer Profile

<?php
//echo"<br>db_acc_id".$db_acc_id;
//echo"<br>target_id".$target_id;
?>
</h6>
</div>
</div>


<div class="card">
<div class="card-body">
<div class="profile-set">
<div class="profile-head" style="background-image: url('../../upload_img/<?= $get_acc_cover_img?>'); background-size: cover; background-position: center center; background-repeat: no-repeat; height: 200px;" >
<?php 
if($db_acc_id===$target_id){ 
echo '
<input style="display:none;" type="file" id="backgroundimage" name="backgroundimage" accept="image/*">
';}?>
<input hidden type="text" id='account_id' name='account_id' value='<?= $target_id?>'>
</div>
<div class="profile-top">
<div class="profile-content">
<div class="profile-contentimg">
<img src="<?php if($get_emp_image){ echo "../../upload_img/$get_emp_image";}else{ echo "../../upload_system/empty.png";} ?>" alt="img" id="profileImg">

<?php 
if($db_acc_id===$target_id){ 
echo '
<div class="profileupload">
<input type="file" id="profileimage" name="profileimage" accept="image/*">
<a href="javascript:void(0);"><img src="assets/img/icons/edit-set.svg" alt="img"></a>
</div>
';}
?>
</div>

<div class="profile-contentname">
<h2><?= $get_full_name?></h2>
<h4>Updates Your Photo and Personal Details.</h4>
</div>
</div>

<?php 
if($db_acc_id===$target_id){ 
    echo '

    <div class="ms-auto" style="display:block;">
  
    <a id="editCover" ><i class="ion-edit" data-bs-toggle="tooltip" title="" data-bs-original-title="ion-edit" aria-label="ion-edit"></i>Edit Cover</a>
    </div>

    
    <div class="ms-auto" style="display:none;" id="saveCancelButtons">
    <button type="button" class="btn btn-submit me-2 toglerSaveProfile">Save</button>
    <a id="cancelButton" class="btn btn-cancel">Cancel</a>
    </div>


    ';} ?>


</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="profile/controller/controlls_ui.js"></script>

</div>


<?php 
if($db_acc_id!==$target_id){ 
    echo '
    <script>
    //background-color:transparent;
        document.addEventListener("DOMContentLoaded", function() {
          
            var firstNameInput = document.getElementById("firstname");
            var lastnameInput = document.getElementById("lastname");
            var emailInput = document.getElementById("email");
            var phoneInput = document.getElementById("phone");
            var usernameInput = document.getElementById("username");
           

            // Disable the input fields and remove borders
            firstNameInput.disabled = true;
            firstNameInput.style.border = "none";
            firstNameInput.style.backgroundColor = "transparent";

            lastnameInput.disabled = true;
            lastnameInput.style.border = "none";
            lastnameInput.style.backgroundColor = "transparent";

            emailInput.disabled = true;
            emailInput.style.border = "none";
            emailInput.style.backgroundColor = "transparent";
            
            phoneInput.disabled = true;
            phoneInput.style.border = "none";
            phoneInput.style.backgroundColor = "transparent";

            usernameInput.disabled = true;
            usernameInput.style.border = "none";
            usernameInput.style.backgroundColor = "transparent";

            selectionAccountType.disabled = true;
          

            age.disabled = true;
            age.style.border = "none";
        });
    </script>
    ';
}
?>



<div class="row">
<div class="col-lg-6 col-sm-12">
<div class="form-group">
<label>First Name</label>
<input type="text" placeholder="Juan" name="fname" value="<?= $get_acc_fname ?>" id='firstname'>
<div style="color:red;" id="fnameError"></div>
</div>
</div>
<div class="col-lg-6 col-sm-12">
<div class="form-group">
<label>Last Name</label>
<input type="text" placeholder="Dela cruz" name="lname" value="<?= $get_acc_lname ?>" id='lastname'>
<div style="color:red;" id="lnameError"></div>
</div>
</div>
<div class="col-lg-6 col-sm-12">
<div class="form-group">
<label>Email</label>
<?php 
if($db_acc_id===$target_id){
echo '
<input type="text" placeholder="william@example.com" value="'.$get_acc_email.'" name="email" id="email">';
 }else{
echo '
<input type="text" placeholder="william@example.com" value="'.$get_masked_email.'" name="email" id="email">';
 }?>
<div style="color:red;" id="emailError"></div>
</div>
</div>
<div class="col-lg-6 col-sm-12">
<div class="form-group">
<label>Phone</label>
<input type="text" placeholder="ex. 09454454744" value="<?= $get_acc_contact?>" id='phone' pattern="[0-9]{11}" >
</div>
</div>


<div class="col-lg-6 col-sm-12">
<div class="form-group">
<label>Username</label>
<input type="text" placeholder="Username" value="<?= $get_acc_username?>" name="username" id="username">
<div  style="color:red;" id="usernameLengthError"></div>
<div style="color:red;" id="usernameError"></div>
</div>
</div>

<div class="col-lg-6 col-sm-12">
<div class="form-group">
<label>Age</label>
<?php 
if($db_acc_id===$target_id){ 
echo "// ilagay dito ang birthday kapag ng may ari ng account";
}else{
echo '<input type="text" disabled style="border:none; background-color:transparent;" value="'.$age.'">';
} ?>


</div>
</div>

<hr>

<div class="col-lg-12">
<div class="form-group">
<label>Default Address</label>
<textarea disabled style="border:none; background-color:transparent;" class="form-control" name='pDescript' id="pDescript">
    
<?php  
if($get_user_complete_address){
    echo $get_user_complete_address;
}else{
    echo "No Selected Address";

}?>

</textarea>
<div style="display:none;" class="alert alert-danger" id="descriptionError"></div>
</div>
</div>







<?php 
if($db_acc_id===$target_id){ 
    echo '
<div class="col-lg-6 col-sm-12">
<div class="form-group">
<label>Password</label>
<div class="pass-group">
<input type="password" name="Oldpassword" class="pass-input" id="oldPasword">
<div style="color:red;" id="oldpassError"></div>
<span class="fas toggle-password fa-eye-slash"></span>

</div>
</div>
</div>
'; }?>





<?php
if($db_acc_id===$target_id){ 
    echo '<div class="col-12">
        <button type="button" id="submitButton" class="btn btn-submit me-2 toglerSaveDPandInfo">Submit</button>
        <button type="button" onclick="window.location.href=\'userlist.php\';" class="btn btn-cancel me-2">Cancel</button>
        <div class="error-message" style="color:red;" id="passwordError"></div>
        <div class="error-message" style="color:red;" id="errorText"></div>
    </div>';
}
?>

</div>
</div>
</div>
</form>