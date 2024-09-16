<?php
include("../.../../../../connection.php");
session_start();

$acc_id = $_SESSION["acc_id"];
$sql_count = mysqli_query($connections, "
SELECT COUNT(DISTINCT mess_sender) AS NotifCount
FROM messages
WHERE (mess_reciever = '$acc_id' OR mess_reciever ='Admin') AND mess_seen = '0'
");

$row = mysqli_fetch_assoc($sql_count);
$count = min($row['NotifCount'], 99);  // Limit count to 99

echo $count;
?>
