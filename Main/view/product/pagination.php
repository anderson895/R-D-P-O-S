    
    <?php

 
                      

                        // Pagination variables
                        $limit = 8; // Number of products per page
                        $page = isset($_GET['page']) ? $_GET['page'] : 1;
                        $offset = ($page - 1) * $limit;

                        // Get the total number of products
                        $totalProductsQuery = mysqli_query($connections, "SELECT COUNT(*) as total FROM product WHERE prod_status = '0'");
                        $totalProductsRow = mysqli_fetch_assoc($totalProductsQuery);
                        $totalProducts = $totalProductsRow['total'];

                        // Calculate the total number of pages
                        $totalPages = ceil($totalProducts / $limit);

                        $current_date = date("Y-m-d"); // Get the current date
                        $view_category_query = mysqli_query($connections, "SELECT *,
                            SUM(IF(s_expiration = '0000-00-00' OR s_expiration > '$current_date', b.s_amount, 0)) AS prod_stocks
                            FROM product AS a
                            LEFT JOIN stocks AS b ON a.prod_id = b.s_prod_id
                            WHERE prod_status = '0' 
                            GROUP BY a.prod_id
                            LIMIT $limit OFFSET $offset");


                            $dataArray = [];
                        while ($product_row = mysqli_fetch_assoc($view_category_query)) {
                            $db_prod_id = $product_row["prod_id"];
                            $db_prod_name = $product_row["prod_name"];
                            
                            $db_prod_orgprice = $product_row["prod_orgprice"];
                            $db_prod_currprice = $product_row["prod_currprice"];
                            $db_prod_stocks = $product_row["prod_stocks"];
                            $db_prod_category = $product_row["prod_category_id"];
                            $db_prod_description = $product_row["prod_description"];
                            $db_prod_image = $product_row["prod_image"];

                            $db_prod_added = $product_row["prod_added"];

                            $db_prod_kg = $product_row["prod_kg"];
                            $db_prod_ml = $product_row["prod_ml"];
                            $db_prod_g = $product_row["prod_g"];

                          
                          
                                                    // Create an associative array for the current product
                            $productData = [
                                'prod_id' => $db_prod_id,
                                'prod_name' => $db_prod_name,
                                'prod_orgprice' => $db_prod_orgprice,
                                'prod_currprice' => $db_prod_currprice,
                                'prod_stocks' => $db_prod_stocks,
                                'prod_category' => $db_prod_category,
                                'prod_description' => $db_prod_description,
                                'prod_added' => $db_prod_added,
                                'prod_image' => $db_prod_image,
                                'db_prod_kg' => $db_prod_kg,
                                'db_prod_ml' => $db_prod_ml,
                                'db_prod_g' => $db_prod_g

                            ];

                            // Push the product data into the main array
                            $dataArray[] = $productData;
                        }
                           
                        ?>



<script>
  
    var All_product = <?= json_encode($dataArray) ?>;
    
 
    var productContainer = document.getElementById('productContainer');

    for (var i = 0; i < All_product.length; i++) {
        var product = All_product[i];
        var productHTML = `
            <div class="col-xl-3 col-lg-4 col-sm-6 col-6 mt-4 product ${product.prod_category} categprod${product.prod_category}" data-name="${product.prod_name}">
              <div class="box">
              asdasd
                    <div class="card shadow custom-card" style="background-color: transparent;">
                        <div style="width: 100%; height: 170px; position: relative;">`;

        if (product.prod_image) {
            productHTML += `
                <a href="view_product.php?view_id=${product.prod_id}" style="margin: 0px; padding: 0px;">
                    <img src="../upload_prodImg/${product.prod_image}" style="width: 100%; height: 100%; border: none; object-fit: cover;" class="rounded-top-1 border-bottom" alt="...">
                </a>
                <div class="card-body">
                    <div class="cart-logo">
                        <i class="fas fa-shopping-cart" onclick="view_product(${product.prod_id})"></i>
                    </div>
                </div>`;
        } else {
            productHTML += `
                <a href="view_product.php?view_id=${product.prod_id}" style="margin: 0px; padding: 0px;">
                    <img src="../upload_prodImg/no_available.jpg" style="width: 100%; height: 100%; border: none; object-fit: cover;" class="rounded-top-1 border-bottom" alt="...">
                </a>
                <div class="card-body">
                    <div class="cart-logo" onclick="view_product(${product.prod_id})">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                </div>`;
        }

        productHTML += `
                    </div>
                    <div class="card-body">
                        <h6 class="card-title" style="font-size: 12px;">${product.prod_name}</h6>
                        <h6 style="font-size: 20px; font-family: Franklin Gothic Medium; color: black;">Php
    ${parseFloat(product.prod_currprice).toLocaleString('en-PH', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}
</h6>


                         </div>
                     </div>
               
            </div>`;

        // Append the product HTML to the container
        productContainer.innerHTML += productHTML;
    }
</script>


<?php 

            echo "<script>
            // Encode the PHP array to JSON
            var All_product = ".json_encode($dataArray) .";
        
            // Access elements in the JSON array
           // console.log(All_product[4].prod_name);
            

        </script>";

 
?>



    

        