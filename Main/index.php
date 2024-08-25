<?php
include("back_login.php");


include("controller/maintinance.php");


include "include/session_dir.php";

include "include/header.php";
?>


<style>
        .product-card { display: none; }
        
        .navbar {
            background-color: maroon;
        }
        .navbar .nav-link {
            color: #f8f9fa;
        }
        .navbar .nav-link.active {
            color: #ffd700;
        }
        .card-header, .btn-primary, .input-group .btn, footer {
            background-color: #800000;
            color: #ffffff;
        }
        .btn-primary:hover, .input-group .btn:hover {
            color: #ffd700;
        }
        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
            border-color: maroon;
        }
        .card-img-top, .carousel-inner {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        footer a {
            color: #ffd700;
        }
        footer a:hover {
            color: #f8f9fa;
        }
        .navbar-brand img {
            height: 40px;
            width: auto;
        }

    </style>

    

<?php include "landing_page.php";?>




   
    



<?php 
include "include/footer.php";
?>







