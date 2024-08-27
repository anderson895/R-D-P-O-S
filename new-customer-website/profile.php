<?php
include ('components/header.php');
$userId = $user['acc_id'];
$accCode = $user['acc_code'];
$customerFullname = $user['acc_fname']." ".$user["acc_lname"];
$customerEmail = $user["acc_email"];
$customerPhone = $user["acc_contact"];

$birthdate = new DateTime($user['acc_birthday']);
$today = new DateTime('today');
$age = $birthdate->diff($today)->y;

$getAddress = $db->getUserAddress2($accCode);
$fullAddress = 'No Address Set';
if ($getAddress->num_rows > 0) {
    $address = $getAddress->fetch_assoc();
    $fullAddress = $address['user_complete_address'];
}
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />

<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<h2><i class="bi bi-person-check"></i> Profile</h2>
<div class="container card mt-5 p-5">
    <div class="p-1st-row-container d-flex justify-content-center align-items-center flex-wrap">
        <div class="pp-container d-flex justify-content-center align-items-center">
            <?= ($user['emp_image'] != '') ? '<img src="../upload_img/' . $user['emp_image'] . '">' : '<i class="bi bi-person-fill"></i>' ?>
        </div>
        <div class="p-users-name-container input-container-label-top">
            <label>Name</label>
            <input type="text" class="form-control p-general-font-size" readonly
                value="<?= $user['acc_fname'] . ' ' . $user['acc_lname'] ?>">
        </div>
        <div class="p-users-age-container input-container-label-top">
            <label>Age</label>
            <input type="text" class="form-control p-general-font-size" readonly value="<?= $age ?>">
        </div>
    </div>
    <div class="p-2nd-row-container d-flex justify-content-center align-items-center flex-wrap mt-4 mb-5">
        <div class="p-username-container input-container-label-top">
            <label>Username</label>
            <input type="text" class="form-control p-general-font-size" readonly value="<?= $user['acc_username'] ?>">
        </div>
        <div class="p-email-container input-container-label-top">
            <label>Email</label>
            <input type="text" class="form-control p-general-font-size" readonly value="<?= $user['acc_email'] ?>">
        </div>
        <div class="p-contact-container input-container-label-top">
            <label>Contact #</label>
            <input type="text" class="form-control p-general-font-size readonly" value="<?= $user['acc_contact'] ?>">
        </div>
    </div>
    <div class="p-3rd-row-container d-flex justify-content-center align-items-center flex-wrap mb-5 pb-5">
        <div class="p-address-container input-container-label-top">
            <label>Address</label>
            <textarea readonly class="form-control p-general-font-size"><?= $fullAddress ?></textarea>
        </div>
    </div>


    <div class="pBtnsContainer d-flex flex-wrap">
        <button class="btn btn-dark m-1" id="btnEditProfile" data-fname="<?= $user['acc_fname'] ?>"
            data-lname="<?= $user['acc_lname'] ?>" data-bday="<?= $user['acc_birthday'] ?>"
            data-uname="<?= $user['acc_username'] ?>" data-email="<?= $user['acc_email'] ?>"
            data-contact="<?= $user['acc_contact'] ?>">Edit Profile</button>
        <button class="btn btn-primary m-1" id="btnEditAddress">Edit Address</button>
        <button class="btn btn-secondary m-1" id="btnProfileImgModal">Edit Image</button>
        <button class="btn btn-success m-1">Change Password</button>
    </div>
</div>

<?php
include ('components/footer.php');
?>