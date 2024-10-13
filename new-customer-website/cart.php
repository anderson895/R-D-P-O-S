<?php
include('components/header.php');
$getCartItems = $db->getCartItems($user['acc_id']);

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

<link rel="stylesheet" href="css/gallery.css">


<div class="d-flex justify-content-between align-items-center">
    <h2 class="mb-0"><i class="bi bi-cart-check"></i> Cart</h2>

    <!-- Start check all -->
    <div class="form-check ms-3">
        <input type="checkbox" class="form-check-input" id="checkAll" style="width: 20px; height: 20px;">
        <label class="form-check-label" for="checkAll">Check All</label>
    </div>
    <!-- End check all -->

    <?= ($getCartItems->num_rows > 0) ? '<button class="btn btn-danger ms-3" id="deleteAllItemsInCart"><i class="bi bi-trash3-fill"></i> Delete All</button>' : '' ?>
</div>




<div class="container card cart-items-container mt-5" id="cartItemsContainer">

</div>
<?php
include('components/footer.php');
?>
<script>
    $('.nav-cart').addClass('nav-active');



 

</script>