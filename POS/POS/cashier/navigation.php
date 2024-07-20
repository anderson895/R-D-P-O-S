<?php
include("back_navbar.php");

include("session.php");

// Get the current page URL
$currentURL = $_SERVER['REQUEST_URI'];
?><html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/pos_navbar.css">
</head>
<body>
    <nav>
        
        <ul>
            <div class="logo"><img src="../assets/images/logos.png" alt="rdpos logo"></div>
            <div class="navigation">
                <li><a href="index.php" <?php if (strpos($currentURL, 'index.php') !== false) echo 'style="color:yellow;"'; ?>>Pos</a></li>
                <li><a href="transaction.php" <?php if (strpos($currentURL, 'transaction.php') !== false) echo 'style="color:yellow;"'; ?>>Transactions</a></li>
                <li><a href="settings.php" <?php if (strpos($currentURL, 'settings.php') !== false) echo 'style="color:yellow;"'; ?>>Settings</a></li>
                <li><a href="logout.php">Logout</a></li>
            </div>
        </ul>
    </nav>
</body>
</html>