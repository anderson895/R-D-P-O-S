<section class="py-5">

                           
                       
                <br>
                <div class="lalagyanan1">
                    <div class="li-section-title">
                                    <h2>
                                        <span id="generalLabel">All product</span>
                                    </h2>
                                    
                    </div>
                <div class="box-lalagyanan1">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4" id="productContainer">
                                        
                  
                        
                               
    <?php

 
$current_date = date("Y-m-d"); // Get the current date

// Pagination variables
$limit = 18; // Number of products per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Get the total number of products
$totalProductsQuery = mysqli_query($connections, "SELECT COUNT(*) as total FROM product WHERE prod_status = '0'");
$totalProductsRow = mysqli_fetch_assoc($totalProductsQuery);
$totalProducts = $totalProductsRow['total'];

// Calculate the total number of pages
$totalPages = ceil($totalProducts / $limit);

$view_category_query = mysqli_query($connections, "SELECT *,
    SUM(IF(s_expiration = '0000-00-00' OR s_expiration > '$current_date', b.s_amount, 0)) AS prod_stocks
    FROM product AS a
    LEFT JOIN stocks AS b ON a.prod_id = b.s_prod_id
    LEFT JOIN voucher AS v ON a.prod_voucher_id = v.voucher_id
    WHERE prod_status = '0' AND prod_sell_onlline='1' 
    GROUP BY a.prod_id
    ");


    $dataArray = [];
while ($product_row = mysqli_fetch_assoc($view_category_query)) {
    $db_prod_id = $product_row["prod_id"];
    $db_prod_name = $product_row["prod_name"];


    $db_voucher_name=$product_row["voucher_name"];
    $db_voucher_discount=$product_row["voucher_discount"]/100;
    $db_prod_currprice = $product_row["prod_currprice"];
    
 
    $db_prod_stocks = $product_row["prod_stocks"];
    $db_prod_category = $product_row["prod_category_id"];
    $db_prod_description = $product_row["prod_description"];
    $db_prod_image = $product_row["prod_image"];

    $db_prod_image = $product_row["prod_image"];

    $db_prod_added = $product_row["prod_added"];

    $db_prod_kg = $product_row["prod_kg"];
    $db_prod_ml = $product_row["prod_ml"];
    $db_prod_g = $product_row["prod_g"];

  
                            // Create an associative array for the current product
    $productData = [
        'prod_id' => $db_prod_id,
        'prod_name' => $db_prod_name,
        'prod_currprice' => $db_prod_currprice,
        'prod_stocks' => $db_prod_stocks,
        'prod_category' => $db_prod_category,
        'prod_description' => $db_prod_description,
        'prod_added' => $db_prod_added,
        'prod_image' => $db_prod_image,
        'db_voucher_name' => $db_voucher_name,
        'db_voucher_discount' => $db_voucher_discount,
        'db_prod_kg' => $db_prod_kg,
        'db_prod_ml' => $db_prod_ml,
        'db_prod_g' => $db_prod_g

    ];

    // Push the product data into the main array
    $dataArray[] = $productData;
}
   
?> 



<?php 

echo "<script>
var All_product = ".json_encode($dataArray) .";
</script>";


?>






                        </div>
                    </div>
                    
                </div>
              
                
                
           
            </div>
        </section>
                 <ul class="pagination justify-content-center">
                    <div style="display:none;" id="load-morefilter"> load more-filter </div>
                </ul>
       
                <ul class="pagination justify-content-center">
                    <div style="display:none;" id="load-more"> load more </div>
                </ul>
                
               

<script>
    var All_product = <?= json_encode($dataArray) ?>; // Your product data here
</script>
<script src="view/product/js/searchFilter.js"></script>
