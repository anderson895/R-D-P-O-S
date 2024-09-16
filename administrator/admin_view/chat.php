<?php
include "backend/back_navbar.php";
include "php/session_dir.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<meta name="description" content="POS - Bootstrap Admin Template">
<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern,  html5, responsive">
<meta name="author" content="Dreamguys - Bootstrap Admin Template">
<meta name="robots" content="noindex, nofollow">
<title>Messages</title>



<link rel="stylesheet" href="assets/plugins/scrollbar/scroll.min.css">

<link rel="stylesheet" href="assets/plugins/alertify/alertify.min.css">

<link rel="stylesheet" href="assets/css/bootstrap.min.css">

<link rel="stylesheet" href="assets/css/animate.css">

<link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">

<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

<link rel="stylesheet" href="assets/css/style.css">


<!---<link rel="stylesheet" href="chat/css/videocall.css">--->

<!---<link rel="stylesheet" href="chat/css/audio.css">--->

<!---<link rel="stylesheet" href="css/search_suggestion.css">--->


</head>

<?php 
// include("backend/back_navbar.php");

//include "php/count_message.php";
?>

<body>
<div id="global-loader">
<div class="whirly-loader"> </div>
</div>

<div class="main-wrapper">

<div class="header">

            <?php include "topBar/header.php"; ?>

    <ul class="nav user-menu">
            <?php include "topBar/navMenu.php"; ?>
            <?php include "topBar/notification.php"; ?>
            <?php include "topBar/profile.php"; ?>
    </ul>

    <?php include "topbar/mobilUserMenu.php"; ?>
</div>
    <?php  include "Section/sidebar.php"; ?>

    <!---start changable content---->
 
    <?php  include "chat/view/chatForm.php"; ?>
    <!---end changable content---->
</div>
</div>
</div>
</div>
</div>

<div class="searchpart">
<div class="searchcontent">
<div class="searchhead">
<h3>Search </h3>
<a id="closesearch"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
</div>
<div class="searchcontents">
<div class="searchparts">
<input type="text" placeholder="search here">
<a class="btn btn-searchs">Search</a>
</div>
<div class="recentsearch">
<h2>Recent Search</h2>
<ul>
<li>


<h6><i class="fa fa-search me-2"></i> Settings</h6>
</li>
<li>
<h6><i class="fa fa-search me-2"></i> Report</h6>
</li>
<li>
<h6><i class="fa fa-search me-2"></i> Invoice</h6>
</li>
<li>
<h6><i class="fa fa-search me-2"></i> Sales</h6>
</li>
</ul>
</div>
</div>
</div>
</div>

<script src="assets/js/jquery-3.6.0.min.js"></script>

<script src="assets/js/feather.min.js"></script>

<script src="assets/js/jquery.slimscroll.min.js"></script>

<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap4.min.js"></script>

<script src="assets/js/bootstrap.bundle.min.js"></script>

<script src="assets/plugins/apexchart/apexcharts.min.js"></script>
<script src="assets/plugins/apexchart/chart-data.js"></script>

<script src="assets/js/script.js"></script>









<script src="chat/javascript/functions.js"></script>
<script src="chat/javascript/search.js"></script>

<script src="chat/javascript/getmessage.js"></script>

<script src="chat/javascript/getViewMessage.js"></script>


<script src="chat/javascript/insertMessage.js"></script>



<!--script src="https://cdn.rawgit.com/mattdiamond/Recorderjs/08e7abd9/dist/recorder.js"></script>-->

<!---<script src="chat/javascript/videocall.js"></script>--->

<!--<script src="chat/javascript/recordVoice.js"></script>--->

</body>
</html>