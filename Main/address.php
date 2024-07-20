<?php 
include("controller/maintinance.php");


include "include/session_dir.php";

$current_date = date('Y-m-d');


?>



<!doctype html>
<html class="no-js" lang="zxx">
    
<!-- index-431:41-->
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?php echo htmlspecialchars($db_system_name); ?> || Browse product</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="../upload_system/<?php echo htmlspecialchars($db_system_logo); ?>">
        <!-- Material Design Iconic Font-V2.2.0 -->
        <!-- Your custom CSS files -->
<link rel="stylesheet" href="css/material-design-iconic-font.min.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/fontawesome-stars.css">
<link rel="stylesheet" href="css/meanmenu.css">
<link rel="stylesheet" href="css/owl.carousel.min.css">
<link rel="stylesheet" href="css/slick.css">
<link rel="stylesheet" href="css/animate.css">
<link rel="stylesheet" href="css/jquery-ui.min.css">
<link rel="stylesheet" href="css/venobox.css">
<link rel="stylesheet" href="css/nice-select.css">
<link rel="stylesheet" href="css/magnific-popup.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/helper.css">
<link rel="stylesheet" href="css/style.css">


    </head>
    <style>
    a {
        text-decoration: none;
    }
</style>

    <body>
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
        <!-- Begin Body Wrapper -->
        <div class="body-wrapper" >
            <!-- Begin Header Area -->
            <header class="li-header-4" style="background-color:#600000;">
                <!-- Begin Header Top Area -->
                <div class="header-top">
                    <div class="container">
                        <div class="row">
                            <!-- Begin Header Top Left Area -->
                            <div class="col-lg-3 col-md-4">
                                <div class="header-top-left">
                                    <ul class="phone-wrap">
                                        <li><span>Contact Enquiry:</span><a href="#"> <?=$db_system_contact?></a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Header Top Left Area End Here -->
                            <!-- Begin Header Top Right Area -->
                            <div class="col-lg-9 col-md-8">
                                <div class="header-top-right">
                                    <ul class="ht-menu">
                                        <!-- Begin Setting Area -->
                                        
                                      
                                        <!-- Begin Language Area -->
                                        <li>
                                        <span class="language-selector-wrapper">
                                        <i class="fa fa-lock" style="font-size:15px"></i> <a style="color:white;" href='login.php'>Login</a>
                                        </span>
                                    </li>

                                    <li>
                                        <span class="language-selector-wrapper" >
                                        <i class="fa fa-user-plus" style="font-size:15px"></i><a style="color:white;" href='register.php'> Create account</a>
                                        </span>
                                    </li>

                                        <!-- Language Area End Here -->
                                    </ul>
                                </div>
                            </div>
                            <!-- Header Top Right Area End Here -->
                        </div>
                    </div>
                </div>
                <!-- Header Top Area End Here -->
                <!-- Begin Header Middle Area -->
                <div class="header-middle pl-sm-0 pr-sm-0 pl-xs-0 pr-xs-0">
                    <div class="container">
                        <div class="row">
                            <!-- Begin Header Logo Area -->
                            <div class="col-lg-3">
                                <div class="logo pb-sm-30 pb-xs-30">
                                <div class="d-flex">
    <a href="index.php">
        <img src="../upload_system/<?php echo htmlspecialchars($db_system_logo); ?>" style="width:50px;" alt="">
    </a>
    <a href="index.php">
        <h1 style="color: white;"><?php echo htmlspecialchars($db_system_name); ?></h1>
    </a>
