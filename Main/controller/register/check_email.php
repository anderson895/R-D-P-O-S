<?php
include("controller/maintinance.php");

$email = $_GET['email'];
$query = "SELECT * FROM account WHERE acc_email = '$email'";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) {
    echo "Email already exists";
} else {
    echo "Email available";
}
?>