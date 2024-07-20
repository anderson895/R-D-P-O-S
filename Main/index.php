<?php
include("back_login.php");


include("controller/maintinance.php");


include "include/session_dir.php";

include "include/header.php";
?>


<style>
        .product-card { display: none; }
    </style>

    
<div class="container mt-5">
        <div class="row">
            <div class="col-md-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Categories</h5>
                        <ul class="list-group list-group-flush">
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
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">All Products</h5>
                        <div class="row">
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

$product_count = 0; // Counter for the number of products displayed
while ($product_row = mysqli_fetch_assoc($view_category_query)) {
    $db_prod_id = $product_row["prod_id"];
    $db_prod_name = $product_row["prod_name"];
    $db_prod_stocks = $product_row["prod_stocks"];
    $db_prod_category = $product_row["prod_category_id"]; // Category ID of the product
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
    $display_class = $product_count <= 5 ? "product-card initial-product" : "product-card additional-product";
    ?>

    
    <div class="col-md-4 mb-4 <?= $display_class ?> product-card" data-category-id="<?= $db_prod_category ?>">
    <div class="card h-100">
        <?php if ($db_prod_image) { ?>
            <img class="card-img-top" src="../upload_prodImg/<?php echo $db_prod_image ?>" alt="Product Image" style="height: 250px;">
        <?php } else { ?>
            <img class="card-img-top" src="../upload_prodImg/no_available.jpg" alt="No Image Available" style="height: 25   0px;">
        <?php } ?>
        <div class="card-body">
            <h5 class="card-title"><?= $db_prod_name ?></h5>
            <p class="card-text">
                <?php
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
        </div>
    </div>

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
});

    </script>
    



<?php 
include "include/footer.php";
?>







