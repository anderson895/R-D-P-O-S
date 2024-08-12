<?php
session_start();
include('../class.php');
$db = new global_class();
if (isset($_SESSION['acc_id'])) {
    if (isset($_GET['requestType'])) {
        if ($_GET['requestType'] == 'getAllCartItems') {
            $getCartItems = $db->getCartItems($_SESSION['acc_id']);
            $total = 0;
            if ($getCartItems->num_rows > 0) {
                while ($cartItem = $getCartItems->fetch_assoc()) {
                    $checkProductQty = $db->checkProductQty($cartItem['prod_id']);
                    $checkQtyResult = $checkProductQty->fetch_assoc();
                    $currentStock = $checkQtyResult['total_stock'];

                    $itemAmount = $cartItem['qty'] * $cartItem['prod_currprice'];
                    $total += $itemAmount;

                    $productName = $cartItem['prod_name'];
                    $productName .= ($cartItem['prod_mg'] > 0) ? ' ' . $cartItem['prod_mg'] . 'mg' : '';
                    $productName .= ($cartItem['prod_g'] > 0) ? ' ' . $cartItem['prod_g'] . 'g' : '';
                    $productName .= ($cartItem['prod_ml'] > 0) ? ' ' . $cartItem['prod_ml'] . 'ml' : '';

                    // Caculate Vat
                    $getMaintenance = $db->getMaintenance();
                    $maintenance = $getMaintenance->fetch_assoc();
                    $taxRate = $maintenance['system_tax'];
                    $vatPerItem = $itemAmount * $taxRate;

                    // Get Shipping Fee
                    $getUserAddressInfo = $db->getUserShippingFee($_SESSION['acc_id']);
                    if ($getUserAddressInfo->num_rows > 0) {
                        $addressInfo = $getUserAddressInfo->fetch_assoc();
                        $shippingFee = $addressInfo['sf'];
                    } else {
                        $shippingFee = 'Invalid';
                    }
                    
                    if($shippingFee == ''){
                        $shippingFee = 'Invalid';
                    }
?>
                    <div class="container mt-3 mb-3">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="../upload_prodImg/<?= $cartItem['prod_image'] ?>" class="cart-product-image img-fluid">
                            </div>
                            <div class="col-md-9">
                                <div class="item-details m-3 mt-0 mb-0">
                                    <h4><?= $productName ?></h4>
                                    <div class="input-container-label-top">
                                        <label>Description</label>  
                                        <textarea class="mt-0 form-control" style="height: 150px"><?= $cartItem['prod_description'] ?></textarea>
                                    </div>
                                    <p class="text-success mb-0">₱ <?= $cartItem['prod_currprice'] ?></p>
                                    <p class="mt-0 <?= ($currentStock > 0) ? '' : 'text-danger' ?>">
                                        <?= ($currentStock > 0) ? $currentStock . $cartItem['unit_type'] . ' Available' : 'Out of Stock' ?>
                                    </p>
                                    <hr>
                                    <div class="change-qty d-flex">
                                        <button id="" class="btn minusCartQty" data-id="<?= $cartItem['cart_id'] ?>"><i class="bi bi-dash"></i></button>
                                        <input type="number" inputmode="numeric" class="form-control inputChangeCartItemQty" data-id="<?= $cartItem['cart_id'] ?>" value="<?= $cartItem['qty'] ?>">
                                        <button id="" class="btn addCartQty" data-id="<?= $cartItem['cart_id'] ?>"><i class="bi bi-plus"></i></button>
                                    </div>
                                    <hr>
                                    <p>Amount: <span class="text-success">₱ <?= number_format($itemAmount, 2) ?>
                                    </span></p>
                                    <div class="delete-and-select-container d-flex align-items-center">
                                        <input type="checkbox" class="cartSelect form-check-input m-0" data-id="<?= $cartItem['prod_id'] ?>" data-image="<?= $cartItem['prod_image'] ?>" data-name="<?= $productName ?>" data-price="<?= $cartItem['prod_currprice'] ?>" data-unittype="<?= $cartItem['unit_type'] ?>" data-amount="<?= $itemAmount ?>" data-stock="<?= $currentStock ?>" data-inputqty="<?= $cartItem['qty'] ?>" data-itemvat="<?= $vatPerItem ?>" style="width: 30px; height: 30px;">
                                        <button class="btnDeleteCartItem btn btn-danger d-flex align-items-center" data-id="<?= $cartItem['cart_id'] ?>" style="height: 30px; margin-left: 10px;"><i class="bi bi-trash3-fill"></i> Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>
                <?php
                }
            } else {
                ?>
                <center class=" p-5 m-5 text-danger">
                    <h5>
                        Cart is Empty
                    </h5>
                </center>
            <?php
            }
            ?>
            <div class="cart-computation-container p-3">
                <p>Total: <span class="text-success">₱ <span id="totalSelectedItems">0</span></span></p>
                <button class="btn text-light" id="btnCheckOut" style="background-color: crimson;" data-sf="<?= $shippingFee ?>"><i class="bi bi-bag-check-fill"></i> Check Out</button>
            </div>
<?php
        }
    }
}
