
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
<input hidden type="text" id="account_id" value="<?= $db_acc_id?>">
<div class="card">
<div class="card-body">
<div class="row">
<div class="col-lg-3 col-sm-6 col-12">
<div class="form-group">
<label>First Name</label>
<input type="text" id='fname'>
<div style="color:red;" id="fnameError"></div>
</div>
</div>



<div class="col-lg-3 col-sm-6 col-12">
<div class="form-group">
<label>Last Name</label>
<input type="text" id='lname'>
<div style="color:red;" id="lnameError"></div>
</div>
</div>







<div class="col-lg-3 col-sm-6 col-12">
<div class="form-group">
<label>User Name</label>
<input type="text" id="username">
<div style="color:red;" id="usernameError"></div>
<div style="color:red;" id="usernameLengError"></div>
</div>
</div>



<div class="col-lg-3 col-sm-6 col-12">
<div class="form-group">
<label>Phone</label>
<input type="text" id='phone'>
<div style="color:red;" id="phoneError"></div>
</div>
</div>



<div class="col-lg-3 col-sm-6 col-12">
<div class="form-group">
<label>Email</label>
<input type="text" id="email">
<div style="color:red;" id="emailError"></div>
</div>
</div>



<div class="col-lg-3 col-sm-6 col-12">
    <div class="form-group">
        <label>Account type</label>
        <select class="select" id="selectionAccountType"  required>
            <option value="Select">Select</option>
            <option value="cashier">Cashier</option>
            <option value="deliveryStaff">Delivery staff</option>
            <option value="administrator">Administrator</option>
        </select>
        <div class="error-message" style="color: red;" id="accountTypeError"></div>
    </div>
</div>




<div class="col-lg-3 col-sm-6 col-12">
<div class="form-group">
<label>Password</label>
<div class="pass-group">
<input type="password" class=" pass-input" id='password'>
<span class="fas toggle-password fa-eye-slash"></span>
</div>
<div class="error-message" style="color:red;" id="passwordError"></div>
</div>
</div>


<div class="col-lg-3 col-sm-6 col-12">
<div class="form-group">
<label>Cunfirm Password</label>
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

<hr>

<div class="col-lg-3 col-sm-6 col-12">
    <div class="form-group">
        <label>Region</label>
        <select class="select" id="region" name="region"  required></select>
        <div class="error-message" style="color: red;" id="accountTypeError"></div>
    </div>
</div>
<div class="col-lg-3 col-sm-6 col-12">
    <div class="form-group">
        <label>Province</label>
        <select class="select" id="province" name="province" required></select>
        <div class="error-message" style="color: red;" id="accountTypeError"></div>
    </div>
</div>
<div class="col-lg-3 col-sm-6 col-12">
    <div class="form-group">
        <label>City</label>
        <select class="select" id="city" name="city"  required></select>
        <div class="error-message" style="color: red;" id="accountTypeError"></div>
    </div>
</div>
<div class="col-lg-3 col-sm-6 col-12">
    <div class="form-group">
        <label>Barangay</label>
        <select class="select" id="barangay" name="barangay" required></select>
        <div class="error-message" style="color: red;" id="accountTypeError"></div>
    </div>
</div>

<div class="col-lg-12 col-sm-6 col-12">
    <div class="form-group">
        <label>Street description</label>
        
        <textarea required name="streetDescription" id="streetDescription" placeholder="Subdivision-Street-Block-Lot" name="address"></textarea>

        <div class="error-message" style="color: red;" id="accountTypeError"></div>
    </div>
</div>

                

<div class="col-12">
<div class="product-list">
<ul class="row">
<li>
<div hidden class="productviews">
<div class="productviewsimg">
<img src="assets/img/icons/macbook.svg" alt="img">
</div>
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

<div id="loadingSpinner"></div>
<button type="button" disabled class="btn btn-submit me-2" id='submitButton'>Submit</button>
<a href="userlist.php" class="btn btn-cancel" id="btnBack">Back</a>
</div>



<script>
      
    </script>
</div>
</div>
</div>
</form>

<script src="adduser/javascript/email_validation.js"></script>