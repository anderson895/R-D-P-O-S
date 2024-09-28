
<?php 

$acc_code=$_GET["acc_code"];

$get_record = mysqli_query($connections,"SELECT * FROM account WHERE acc_code='$acc_code'");
$get_record_num = mysqli_num_rows($get_record);

if($get_record_num > 0 ){
	while($rows = mysqli_fetch_assoc($get_record)){
	
	 $db_acc_username = $rows["acc_username"];
	 $db_acc_password = $rows["acc_password"];
	 $db_acc_fname = $rows["acc_fname"];
	 $db_acc_lname = $rows["acc_lname"];
     $db_acc_email = $rows["acc_email"];
     $db_acc_contact = $rows["acc_contact"];
     $db_acc_type = $rows["acc_type"];
     $db_emp_image = $rows["emp_image"];
	 
	}
}
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<div class="page-wrapper">
<div class="content">
<div class="page-header">
<div class="page-title">
<h4>User Management</h4>
<h6>Add/Update User</h6>
</div>
</div>

<form method="POST">
<input hidden  type="text" id="session_code" value="<?= $db_acc_code?>">
<input hidden  type="text" id="acc_code" value="<?= $acc_code?>">
<input hidden  type="text" id="account_id" value="<?= $db_acc_id?>">
<div class="card">
<div class="card-body">
<div class="row">
<div class="col-lg-3 col-sm-6 col-12">
<div class="form-group">
<label>First Name</label>
<input type="text" id='fname' value='<?=$db_acc_fname?>'>
<div style="color:red;" id="fnameError"></div>
</div>
</div>



<div class="col-lg-3 col-sm-6 col-12">
<div class="form-group">
<label>Last Name</label>
<input type="text" id='lname' value="<?=$db_acc_lname?>">
<div style="color:red;" id="lnameError"></div>
</div>
</div>




<div class="col-lg-3 col-sm-6 col-12">
<div class="form-group">
<label>User Name</label>
<input type="text" id="username" value="<?= $db_acc_username?>">
<div style="color:red;" id="usernameError"></div>
<div style="color:red;" id="usernameLengError"></div>
</div>
</div>



<div class="col-lg-3 col-sm-6 col-12">
<div class="form-group">
<label>Phone</label>
<input type="text" id='phone' value="<?=$db_acc_contact?>">
<div style="color:red;" id="phoneError"></div>
</div>
</div>



<div class="col-lg-3 col-sm-6 col-12">
<div class="form-group">
<label>Email</label>
<input type="text" id="email" value='<?= $db_acc_email?>'>
<div style="color:red;" id="emailError"></div>
</div>
</div>



<div class="col-lg-3 col-sm-6 col-12">
    <div class="form-group">
        <label>Account type</label>
        <select class="select" id="selectionAccountType"  required>
            <option value="Select">Select</option>
            <option <?php if($db_acc_type=="cashier"){ echo"selected";}?> value="cashier">Cashier</option>
            <option <?php if($db_acc_type=="deliveryStaff"){ echo"selected";}?> value="deliveryStaff">Delivery staff</option>
            <option <?php if($db_acc_type=="administrator"){ echo"selected";}?> value="administrator">Administrator</option>
        </select>
        <div class="error-message" style="color: red;" id="accountTypeError"></div>
    </div>
</div>


<div class="col-lg-3 col-sm-6 col-12">
<div class="form-group">
<label>New Password</label>
<div class="pass-group">
<input type="password" class=" pass-input" id='password'>
<span class="fas toggle-password fa-eye-slash"></span>
</div>
<div class="error-message" style="color:red;" id="passwordError"></div>
</div>
</div>


<div class="col-lg-3 col-sm-6 col-12">
<div class="form-group">
<label>Confirm Password</label>
<div class="pass-group">
<input type="password" class=" pass-input" id='cunfirmpassword'>
<span class="fas toggle-password fa-eye-slash"></span>
</div>
<div class="error-message" style="color:red;" id="cunfirmpasswordError"></div>
</div>
</div>








<div class="col-lg-12">
<div class="form-group">
<label> User Image</label>
<div class="image-upload">
<input type="file" id='UserimageUpload'accept="image/*">
<div class="image-uploads">
<img src="assets/img/icons/upload.svg" alt="img">
<h4>Drag and drop a file to upload</h4>
</div>
<div class="error-message" style="color:red;" id="UserimageUploadError"></div>
</div>
</div>
</div>


<div class="col-12">
<div class="product-list">
<ul class="row">
<li>
<div  class="productviews">
<div class="productviewsimg">
<img src="<?php if($db_emp_image){ echo "../../upload_img/$db_emp_image";}else{ echo "../../upload_system/empty.png";} ?>" alt="img">

<div class="productviewscontent">
<div class="productviewsname">
</div>







</div>
</div>
</li>
</ul>
</div>
</div>


<div class="col-lg-12">
<button type="button" disabled class="btn btn-submit me-2" id='submitButton'>Submit</button>
<a href="userlist.php" class="btn btn-cancel">Cancel</a>
</div>


<script>
        $(document).ready(function () {
            $('#UserimageUpload').change(function () {
                var input = this;
                var imageUploadError = $('#UserimageUploadError');
                var productViews = $('.productviews');

                if (input.files && input.files[0]) {
                    var file = input.files[0];
                    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif|\.webp)$/i;


                    if (!allowedExtensions.exec(file.name)) {
                        // Display an error message if the file is not an image
                        imageUploadError.text("Only image files are allowed (jpg, jpeg, png, gif, webp).");
                        input.value = '';
                    } else {
                        // Clear the error message, show the product view, and display the selected image
                        imageUploadError.text('');
                        productViews.removeAttr('hidden');
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            $('.productviewsimg img').attr('src', e.target.result);
                        };
                        reader.readAsDataURL(file);
                    }
                }
            });




                                            $('#submitButton').click(function () {
                                        // Kunin ang lahat ng data mula sa mga field
                                        var acc_code = $('#acc_code').val();
                                        var fname = $('#fname').val();
                                        var lname = $('#lname').val();
                                        var username = $('#username').val();
                                        var phone = $('#phone').val();
                                        var email = $('#email').val();
                                        var accountType = $('#selectionAccountType').val();
                                        var password = $('#password').val();
                                        var confirmPassword = $('#cunfirmpassword').val();
                                        var userImage = $('#UserimageUpload')[0].files[0];

                                        // Gumawa ng FormData object para sa pag-post ng mga file
                                        var formData = new FormData();
                                        formData.append('acc_code', acc_code);
                                        formData.append('fname', fname);
                                        formData.append('lname', lname);
                                        formData.append('username', username);
                                        formData.append('phone', phone);
                                        formData.append('email', email);
                                        formData.append('accountType', accountType);
                                        formData.append('password', password);
                                        formData.append('confirmPassword', confirmPassword);
                                        formData.append('userImage', userImage);

                                        // Gumawa ng Ajax request
                                       $.ajax({
                                            url: 'edituser/controller/editUserProcess.php', // I-update ito sa tamang path ng iyong PHP file
                                            type: 'POST',
                                            data: formData,
                                            contentType: false,
                                            processData: false,
                                            success: function (response) {
                                                // I-handle ang response dito kung kinakailangan
                                                // window.location.href = 'userlist.php';
                                                console.log(response)

                                            }
                                        });
                                        
                                        
                                    });
        });
    </script>
<?php include "edituser/view/modal.php";?>
<script src="edituser/javascript/email_validation.js"></script>