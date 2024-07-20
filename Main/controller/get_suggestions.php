<?php
include("../../connection.php"); // Adjust the path as needed

if (isset($_POST["query"])) {
    $query = $_POST["query"];
    $safe_query = mysqli_real_escape_string($connections, $query); // Sanitize user input

    // Modify this query to fetch relevant suggestions from your database
    $suggestions_query = mysqli_query($connections, "SELECT DISTINCT prod_image, prod_name, prod_id FROM product WHERE prod_name LIKE '%$safe_query%' AND prod_status = 0 LIMIT 5");

    if (mysqli_num_rows($suggestions_query) > 0) {
        while ($row = mysqli_fetch_assoc($suggestions_query)) {
            $db_prod_id = $row['prod_id'];
            $db_prod_image = $row['prod_image'];

            // Echo image and product name
            echo '<div class="row">';
            echo '<div class="col suggestion view-product" data-id="'. $db_prod_id . '"><img src="../upload_prodImg/' . $db_prod_image . '" style="width:50px;" alt="">';
            echo '' . $row['prod_name'] . '</div>';
            echo '</div>';
            
        }
    } else {
        echo '<div class="no-results">No results found.</div>';
    }
}
?>
<script src='controller/javascript/product.js'></script>
