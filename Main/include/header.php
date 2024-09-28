<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../administrator/admin_view/assets/plugins/scrollbar/scroll.min.css">
    <link rel="stylesheet" href="../administrator/admin_view/assets/plugins/alertify/alertify.min.css">

   


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="css/header.css">


    <title><?=$db_system_name?></title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .map-container {
        position: relative;
        padding-top: 75%;
        }

        .google-map {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .map-frame {
        margin-top: 20px;
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 10px;
        }

        h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #2c3e50;
        }
    </style>
  </head>


    
<nav class="navbar navbar-expand-lg custom-navbar-bg">
  <div class="container-fluid">
   <img src="../upload_system/<?=$db_system_logo?>" alt="" class="img-fluid" style="max-width: 50px;">
    <a class="navbar-brand text-light" href="index.php"><?=$db_system_name?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Offcanvas content -->
    <div class="offcanvas offcanvas-end custom-navbar-bg" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
          <img src="../upload_system/<?=$db_system_logo?>" alt="" class="img-fluid" style="max-width: 50px;">
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body custom-navbar-bg">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link text-light active" href="login.php">
              <i class="bi bi-box-arrow-in-right"></i> Login
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" aria-current="page" href="register.php">
              <i class="bi bi-person-plus"></i> Signup
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>
