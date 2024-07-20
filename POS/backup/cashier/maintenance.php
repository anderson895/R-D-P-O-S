<?php
include ('../config/config.php');
include ('../functions/session.php');
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Your head content here... -->
    <link rel="stylesheet" href="../assets/css/maintenance.css">
    <link rel="icon" href="../assets/images/logo.png" type="image/x-icon">
    <title>Maintenance</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<body>

<?php include ('../includes/navigation.php');?>

<div class="container mt-3">
    <div class="row  pb-3 " style="height: 540px;">
        <div class="col-12 col-md-4 mt-3">
            <div class="container  border pb-4 pt-3 rounded h-100">
                <h5 class="fw-bold  mb-3">Menu</h5>
                <a class="btn w-100 border mb-2" id="category-button">Manage Categories</a>
                <a class="btn w-100 border mb-2" id="unit-button">Manage Unit</a>
                <a class="btn w-100 border mb-2" id="discount-button">Manage Discount</a>
                <a class="btn w-100 border mb-2" id="tax-button">Manage Tax</a>
                <a href="../functions/logout.php" class="btn w-100 border mb-2">Logout</a>
            </div>
        </div>
        <?php include ('../functions/manage_categories.php');?>
        <?php include ('../functions/manage_units.php');?>
        <?php include ('../functions/manage_discount.php');?>
        <?php include ('../functions/manage_tax.php');?>
        

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="../assets/js/maintenance.js"></script>
</body>
</html>
