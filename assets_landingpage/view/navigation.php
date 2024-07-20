<?php 
$currentURL = $_SERVER['REQUEST_URI'];
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../upload_system/<?= $db_system_logo?>" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/navigation.css">

    
</head>
<body>
    
    <nav>
        <div class="logo">
            <div class="logo-frame">
                <!-- Dito natin i lalagay customize logo for the entire system  -->
                <img src="../upload_system/<?= $db_system_logo?>" alt="logo">
            </div>
        </div>

        <div class="navigation">
            <ul>
                <li><a href="about.php" <?php if (strpos($currentURL, 'about.php') !== false) echo 'style="color:yellow;"'; ?>>About</a></li>
                <li><a href="register.php" <?php if (strpos($currentURL, 'register.php') !== false) echo 'style="color:yellow;"'; ?>>Register</a></li>
                <li><a href="login.php" <?php if (strpos($currentURL, 'login.php') !== false) echo 'style="color:yellow;"'; ?>>Login</a></li>
                <li><a href="index.php" <?php if (strpos($currentURL, 'index.php') !== false) echo 'style="color:yellow;"'; ?>>Shopping</a></li>
            </ul>
        </div>

        <div class="burger">
            <div class="burger-frame">
                <button id="openModalBtn"><img src="assets/images/burger-bar.png" alt="logo"></button>
            </div>
        </div>
    </nav>

    <!-- modal for burger button -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <!-- <span class="close">&times;</span> -->
            <!-- Your modal content goes here -->
            <div class="menu">
                <p><a href="index.php">Shopping</a></p>
                <p><a href="login.php">Login</a></p>
                <p><a href="register.php">Register</a></p>
                <p><a href="about.php">About</a></p>
            </div>
           
        </div>
    </div>
    
    <!-- javascript links -->
    <script src="assets/javascript/navigation-burger.js"></script>

</body>
</html>