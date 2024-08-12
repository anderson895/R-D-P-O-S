<?php
include('components/header.php');
$getCartItems = $db->getCartItems($user['acc_id']);
?>
<div class="d-flex justify-content-between">
    <h2><i class="bi bi-cart-check"></i> Cart</h2>
    <?= ($getCartItems->num_rows > 0) ? '<button class="btn btn-danger" id="deleteAllItemsInCart"><i class="bi bi-trash3-fill"></i> Delete All</button>' : '' ?>
</div>



<div class="container card cart-items-container mt-5" id="cartItemsContainer">

</div>
<?php
include('components/footer.php');
?>
<script>
    $('.nav-cart').addClass('nav-active');
</script>