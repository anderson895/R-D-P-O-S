<?php 
// Include your database connection here
include('../connection.php');

// Query para kunin ang lahat ng laman ng tbl_address
$query = "SELECT * FROM tbl_address";
$result = mysqli_query($connections, $query);

// I-convert ang resultset sa isang array
$addresses = array();
while ($row = mysqli_fetch_assoc($result)) {
    $addresses[] = $row;


  
}

// I-convert ang PHP array sa JavaScript array gamit ang JSON
$js_array = json_encode($addresses);

  // I-display ang mga addresses gamit ang print_r
 // echo '<pre>';
 // print_r($addresses);
 // echo '</pre>';
?>

<script>
        // Ilagay ang JSON array sa isang JavaScript variable
        var addressArray = <?php echo $js_array; ?>;

        // Ngayon, maaari mong gamitin ang addressArray sa JavaScript para sa mga operasyon
        console.log(addressArray);
</script>