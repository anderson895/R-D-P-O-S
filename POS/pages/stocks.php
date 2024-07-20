<?php
include ('../config/config.php');
include ('../functions/session.php');
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventory</title>
    <link rel="icon" href="../assets/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/inventory.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body >




<?php include ('../includes/navigation.php');?>



<link rel="stylesheet" href="../../administrator/admin_view/assets/plugins/alertify/alertify.min.css">
<link rel="stylesheet" href="../../administrator/admin_view/assets/plugins/icons/feather/feather.css">
<!----<link rel="stylesheet" href="../../administrator/admin_view/assets/css/bootstrap.min.css">---->

<link rel="stylesheet" href="../../administrator/admin_view/assets/css/bootstrap-datetimepicker.min.css">

<link rel="stylesheet" href="../../administrator/admin_view/assets/css/animate.css">

<link rel="stylesheet" href="../../administrator/admin_view/assets/plugins/select2/css/select2.min.css">

<link rel="stylesheet" href="../../administrator/admin_view/assets/css/dataTables.bootstrap4.min.css">

<link rel="stylesheet" href="../../administrator/admin_view/assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="../../administrator/admin_view/assets/plugins/fontawesome/css/all.min.css">



<!---<link rel="stylesheet" href="../../administrator/admin_view/assets/css/style.css">---->

<div class="container">
    <div class="row">
        
    <?php 
    include "managestocks/view/addpurchase_form.php";
    ?>
        
    </div>
    
</div>









<script src="../assets/js/prevent_negative_numbers.js"></script>
<script src="../assets/js/login-loading.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="managestocks/javascript/toglerRemoveFromCart.js"></script>




<script src="../../administrator/admin_view/assets/js/jquery-3.6.0.min.js"></script>

<script src="../../administrator/admin_view/assets/js/feather.min.js"></script>

<script src="../../administrator/admin_view/assets/js/jquery.slimscroll.min.js"></script>

<script src="../../administrator/admin_view/assets/js/jquery.dataTables.min.js"></script>
<script src="../../administrator/admin_view/assets/js/dataTables.bootstrap4.min.js"></script>

<script src="../../administrator/admin_view/assets/js/bootstrap.bundle.min.js"></script>

<script src="../../administrator/admin_view/assets/plugins/select2/js/select2.min.js"></script>

<script src="../../administrator/admin_view/assets/js/moment.min.js"></script>
<script src="../../administrator/admin_view/assets/js/bootstrap-datetimepicker.min.js"></script>

<script src="../../administrator/admin_view/assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
<script src="../../administrator/admin_view/assets/plugins/sweetalert/sweetalerts.min.js"></script>

<script src="../../administrator/admin_view/assets/js/script.js"></script>
<script src="../../administrator/admin_view/assets/plugins/alertify/alertify.min.js"></script>

<script src="../../administrator/admin_view/assets/js/feather.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


<script src="managestocks/javascript/stocksDate.js"></script>
<script src="managestocks/javascript/temporaryStorage.js"></script>

<script src="managestocks/javascript/validationForm.js"></script>

<script src="managestocks/api/get_purchasedcart_data.js"></script>

<script src="managestocks/api/get_all_data.js"></script>


<script src="managestocks/javascript/toglerRemoveFromCart.js"></script>
</body>
</html>
