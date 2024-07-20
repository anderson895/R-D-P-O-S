<div class="container mt-3">
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-4">
            <div class="product-image rounded border border-1">
                <?php if ($db_prod_image) { ?>
                    <img class="rounded img-fluid" src="../upload_prodImg/<?php echo $db_prod_image ?>" alt="Product Image">
                <?php } else { ?>
                    <img class="rounded img-fluid" src="../upload_prodImg/no_available.jpg" alt="No Image Available">
                <?php } ?>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="rounded p-3">
            <h3 class="mb-3">
            <?= $db_prod_name ?>
            <?php
            if ($db_prod_kg != 0) {
                echo $db_prod_kg . 'Kg ';
            }
            if ($db_prod_ml != 0) {
                echo $db_prod_ml . 'Ml ';
            }
            if ($db_prod_g != 0) {
                echo $db_prod_g . 'g ';
            }
            ?>
            </h3>
            <p class="mb-3"><?= $db_prod_code ?></p>
                <hr>
                <div class="d-flex justify-content-between mb-2">
                    <p class="mb-0"><b>Category:</b> <?= $db_category_name ?></p>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <p class="mb-0"><b>Stocks: </b><?= $db_stocks ?></p>
                    <p class="mb-0"><b>Status: </b>
                        <?php if ($db_stocks <= 0) {
                            echo "<b style='color:red;'>Out of stock</b>";
                        } else {
                            echo "<b style='color:green;'>Available</b>";
                        } ?>
                    </p>
                </div>
                <hr>
                <?php if (!empty($db_voucher_name)) { ?>
                    <div class="d-flex justify-content-between">
                        <p class="mb-0">Discount: <?= $db_voucher_name ?></p>
                    </div>
                    <p class="mb-0"><del>₱ <?= number_format($old_product_price, 2, '.', ',') ?></del></p>
                <?php } ?>
                <h6 class="mb-0">₱ <?= number_format($new_product_price, 2, '.', ',') ?></h6>
                <p class="mb-0 mt-2">Description: <?= $db_prod_description ?></p>
            </div>
            <button onclick="login()" class="w-100 btn togler mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="<?= $view_id ?>" <?php if ($db_stocks <= 0) {
                echo "disabled";
            } ?> style="background-color: rgb(128, 0, 0); color: white;">Add to Cart <i class="fa fa-shopping-cart"></i>
            </button>

            <button onclick="login()" class="w-100 btn toglerBuyNow mt-3" data-bs-toggle="modal" data-bs-target="#modalBuynow" data-id="<?= $prod_id ?>" data-db_prod_name="<?= $db_prod_name ?>" data-db_prod_currprice="<?= $new_product_price ?>" data-ssid="<?= $db_s_id ?>" <?php if ($db_stocks <= 0) {
                echo "disabled";
            } ?> style="background-color: rgb(128, 0, 0); color: white;">Buy now
            </button>
        </div>
        <div class="col-lg-2"></div>
    </div>
</div>
