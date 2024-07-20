<div id='prodSlider'>
<?php 
                                      $view_product_query = mysqli_query($connections, "SELECT DISTINCT category.*
                                      FROM category
                                      INNER JOIN product ON product.prod_category_id = category.category_id
                                      WHERE category.category_status = '1';
                                      ");
                                      while ($category_row = mysqli_fetch_assoc($view_product_query)) {
                                          $db_category_id = $category_row["category_id"];
                                          $db_category_name = $category_row["category_name"];



                                    ?>
<section class="product-area li-laptop-product pt-60 pb-45" >
                <div class="container">
                    <div class="row">
                        <!-- Begin Li's Section Area -->
                        <div class="col-lg-12">
                            <div class="li-section-title">
                                <h2>
                                    <span><?= $db_category_name ?></span>
                                </h2>
                                
                            </div>
                            <div id="<?= $db_category_id?>" class="tab-pane" role="tabpanel" >
                            <div class="row">
                                <div class="product-active owl-carousel">
                                <?php
$current_date = date("Y-m-d"); // Get the current date
$view_category_query = mysqli_query($connections, "SELECT *,
    SUM(IF(s_expiration = '0000-00-00' OR s_expiration > '$current_date', b.s_amount, 0)) AS prod_stocks
    FROM product AS a
    LEFT JOIN stocks AS b ON a.prod_id = b.s_prod_id
    LEFT JOIN voucher AS v ON a.prod_voucher_id = v.voucher_id
    WHERE prod_status = '0' AND prod_category_id='$db_category_id' AND prod_sell_onlline='1' 
    GROUP BY a.prod_id
");

$dataArray = [];
while ($product_row = mysqli_fetch_assoc($view_category_query)) {
    $db_prod_id = $product_row["prod_id"];
    $db_prod_name = $product_row["prod_name"];
    $db_prod_stocks = $product_row["prod_stocks"];
    $db_prod_category = $product_row["prod_category_id"];
    $db_prod_description = $product_row["prod_description"];
    $db_prod_image = $product_row["prod_image"];
    $db_prod_added = $product_row["prod_added"];

    $old_product_price = $product_row["prod_currprice"];
    $db_voucher_name = $product_row["voucher_name"];
    $db_voucher_discount = $product_row["voucher_discount"] / 100;

    $getDiscountVoucher = $old_product_price * $db_voucher_discount;
    $new_product_price = $old_product_price - $getDiscountVoucher;


    $db_prod_kg = $product_row["prod_kg"];
    $db_prod_ml = $product_row["prod_ml"];
    $db_prod_g = $product_row["prod_g"];
    $db_prod_vatable = $product_row["prod_vatable"];

  
    ?>
    <div class="col-lg-12" onclick="view_product(<?= $db_prod_id ?>)">
        <!-- single-product-wrap start -->
        <div class="single-product">
            <div class="product-image">
                <a>
                    <img src="../upload_prodImg/<?=$db_prod_image?>" alt="Li's Product Image">
                </a>
            </div>
            <div class="product_desc">
                <div class="product_desc_info">
                    <div class="product-review">
                        
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
                    // Check if there's a voucher for this product
                    if (!empty($db_voucher_name)) {
                        // Display the voucher name
                        echo '<div class="voucher-name">Discount:' . $db_voucher_name . '</div>';
                        // Display the "Old" price with a strikethrough
                        echo '<div class="price-box">';
                        echo '<span class="new-price text-decoration-line-through" style="color: gray;">₱ ' . number_format($old_product_price, 2, '.', ',') . '</span>';
                        // Calculate the "New" price after applying the voucher discount
                        echo '<span class="new-price">₱ ' . number_format($new_product_price, 2, '.', ',') . '</span>';
                        echo '</div>';
                    } else {
                        // Display only the "New" price
                        echo '<div class="price-box">';
                        echo '<span class="new-price">₱ ' . number_format($old_product_price, 2, '.', ',') . '</span>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <!-- single-product-wrap end -->
    </div>
    <?php
}
?>

                              
                                    
                                    
                                   


                                </div>
                            </div>
                        </div>
                       
                        </div>
                        <!-- Li's Section Area End Here -->
                    </div>
                </div>
            </section>
            <?php } ?>
 </div>