</div>



                                </div>
                            </div>
                            <!-- Header Logo Area End Here -->
                            <!-- Begin Header Middle Right Area -->
                            <div class="col-lg-9 pl-0 ml-sm-15 ml-xs-15">
                                <!-- Begin Header Middle Searchbox Area -->
                                <form action="#" class="hm-searchbox">
                                    
                                    <input id="searchInput" type="text" placeholder="Enter your search key ...">
    <button class="li-btn" type="button" ><i class="fa fa-search"></i></button>
    <div id="suggestionsContainer" style="background-color:transparent; position: absolute; top: 100%; z-index: 9999;">
    

        <!-- Dito mo ilalagay ang mga suggestions -->
    </div>


                                  

                                </form>
                              
                                <div class="header-middle-right">
                                    <ul class="hm-menu">
                                       
                                            <span></span>
                                            <div class="minicart">
                                                <ul class="minicart-product-list">
                                                    <li>
                                                        <a href="single-product.html" class="minicart-product-image">
                                                            <img src="images/product/small-size/1.jpg" alt="cart products">
                                                        </a>
                                                        <div class="minicart-product-details">
                                                            <h6><a href="single-product.html">Aenean eu tristique</a></h6>
                                                            <span>£40 x 1</span>
                                                        </div>
                                                        <button class="close">
                                                            <i class="fa fa-close"></i>
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <a href="single-product.html" class="minicart-product-image">
                                                            <img src="images/product/small-size/2.jpg" alt="cart products">
                                                        </a>
                                                        <div class="minicart-product-details">
                                                            <h6><a href="single-product.html">Aenean eu tristique</a></h6>
                                                            <span>£40 x 1</span>
                                                        </div>
                                                        <button class="close">
                                                            <i class="fa fa-close"></i>
                                                        </button>
                                                    </li>
                                                </ul>
                                                <p class="minicart-total">SUBTOTAL: <span>£80.00</span></p>
                                                <div class="minicart-button">
                                                    <a href="checkout.html" class="li-button li-button-dark li-button-fullwidth li-button-sm">
                                                        <span>View Full Cart</span>
                                                    </a>
                                                    <a href="checkout.html" class="li-button li-button-fullwidth li-button-sm">
                                                        <span>Checkout</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- Header Mini Cart Area End Here -->
                                    </ul>
                                </div>
                                <!-- Header Middle Right Area End Here -->
                            </div>
                            
                            <!-- Header Middle Right Area End Here -->
                            
                        </div>
                        
                    </div>
                    
                </div>
                
                <!-- Header Middle Area End Here -->
                <!-- Begin Header Bottom Area -->
                <div class="header-bottom header-sticky stick d-none d-lg-block d-xl-block" style="background: gray;">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                               <!-- Begin Header Bottom Menu Area -->
                               <div class="hb-menu">
                                   <nav>
                                       <ul>
                                        
                                           <li ><a href="index.php">Home</a> </li>

                                           
                                          
                                          
                                           <li><a href="about-us.html">About Us</a></li>
                                           <li><a href="contact.html">Contact</a></li>
                                         
                                       </ul>
                                   </nav>
                               </div>
                               <!-- Header Bottom Menu Area End Here -->
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Header Bottom Area End Here -->
                <!-- Begin Mobile Menu Area -->
                <div class="mobile-menu-area mobile-menu-area-4 d-lg-none d-xl-none col-12">
                    <div class="container"> 
                        <div class="row">
                            <div class="mobile-menu">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Mobile Menu Area End Here -->
            </header>
            <!-- Header Area End Here -->
            <!-- Begin Slider With Banner Area -->























<?php
include "view/Signup/signup.php";
?>
































          
            <!-- Quick View | Modal Area End Here -->
        </div>
        
        <!-- Body Wrapper End Here -->
        <!-- jQuery-V1.12.4 -->
        <script src="js/vendor/jquery-1.12.4.min.js"></script>
        <!-- Popper js -->
        <script src="js/vendor/popper.min.js"></script>
        <!-- Bootstrap V4.1.3 Fremwork js -->
        <script src="js/bootstrap.min.js"></script>
        <!-- Ajax Mail js -->
        <script src="js/ajax-mail.js"></script>
        <!-- Meanmenu js -->
        <script src="js/jquery.meanmenu.min.js"></script>
        <!-- Wow.min js -->
        <script src="js/wow.min.js"></script>
        <!-- Slick Carousel js -->
        <script src="js/slick.min.js"></script>
        <!-- Owl Carousel-2 js -->
        <script src="js/owl.carousel.min.js"></script>
        <!-- Magnific popup js -->
        <script src="js/jquery.magnific-popup.min.js"></script>
        <!-- Isotope js -->
        <script src="js/isotope.pkgd.min.js"></script>
        <!-- Imagesloaded js -->
        <script src="js/imagesloaded.pkgd.min.js"></script>
        <!-- Mixitup js -->
        <script src="js/jquery.mixitup.min.js"></script>
        <!-- Countdown -->
        <script src="js/jquery.countdown.min.js"></script>
        <!-- Counterup -->
        <script src="js/jquery.counterup.min.js"></script>
        <!-- Waypoints -->
        <script src="js/waypoints.min.js"></script>
        <!-- Barrating -->
        <script src="js/jquery.barrating.min.js"></script>
        <!-- Jquery-ui -->
        <script src="js/jquery-ui.min.js"></script>
        <!-- Venobox -->
        <script src="js/venobox.min.js"></script>
        <!-- Nice Select js -->
        <script src="js/jquery.nice-select.min.js"></script>
        <!-- ScrollUp js -->
        <script src="js/scrollUp.min.js"></script>
        <!-- Main/Activator js -->
        <script src="js/main.js"></script>







        <script src='controller/javascript/searchAjax.js'></script>
<script src='controller/javascript/product.js'></script>
<script src='view/view/js/function.js'></script>



<script src="assets/javascript/registerLen_validation.js"></script>
<script src="assets/javascript/password_creation.js"></script>
<script src="assets/javascript/email_validation.js"></script>




</body>
</html>
<!---
<script src='controller/register/js/address_api.js'></script>

<script src="controller/register/js/validation.js"></script> --->

