<!-- Lightbox2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/lightbox2@2.11.4/dist/css/lightbox.min.css" rel="stylesheet">

<!-- Lightbox2 JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/lightbox2@2.11.4/dist/js/lightbox.min.js"></script>


<?php
session_start();
include('../class.php');
$db = new global_class();

if (isset($_SESSION['acc_id'])) {
    if (isset($_GET['requestType'])) {
        if ($_GET['requestType'] == 'getAllCartItems') {
            $getCartItems = $db->getCartItems($_SESSION['acc_id']);

            $availableItems = [];
            $outOfStockItems = [];
            $total = 0;

            if ($getCartItems->num_rows > 0) {
                while ($cartItem = $getCartItems->fetch_assoc()) {
                    $checkProductQty = $db->checkProductQty($cartItem['prod_id']);
                    $checkQtyResult = $checkProductQty->fetch_assoc();
                    $currentStock = $checkQtyResult['total_stock'];

                    if ($currentStock > 0) {
                        $availableItems[] = array_merge($cartItem, ['currentStock' => $currentStock]);
                    } else {
                        $outOfStockItems[] = array_merge($cartItem, ['currentStock' => $currentStock]);
                    }
                }
            }

            // Merge available and out-of-stock items
            $sortedCartItems = array_merge($availableItems, $outOfStockItems);

            if (!empty($sortedCartItems)) {
                foreach ($sortedCartItems as $cartItem) {
                    $currentStock = $cartItem['currentStock'];
                    $itemAmount = $cartItem['qty'] * $cartItem['prod_currprice'];
                    $total += $itemAmount;

                    $productName = $cartItem['prod_name'];
                    $productName .= ($cartItem['prod_mg'] > 0) ? ' ' . $cartItem['prod_mg'] . 'mg' : '';
                    $productName .= ($cartItem['prod_g'] > 0) ? ' ' . $cartItem['prod_g'] . 'g' : '';
                    $productName .= ($cartItem['prod_ml'] > 0) ? ' ' . $cartItem['prod_ml'] . 'ml' : '';

                    // Get shipping fee
                    $getUserAddressInfo = $db->getUserShippingFee($_SESSION['acc_id']);
                    $shippingFee = 'Invalid';
                    if ($getUserAddressInfo->num_rows > 0) {
                        $addressInfo = $getUserAddressInfo->fetch_assoc();
                        $shippingFee = $addressInfo['sf'] ?? 'Invalid';
                    }
?>
                    <div class="container mt-4 mb-4">
                        <div class="row g-4">
                            <div class="col-md-4 col-lg-3">
                                <img id="main-image" src="../upload_prodImg/<?= $cartItem['prod_image'] ?>" 
                                     class="img-fluid rounded-3 shadow-sm" alt="Product Image" 
                                     style="max-width: 100%; height: 200px; object-fit: cover;">
                            </div>
                            <div class="col-md-8 col-lg-9">
                                <div class="item-details p-4 rounded-3 shadow-sm bg-white">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="d-flex align-items-center">
                                            <input type="checkbox" class="form-check-input me-3 cartSelect" 
                                                   data-id="<?= $cartItem['prod_id'] ?>" 
                                                   data-stock="<?= $currentStock ?>" 
                                                   <?= ($currentStock <= 0) ? 'disabled' : '' ?>>
                                            <h4 class="fw-bold mb-0"><?= $productName ?></h4>
                                        </div>
                                        <button class="btn btn-danger btn-sm d-flex align-items-center btnDeleteCartItem" 
                                                data-id="<?= $cartItem['cart_id'] ?>">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </div>
                                    <p class="text-success fw-bold h5 mb-1">₱ <?= $cartItem['prod_currprice'] ?></p>
                                    <p class="mb-2 <?= ($currentStock > 0) ? '' : 'text-danger' ?>">
                                        <?= ($currentStock > 0) ? $currentStock . ' ' . $cartItem['unit_type'] . ' Available' : 'Out of Stock' ?>
                                    </p>
                                    <div class="d-flex align-items-center mb-3">
                                        <button class="btn btn-outline-secondary btn-sm minusCartQty" 
                                                data-id="<?= $cartItem['cart_id'] ?>" 
                                                <?= ($currentStock <= 0) ? 'disabled' : '' ?>>
                                            <i class="bi bi-dash"></i>
                                        </button>
                                        <input type="number" class="form-control text-center mx-3 inputChangeCartItemQty" 
                                               data-id="<?= $cartItem['cart_id'] ?>" 
                                               value="<?= $cartItem['qty'] ?>" 
                                               style="max-width: 70px;" 
                                               <?= ($currentStock <= 0) ? 'disabled' : '' ?>>
                                        <button class="btn btn-outline-secondary btn-sm addCartQty" 
                                                data-id="<?= $cartItem['cart_id'] ?>" 
                                                <?= ($currentStock <= 0) ? 'disabled' : '' ?>>
                                            <i class="bi bi-plus"></i>
                                        </button>
                                    </div>
                                    <p class="mb-0">Amount: <span class="text-success fw-bold">₱ <?= number_format($itemAmount, 2) ?></span></p>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
<?php
                }
            } else {
?>
                <center class=" p-5 m-5 text-danger">
                    <h5>Cart is Empty</h5>
                </center>
<?php
            }
?>
            <div class="cart-computation-container p-3">
                <p>Total: <span class="text-success">₱ <span id="totalSelectedItems"><?= number_format($total, 2) ?></span></span></p>
                <button class="btn text-light" id="btnCheckOut" style="background-color: crimson;" data-sf="<?= $shippingFee ?>"><i class="bi bi-bag-check-fill"></i> Check Out</button>
            </div>
<?php
        }
    }
}
?>


