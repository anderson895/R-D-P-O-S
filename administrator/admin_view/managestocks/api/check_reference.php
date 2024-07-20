<?php
// Include ang iyong database configuration file
include("../../../../connection.php");

$referenceNo = $_POST["referenceNo"];

// Gumawa ng query sa database
$query = "SELECT precord_reference FROM purchased_record WHERE precord_reference = '$referenceNo' ";

$result = mysqli_query($connections, $query); // $connection ay iyong database connection

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $ReferenceNoFromDatabase = $row["precord_reference"];
    
    if ($referenceNo === $ReferenceNoFromDatabase) {
        echo "match";
    } else {
        echo "no_match";
    }
} else {
    echo "no_match";
}

// Huwag kalimutang isara ang database connection pagkatapos ng query.
mysqli_close($connections);
?>
