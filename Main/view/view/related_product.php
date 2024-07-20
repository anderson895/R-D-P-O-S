<section class="py-5 bg-light related-products-section">
    <div class="container px-4 px-lg-5 mt-5">
        <h2 class="fw-bolder mb-4">Related products</h2>

        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php
            $view_RELATEDproduct = mysqli_query($connections, "SELECT a.*, b.s_id,v.voucher_name,v.voucher_discount, SUM(IF(b.s_expiration = '0000-00-00' OR b.s_expiration > '$current_date', b.s_amount, 0)) AS prod_stocks
            FROM product AS a
            LEFT JOIN stocks AS b ON a.prod_id = b.s_prod_id
            LEFT JOIN voucher AS v ON a.prod_voucher_id = v.voucher_id
            WHERE a.prod_category_id = $db_prod_category_id AND prod_status = '0' AND prod_id != $view_id
            GROUP BY a.prod_id
            ORDER BY b.s_stockin_date ASC");
        

            while ($row = mysqli_fetch_assoc($view_RELATEDproduct)) {
                $prod_id = $row["prod_id"];
                $db_prod_currprice = $row["prod_currprice"];

               $db_s_id = $row["s_id"];

                $db_stocks = $row["prod_stocks"];
                $db_prod_category_id = $row["prod_category_id"];
                $db_prod_description = $row["prod_description"];
                $db_prod_image = $row["prod_image"];

                $db_voucher_name = $row["voucher_name"];
                $db_voucher_discount = $row["voucher_discount"] / 100;


                                // Calculate the discounted price
                $old_product_price = $row["prod_currprice"];
                $getDiscountVoucher = $old_product_price * $db_voucher_discount;
                $new_product_price = $old_product_price - $getDiscountVoucher;


                $prod_name = $row["prod_name"];

              

                $get_category = mysqli_query($connections, "SELECT * FROM category where category_id ='$db_prod_category_id'");
                $rowcat = mysqli_fetch_assoc($get_category);
                $db_category_name = $rowcat["category_name"];
                ?>

                <div class="col mb-5">
                    <div class="card h-100 custom-card" style="color: black; background-color: white; border-color: gray;" >
                        <img class="card-img-top" onclick="view_product(<?= $prod_id ?>)"
                             <?php if ($db_prod_image) { ?>
                                 src="../upload_prodImg/<?php echo $db_prod_image ?>"
                             <?php } else { ?>
                                 src="../assets/img/1599802140_no-image-available.png"
                             <?php } ?>
                             style="width: 100%; height: 100%; border: none; object-fit: cover;"
                             class="rounded-top-1 border-bottom" alt="..."/>

                        <div class="card-body p-4">
                            <div class="cart-logo" >
                                <i class="fas fa-shopping-cart"></i>
                            </div>

                            <div class="text-center">
                                <h5 class="fw-bolder"><?php echo $prod_name ?></h5>
                                <?php if (!empty($db_voucher_name)) { ?>
                                    <div class="d-flex justify-content-between">
                                        <p class="mb-0">Voucher: <?= $db_voucher_name ?></p>
                                        
                                    </div>
                                    <p class="mb-0"><del>₱ <?= number_format($old_product_price, 2, '.', ',') ?></del></p>
                                <?php } ?>
                                <h6 class="mb-0">₱ <?= number_format($new_product_price, 2, '.', ',') ?></h6>
                            
                            </div>
                        </div>

                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">
                                <button onclick="login()" class="w-100 btn togler" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal" data-id="<?= $prod_id ?>"
                                        <?php if ($db_stocks <= 0) {
                                            echo "disabled";
                                        } ?>
                                        style="background-color: rgb(128, 0, 0); color: white;">Add to Cart
                                    <i class="fa fa-shopping-cart"></i></button>

                                    <button onclick="login()" class="w-100 btn toglerBuyNow mt-3" data-bs-toggle="modal" data-bs-target="#modalBuynow" data-id="<?= $prod_id ?>" data-db_prod_name="<?= $prod_name ?>" data-db_prod_currprice="<?= $db_prod_currprice ?>" data-ssid="<?= $db_s_id ?>"<?php if ($db_stocks <= 0) {
                echo "disabled";
            } ?>
                    style="background-color: rgb(128, 0, 0); color: white;">Buy now 
            </button>
                                <br><br>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
