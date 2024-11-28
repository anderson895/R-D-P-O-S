<?php
include('../config/config.php');
include('../functions/maintinance.php');
session_start(); // Start the session

if (isset($_SESSION['acc_id'])) {
    // The user has an active session, so redirect to a specific page.
    header("Location: pos");
    exit();
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="icon" href="../../upload_system/<?=$db_system_logo?>" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="bg-light">


    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="row w-100 justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-lg p-4">
                    <div class="text-center mb-4 p-4 shadow-sm rounded" style="background-image: url('../../upload_system/<?=$db_system_banner?>'); background-size: cover; background-position: center; color: white;">
                    <img src="../../upload_system/<?=$db_system_logo?>" alt="Logo" class="mb-3" width="80" style="border-radius: 50%; object-fit: cover;">

                        <h2 class="fw-bolder" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 1);"><?=$db_system_name?></h2>

                    </div>


                    <form action="../functions/login.php" method="POST" id="loginForm">
                        <div class="form-floating mb-3">
                            <input required name="email" type="text" class="form-control" id="email" placeholder="Username">
                            <label for="email">Username</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input required name="pass" type="password" class="form-control" id="password" placeholder="Password">
                            <label for="password">Password</label>
                        </div>

                        <button type="submit" name="submit" style="border-radius: 10px; background-color: #760106; color: white" class="btn w-100" id="loginButton">LOGIN</button>

                        <div id="loading" class="d-none mt-3">
                            <div class="spinner-border text-danger" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>

                        <!-- Error/Validation Messages -->
                        <div class="mt-3">
                            <?php if (isset($_GET["failed"]) && $_GET["failed"] === "true") { ?>   
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                Login failed!
                            </div>
                            <?php } ?>
                        </div>

                        <div class="mt-3">
                            <?php if (isset($_GET["field"]) && $_GET["field"] === "true") { ?>   
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                Please input your credentials.
                            </div>
                            <?php } ?>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/login-loading.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
