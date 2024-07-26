<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/navigation.css">
    <link rel="stylesheet" href="../assets/css/reset.css">
    <title>navigation</title>
</head>

<body>

    <nav>


        <ul class="standard-menu" onclick="window.location.href = '<?php if ($db_acc_type == "administrator") {
                                                                        echo '../../administrator/admin_view/index.php';
                                                                    } else {
                                                                        echo '#';
                                                                    } ?>';">
            <li><img src="../assets/images/logos.png" alt="LOGO"></li>
            <li>
                <h4 class="fw-bolder">RDPOS</h4>
            </li>

        </ul>


        <ul class="right-menu">
            <li><a class="btn a" href="../pages/pos">Pos</a></li>
            <li><a class="btn a" href="../pages/transaction">Transaction</a></li>
           
            <li class=" dropdown">
                <a class="btn a dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Settings
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><a class="dropdown-item" href="../pages/maintenance">Maintenance</a></li>
                    <li><a class="dropdown-item" href="../functions/logout.php">Logout</a></li>
                </ul>
            </li>

        </ul>
        <ul class="right-menu-burger">
            <a href=""><img src="../assets/images/burger.png" class="burger" alt=""></a>
        </ul>
    </nav>

</body>

</html>