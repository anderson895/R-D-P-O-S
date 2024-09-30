<?php
include ('../config/config.php');
include ('../functions/maintinance.php');

?>

<?php
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
    <link rel="stylesheet" href="../assets/css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row mt-4">
        <div class="col-12 col-md-4"></div>
        <div class="col-12 col-md-4 mt-5">
            <form action="../functions/login.php" method="POST" class="form form-control pb-5 px-5 mt-5 shadow" id="loginForm">
                <div class="mt-5">
                    <img src="../../upload_system/<?=$db_system_logo?>" alt="">
                    <h1 class="fw-bolder"><?=$db_system_name?></h1>
                </div>
                
                <!-- Email or Username Field with Floating Label -->
                <div class="form-floating mb-3">
                    <input required name="email" type="text" class="form-control" id="email" placeholder="Username">
                    <label for="email">Username</label>
                </div>

                <!-- Password Field with Floating Label -->
                <div class="form-floating mb-3">
                    <input required name="pass" type="password" class="form-control" id="password" placeholder="Password">
                    <label for="password">Password</label>
                </div>

                <button type="submit" name="submit" class="login btn w-100" id="loginButton" onclick="login()">LOGIN</button>
                
                <div id="loading" class="d-none rounded loading">
                    <div class="spinner-border text-danger" role="status">
                        <span class="visually-hidden">Loading ...</span>
                    </div>
                </div>
                
                <div class="validation">
                    <?php if(isset($_GET["failed"]) && $_GET["failed"] === "true"){ ?>   
                    <div class="message-container error rounded mt-2 w-100">
                        Login failed!
                    </div>
                    <?php }?>
                </div>
                <div class="validation">
                    <?php if(isset($_GET["field"]) && $_GET["field"] === "true"){ ?>   
                    <div class="message-container error rounded mt-2 w-100">
                        Please input your credential
                    </div>
                    <?php }?>
                </div>
            </form>
        </div>
        <div class="col-12 col-md-4"></div>
    </div>
</div>


<script src="../assets/js/login-loading.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
