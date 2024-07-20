
<?php
include("../.../../../../connection.php");

$sql_count = mysqli_query($connections, "
SELECT COUNT(*) AS NotifCount 
FROM users_log 
WHERE act_seen='0'
");
$row = mysqli_fetch_assoc($sql_count);
$count = min($row['NotifCount'], 99);  // Limit count to 99

echo $count;
?>

