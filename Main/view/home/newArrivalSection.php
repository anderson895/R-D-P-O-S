<div id="topProductArea" class="product-area pt-60 pb-50">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="li-product-tab">
                                <ul class="nav li-product-menu">
                                   <li><a class="active text-decoration-none" data-toggle="tab" href="#li-new-product"><span>New Arrival</span></a></li>
                                   <li><a class="text-decoration-none" data-toggle="tab" href="#li-Bestseller"><span>Bestseller</span></a></li>
                                  
                                </ul>               
                            </div>
                        </div>
                    </div>

                    
                    <div class="tab-content" >
                    
                        <div id="li-new-product" class="tab-pane active show" role="tabpanel">
                            <div class="row">
                                <div class="product-active owl-carousel">
                                <?php
$view_new_products_query = mysqli_query($connections, "SELECT *  FROM product AS a
    LEFT JOIN stocks AS b ON a.prod_id = b.s_prod_id
    LEFT JOIN voucher AS v ON a.prod_voucher_id = v.voucher_id
    WHERE prod_status = '0' AND prod_added >= NOW() - INTERVAL 7 DAY
    AND prod_sell_onlline='1' 
    ");

while ($new_product_row = mysqli_fetch_assoc($view_new_products_query)) {
    $new_product_id = $new_product_row["prod_id"];
    $db_prod_name = $new_product_row["prod_name"];
    $old_product_price = $new_product_row["prod_currprice"];
    $new_prod_image = $new_product_row["prod_image"];
    $db_voucher_name = $new_product_row["voucher_name"];
    $db_voucher_discount = $new_product_row["voucher_discount"] / 100;
    $getDiscountVoucher = $old_product_price * $db_voucher_discount;
    $new_product_price = $old_product_price - $getDiscountVoucher;

    $db_prod_kg = $new_product_row["prod_kg"];
    $db_prod_ml = $new_product_row["prod_ml"];
    $db_prod_g = $new_product_row["prod_g"];
    $db_prod_vatable = $new_product_row["prod_vatable"];

    ?>
    <div class="col-lg-12" onclick="view_product(<?= $new_product_id ?>)" >
        <div class="single-product" >
            <div class="product-image" >
                <a>
                    <div class="image-container" style="height: 200px;">
                        <img src="../upload_prodImg/<?= $new_prod_image ?>" alt="Li's Product Image" style="object-fit: cover; width: 100%; height: 100%;">
                    </div>
                </a>
                <span class="sticker">New</span>
            </div>
            <div class="product_desc" >
                <div class="product_desc_info">
                    <div class="product-review" >
                        <div class="rating-box">
                            <!-- <ul class="rating">
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                            </ul> -->
                        </div>
                    </div>
                    <h6><a class="product_name text-decoration-none"><?= $db_prod_name ?></a>
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
                    </h6>
                    <?php
                    if (!empty($db_voucher_name)) {
                        echo  'Discount:'.$db_voucher_name .' '.($db_voucher_discount*100).'%';
                        echo '<div class="price-box">';
                       
                        echo '<span class="new-price text-decoration-line-through" style="color: gray;">₱' . number_format($old_product_price,2) . '</span>';
                        echo '<span class="new-price">₱' . number_format($new_product_price,2) . '</span>';
                        echo '</div>';
                    } else {
                       
                        echo '<span class="new-price">₱' . number_format($new_product_price,2) . '</span>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>



                                </div>
                            </div>
                        </div>
                        






                        <div id="li-Bestseller" class="tab-pane" role="tabpanel">
                            <div class="row">
                                <div class="product-active owl-carousel">
                 <?php
           $view_new_products_query = mysqli_query($connections, "SELECT
            v.voucher_name,
            v.voucher_discount,
           p.prod_id,
           p.prod_name,
           p.prod_currprice,
           p.prod_image,
           COUNT(o.orders_id) AS total_orders
       FROM
           product p
           
        LEFT JOIN stocks AS b ON p.prod_id = b.s_prod_id
        LEFT JOIN voucher AS v ON p.prod_voucher_id = v.voucher_id
       LEFT JOIN
           orders o ON p.prod_id = o.orders_prod_id
       GROUP BY
           p.prod_id, p.prod_name
       ORDER BY
           total_orders DESC;
       ");

                                                        while ($new_product_row = mysqli_fetch_assoc($view_new_products_query)) {
                                                            // Dito ay maaari mong kunin ang mga detalye ng mga bagong dating na produkto.
                                                            $new_product_id = $new_product_row["prod_id"];
                                                            $new_product_name = $new_product_row["prod_name"];
                                                            $new_prod_image = $new_product_row["prod_image"];


                                                            $old_product_price = $new_product_row["prod_currprice"];
                                                            $new_prod_image = $new_product_row["prod_image"];
                                                            $db_voucher_name = $new_product_row["voucher_name"];
                                                            $db_voucher_discount = $new_product_row["voucher_discount"] / 100;
                                                            $getDiscountVoucher = $old_product_price * $db_voucher_discount;
                                                            $new_product_price = $old_product_price - $getDiscountVoucher;

    
                                                        ?>
                                  <div class="col-lg-12" onclick="view_product(<?= $new_product_id ?>)">
        <div class="single-product">
            <div class="product-image">
                <a>
                    <div class="image-container" style="height: 200px;">
                        <img src="../upload_prodImg/<?= $new_prod_image ?>" alt="Li's Product Image" style="object-fit: cover; width: 100%; height: 100%;">
                    </div>
                </a>
                <span class="sticker">best</span>
            </div>
            <div class="product_desc" >
                <div class="product_desc_info" >
                    <div class="product-review">
                        <div class="rating-box">
                            <!-- <ul class="rating">
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                            </ul> -->
                        </div>
                    </div>
                    <h4><a class="product_name text-decoration-none"><?= $db_prod_name ?></a></h4>
                    <?php
                    if (!empty($db_voucher_name)) {
                        echo  'Discount:'.$db_voucher_name .' '.($db_voucher_discount*100).'%';
                        echo '<div class="price-box">';
                       
                        echo '<span class="new-price text-decoration-line-through" style="color: gray;">₱' . number_format($old_product_price,2) . '</span>';
                        echo '<span class="new-price">₱' . number_format($new_product_price,2) . '</span>';
                        echo '</div>';
                    } else {
                       
                        echo '<span class="new-price">₱' . number_format($new_product_price,2) . '</span>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>


                                    <?php  }   ?> 
                                </div>
                            </div>
                        </div>

                        
                        
                        
                        
                           
                        
                    </div>
                </div>
            </div>