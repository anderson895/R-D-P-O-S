<?php
include ('../config/config.php');
include ('../functions/session.php');
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Your head content here... -->
    <link rel="stylesheet" href="../assets/css/maintenance.css">
    <link rel="icon" href="../assets/images/logo.png" type="image/x-icon">
    <title>Account setting</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>


<body>

<?php include ('../includes/navigation.php');?>



<form id="accountProfileForm">
<div class="container mt-3">
    <div class="row pb-3" style="height: 540px;">

   
        <!-- Profile Picture Section -->
        <div class="col-12 col-md-4 mt-3">
            <div class="card h-100">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <div class="w-100 d-flex justify-content-center mb-3">
                        <img src="../../upload_img/<?=$db_emp_image?>" class="profile-img img-fluid" alt="Profile Picture">
                    </div>
                    <input class="form-control" type="file" name="file-input" id="file-input">
                </div>
            </div>
        </div>

        <!-- Account Information Section -->
        <div class="col-12 col-md-8 mt-3">
            <div class="card h-100">
                <div class="card-body mt-4">
                    <h2 class="fw-bold mb-4 text-center">Account Information</h2>
                
                    <div class="form-floating mb-2" hidden>
                        <input class="form-control" type="text" value="<?=$db_acc_id?>" name="acc_id" id="acc_id">
                        <label for="acc_id">ACC_ID</label>
                    </div>

                    
                    <div class="form-floating mb-2">
                        <input class="form-control" type="text" value="<?=$db_acc_fname?>" name="fname" id="fname" placeholder="First Name">
                        <label for="fname">First Name</label>
                    </div>

                    <div class="form-floating mb-2">
                        <input class="form-control" type="text" value="<?=$db_acc_lname?>" name="lname" id="lname" placeholder="Last Name">
                        <label for="lname">Last Name</label>
                    </div>

                    <div class="form-floating mb-2">
                        <input class="form-control" type="text" value="<?=$db_acc_username?>" name="uname" id="uname" placeholder="Username">
                        <label for="uname">Username</label>
                    </div>

                    <div class="form-floating">
                        <input class="form-control" type="text" value="<?=$db_acc_contact?>" name="contact" id="contact" placeholder="Contact">
                        <label for="contact">Contact</label>
                    </div>

                    <button type="button" id="btnSave" name="btnSave" class="btn btn-secondary mt-3">Save</button>
                </div>
            </div>
        </div>

     
    </div>
</div>
</form>



<!-- Password Confirmation Modal -->
<div class="modal" id="passwordModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirm Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <form id="passwordForm">
          <div class="form-group">
            <label for="confirmPassword">Password</label>
            <input type="password" class="form-control" id="confirmPassword" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="confirmPasswordBtn">Confirm</button>
      </div>
    </div>
  </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="../assets/js/maintenance.js"></script>
</body>
</html>
