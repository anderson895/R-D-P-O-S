<?php
include("../../../connection.php"); // Adjust the path as needed

if (isset($_POST["query"])) {
    $query = $_POST["query"];
    // Modify this query to fetch relevant suggestions from your database
    $suggestions_query = mysqli_query($connections, "SELECT DISTINCT prod_name, prod_id FROM product WHERE prod_name LIKE '%$query%' LIMIT 5");

    if (mysqli_num_rows($suggestions_query) > 0) {
        while ($row = mysqli_fetch_assoc($suggestions_query)) {
            $db_prod_id = $row['prod_id'];
            $db_prod_name = $row['prod_name'];
            echo "<div class='suggestion view-product' data-name='$db_prod_name' data-id='$db_prod_id'>" . $row['prod_name'] . "</div>";
        }
    } else {
        echo "<div class='no-results'>No results found.</div>";
    }
}
?>
<script src='controller/shopping/js/product.js'></script>
