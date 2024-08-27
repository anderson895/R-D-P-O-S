<?php 
include('../new-customer-website/backend/class.php');
$db = new global_class();
?>

<nav class="navbar navbar-expand-lg">
        <div class="container w-75 d-flex justify-content-center">
            <div class="row w-100">
                


                <div class="col-md-12">
                    <div class="input-group mt-2">
                        <button class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#categoriesModal" type="button">
                            <i class="bi bi-funnel"></i>
                        </button>

                        
                        <div class="modal fade" id="categoriesModal" tabindex="-1" aria-labelledby="categoriesModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="categoriesModalLabel">Categories</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <ul class="list-group">
                                        <?php 
echo '<li class="list-group-item"><a href="#" class="card-link category-link" data-category-id="all">All Category</a></li>';

$view_query = mysqli_query($connections,"SELECT * FROM category WHERE category_status='1'");
while ($row = mysqli_fetch_assoc($view_query)) {
    $category_id = $row["category_id"];
    $category_name = $row["category_name"];
    echo '<li class="list-group-item"><a href="#" class="card-link category-link" data-category-id="'.$category_id.'">'.$category_name.'</a></li>';
}
?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                        <input class="form-control" id="search_product" type="search" placeholder="Search" aria-label="Search">
                        
                    </div>
                </div>

                
            </div>
        </div>
    </nav>


<div class="container-fluid mt-2 w-75">
        <div class="row">
            <div class="col-md-12">
                <div id="carouselExampleCaptions" class="carousel slide mt-4">
                    <div class="carousel-inner" style="height: auto;">
                        <div class="carousel-item active">
                            <img src="assets/images/carousel1.png" class="d-block w-100" alt="RDPOS LOGO">
                        </div>
                        <div class="carousel-item">
                            <img src="assets/images/carousel2.png" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="assets/images/carousel3.png" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

                
                
                <div class="row mt-4">
                    
                <?php
$current_date = date("Y-m-d");
$view_category_query = mysqli_query($connections, "SELECT *,
    SUM(IF(s_expiration = '0000-00-00' OR s_expiration > '$current_date', b.s_amount, 0)) AS prod_stocks
    FROM product AS a
    LEFT JOIN stocks AS b ON a.prod_id = b.s_prod_id
    LEFT JOIN voucher AS v ON a.prod_voucher_id = v.voucher_id
    WHERE prod_status = '0' AND prod_sell_onlline='1' 
    GROUP BY a.prod_id
");

$product_count = 0; 
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

    $product_count++;

    if (isset($db_prod_id)) {
        $prod_id = $db_prod_id;
        $response = $db->getAverageRating($prod_id);
        // echo json_encode($response);

    } else {
        echo json_encode(["error" => "Product ID is missing"]);
    }

    $display_class = $product_count <= 5 ? "product-card initial-product" : "product-card additional-product";
    ?>


                    <div class="col-md-3 <?= $display_class ?> product-card" data-category-id="<?= $db_prod_category ?>">
                        <div class="card mb-4">
                            <?php if ($db_prod_image) { ?>
            <img class="card-img-top" src="../upload_prodImg/<?php echo $db_prod_image ?>" alt="Product Image" style="height: 250px;">
        <?php } else { ?>
            <img class="card-img-top" src="../upload_prodImg/no_available.jpg" alt="No Image Available" style="height: 25   0px;">
        <?php } ?>
                            <div class="position-absolute top-0 start-0 m-2">
                                <span hidden class="badge bg-success">120 Sold</span>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?= $db_prod_name ?></h5>
                                
                                <?php
                                    $avgRating = $response['avg_rating']; 
                                    echo '<div class="ratings">';
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= floor($avgRating)) {
                                            echo '<span id="star' . $i . '" class="text-warning">★</span>';
                                        } else {
                                            echo '<span id="star' . $i . '" class="text-muted">☆</span>';
                                        }
                                    }
                                    echo '<span id="avg-rating">(' . $avgRating . ')</span>';
                                    echo '</div>';
                                    ?>
                        
                                <p class="card-text"> <?php
                                    if (!empty($db_voucher_name)) {
                                        echo '<div class="voucher-name">Discount: ' . $db_voucher_name . '</div>';
                                        echo '<div class="price-box">';
                                        echo '<span class="new-price text-decoration-line-through" style="color: gray;">₱ ' . number_format($old_product_price, 2, '.', ',') . '</span>';
                                        echo '<span class="new-price">₱ ' . number_format($new_product_price, 2, '.', ',') . '</span>';
                                        echo '</div>';
                                    } else {
                                        echo '<div class="price-box">';
                                        echo '<span class="new-price">₱ ' . number_format($old_product_price, 2, '.', ',') . '</span>';
                                        echo '</div>';
                                    }
                                    ?>
                                 </p>
                                <a href="login.php" class="btn btn-primary">Add to cart</a>
                            </div>
                        </div>
                    </div>    

                    
                    <?php
}
?>
                </div>
                <?php if ($product_count > 5) { ?>
                            <div class="text-center">
                                <button id="view-more-btn" class="btn btn-secondary mt-3">View More Products</button>
                            </div>
                        <?php } ?>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var carouselElement = document.getElementById('carouselExampleCaptions');
            var carousel = new bootstrap.Carousel(carouselElement, {
                interval: 5000,
                ride: 'carousel'
            });
        });
    </script>    


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
       $(document).ready(function() {


    // Show the first 5 products initially
    $('.initial-product').show(); 

    // Handle category filter clicks
    $('.category-link').on('click', function(e) {
        e.preventDefault();

        var categoryId = $(this).data('category-id');

        // Hide all products
        $('.product-card').hide();

        // Show products belonging to the selected category or show all if 'All Category' is selected
        if (categoryId === 'all') {
            $('.product-card').show();
        } else {
            $('.product-card[data-category-id="' + categoryId + '"]').show();
        }

        // Hide the 'View More Products' button
        $('#view-more-btn').hide();
    });

    // Handle 'View More Products' button click
    $('#view-more-btn').on('click', function() {
        $('.additional-product').show(); // Show the remaining products
        $(this).hide(); // Hide the 'View More Products' button
    });



    $('#search_product').on('keyup', function() {
        var searchText = $(this).val().toLowerCase();
        
        // Loop through all product cards and hide those that don't match the search query
        $('.product-card').each(function() {
            var productName = $(this).find('.card-title').text().toLowerCase();
            
            // Check if the product name contains the search text
            if (productName.indexOf(searchText) !== -1) {
                $(this).show(); // Show matching product
            } else {
                $(this).hide(); // Hide non-matching product
            }
        });
    });


});

    </script>