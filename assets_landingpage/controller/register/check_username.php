<?php
include("controller/maintinance.php");

$username = $_GET['username'];
$query = "SELECT * FROM account WHERE username = '$username'";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) {
    echo "Username already exists";
} else {
    echo "Username available";
}
?>
