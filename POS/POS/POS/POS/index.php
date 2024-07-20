<?php
    include 'connection.php'
    
?>




<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="icon" href="assets/images/logos.png" type="image/x-icon">
    <title>Login</title>
</head>
<body>
    <div class="container-main">
        <div class="login"> 
            <form action="functions.php" method="POST">
                <label for=""><h1>RDPOS</h1></label>
                <input name="email" type="email" placeholder="Email">
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
                <a  href="">Register</a>
                </div>
                
            </form>

            <div class="validation-compatibility">
                <p class="message">This system isn't compatible with mobile view</p>
            </div>
        </div>

    </div>
</body>
</html>