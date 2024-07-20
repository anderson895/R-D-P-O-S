<style>
    /* Initial styling */
    img {
      transition: transform 0.3s ease-in-out; /* Adding a smooth transition effect */
    }

    /* Hover effect */
    img:hover {
      transform: scale(1.1);
    }
  </style>

  
<div class="slider-area">
                      <div class="slider-active owl-carousel">
                          <!-- Begin Single Slide Area -->
                          <?php 
                           $view_product_query = mysqli_query($connections, "SELECT * FROM category where category_status='1'");
                           while ($category_row = mysqli_fetch_assoc($view_product_query)) {
                               $db_category_id = $category_row["category_id"];
                               $db_category_name = $category_row["category_name"];

                          $current_date = date("Y-m-d"); 
                              $view_product_query = mysqli_query($connections, "SELECT *,
                              SUM(IF(s_expiration = '0000-00-00' OR s_expiration > '$current_date', b.s_amount, 0)) AS prod_stocks
                              FROM product AS a
                              LEFT JOIN stocks AS b ON a.prod_id = b.s_prod_id
                              LEFT JOIN voucher AS v ON a.prod_voucher_id = v.voucher_id
                              WHERE prod_status = '0'
                              GROUP BY a.prod_id ");
                              while ($product_row = mysqli_fetch_assoc($view_product_query)) {
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
                                  
                                  $short_description = strlen($db_prod_description) > 20 ? substr($db_prod_description, 0, 50) . '...' : $db_prod_description;
  
                                  if (strpos($db_prod_image, ' ') !== false) {
                                      $db_prod_image = str_replace(" ", "%20", $db_prod_image);
                                  }
                                  if($db_prod_image){
                          ?>
                          <div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="single-slide align-center-left animation-style-01 bg-1" style="background-image: url(../upload_prodImg/<?= $db_prod_image ?>);">
                <div class="slider-progress" style="background-color:yellow;"></div>
                <div class="slider-content">
                  
                   
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="single-slide align-center-left animation-style-01 bg-1">
                    <div class="slider-content">
                      
                        <h2><?php echo $db_prod_name.' ';
                        
                        if ($db_prod_kg != 0) {
                            echo $db_prod_kg . 'Kg ';
                        }
                        if ($db_prod_ml != 0) {
                            echo $db_prod_ml . 'Ml ';
                        }
                        if ($db_prod_g != 0) {
                            echo $db_prod_g . 'g ';
                        }
                        ?></h2>

                        <?php
                    // Check if there's a voucher for this product
                    if (!empty($db_voucher_name)) {
                        // Display the voucher name
                        echo '<h5 class="voucher-name">Discount: ' . $db_voucher_name . ' '.($db_voucher_discount*100).'% off</h5>';
                        // Display the "Old" price with a strikethrough
                     
                        
                       
                        echo '<div class="price-box">';
                        echo '<h4 class="new-price text-decoration-line-through" style="color: gray;">₱ ' . number_format($old_product_price, 2, '.', ',') . '</h4>';
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

                        <p><span><?=$db_prod_description?></span></p>
                                <div class="default-btn slide-btn">
                                    <a class="links text-decoration-none" href="login.php">Shopping Now</a>
                                </div>
                    </div>
            </div>
        </div>
    </div>
</div>

                          <?php
                                  }
                              }
                              }
                          ?>
                      </div>
                  
            </div> 