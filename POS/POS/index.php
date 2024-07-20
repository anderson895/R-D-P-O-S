<?php
include("controller/session_dir.php");

include("functions.php");

include("controller/maintinance.php");

?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="icon" href="../upload_system/<?= $db_system_logo?>" type="image/x-icon">
    <title>Login</title>
</head>
<body>
    <div class="container-main">
        <div class="login"> 
            <form method="POST">
                <label for=""><h1><?= $db_system_name?></h1></label>
                <input name="UserEmail" type="text" placeholder="Email or Username">
                <input name="password" type="password" placeholder="Password" required>
                <button type="submit" name="submit">LOG IN</button>
                <div class="validation">
                <?php if(isset($_GET["failed"]) && $_GET["failed"] === "true"){ ?>   
                    <div class="message-container">
                        <p class="error-message">Login failed!</p>
                    </div>
                <?php }else{; ?>
                    <div class="">
                        <p class="" style="color: white;">Login failed!</p>
                    </div>
                <?php }?>
                </div>
                <div class="forget-register">
                <a href="">Forget Password</a>
                
                </div>
                
            </form>

            <div class="validation-compatibility">
                <p class="message">This system isn't compatible with mobile view</p>
            </div>
        </div>

    </div>
</body>
</html>


 	<!-- Footer -->
   