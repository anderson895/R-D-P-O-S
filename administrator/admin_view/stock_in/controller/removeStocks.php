<?php 

echo "<pre>";
print_r($_POST);
echo "</pre>";


include("../.../../../../../connection.php");

date_default_timezone_set('Asia/Manila');
$current_date = date("Y-m-d");



$db_s_id=$_POST['db_s_id'];


$removeStocksQuery = "UPDATE stocks SET s_status='0'
                          WHERE s_id ='$db_s_id'";



if (mysqli_query($connections, $removeStocksQuery)) {
        

    $response['status'] = 'success';
    $response['message'] = 'Stock added successfully';


} else {
    $response['status'] = 'error';
    $response['message'] = 'Error inserting data into stocks table: ' . mysqli_error($connections);
}

// Set the content type
header('Content-Type: application/json');

// Output the JSON response
echo json_encode($response);
?>