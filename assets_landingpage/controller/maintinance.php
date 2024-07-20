<?php 
include ("../connection.php");
$get_record = mysqli_query ($connections,"SELECT * FROM maintinance");
$row = mysqli_fetch_assoc($get_record);
$db_system_name = $row ["system_name"];
$db_system_logo = $row ["system_logo"];
$db_system_banner = $row ["system_banner"];
$db_system_tax = $row ["system_tax"];
$db_system_address = $row ["system_address"];
$db_contact_address = $row ["system_contact"];
$db_system_content = $row ["system_content"];

$prod_category_id = 1;






$spaced_address = preg_replace('/(\w{4})(\w{3})(\w{4})/', '$1 $2 $3', $db_contact_address);


if (strpos($db_system_banner, ' ') !== false) {
    $db_system_banner = str_replace(" ", "%20", $db_system_banner);
}


function getRandomProductImage($connections,$prod_category_id) {
    $get_record_product_random = mysqli_query($connections, "SELECT * FROM product WHERE prod_status = '0' AND prod_image IS NOT NULL AND prod_image != '' 
    AND prod_category_id = '$prod_category_id'
    ORDER BY RAND() LIMIT 1");
    $row = mysqli_fetch_assoc($get_record_product_random);
    $prod_image = $row["prod_image"];
    $prod_category_id = $row["prod_category_id"];
  // AND prod_image IS NOT NULL AND prod_image != ''
    if (strpos($prod_image, ' ') !== false) {
        $prod_image = str_replace(" ", "%20", $prod_image);
    }
    

     $prod_image;
    return $prod_image;
}


?>	 