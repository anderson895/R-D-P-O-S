

<?php
function generateCategoryOptions($connections) {
    $view_product_query = mysqli_query($connections, "SELECT * FROM category");
    while ($category_row = mysqli_fetch_assoc($view_product_query)) {
        $db_category_id = $category_row["category_id"];
        $db_category_name = $category_row["category_name"];
        ?>
        <option class="nav-link hatdog" data-id="<?= $db_category_id ?>"><?php echo $db_category_name ?></option>
        <?php
        
    }
}



function generatePagination($page, $totalPages) {
    if ($page > 1) {
    echo '<li class="page-item"><a class="page-link" href="?page=' . ($page - 1) . '" style="color: #6D0F0F;">Previous</a></li>';
}

for ($i = 1; $i <= $totalPages; $i++) {
    $isActive = ($i == $page);
    echo '<li class="page-item ' . ($isActive ? 'active' : '') . '"><a class="page-link" href="?page=' . $i . '" style="color: #6D0F0F;' . ($isActive ? ' background-color: #6D0F0F; border:none; color:white;' : '') . '">' . $i . '</a></li>';
}

if ($page < $totalPages) {
    echo '<li class="page-item"><a class="page-link" href="?page=' . ($page + 1) . '" style="color: #6D0F0F;">Next</a></li>';
}

    
}
?>