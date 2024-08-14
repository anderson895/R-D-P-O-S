<div style="background-color: white;" class="p-3 mb-3">
    <div  class="container align-items-center d-flex flex-row justify-content-between">
        <div>
            <h5 class="fw-bolder">RDPOS</h5>
        </div>
        <div class="d-flex align-items-center flex-row">
            <div>
                <input class="form-control rounded-5 bg-light border-none" type="text" placeholder="Search">
            </div>
            <div class="dropdown">
                <button class="btn btn_nav dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <i style="font-size: 20px" class="bi bi-person"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="../SHOP/logout">Logout</a></li>
                </ul>
            </div>
            <div>
                <button class="btn_nav btn-sm position-relative" data-bs-toggle="offcanvas" href="#cart" role="button" aria-controls="offcanvasExample">
                    <i style="font-size: 20px" class="bi bi-cart"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">0</span>
                </button>
            </div>
        </div>
    </div>
</div>
<?php include("cart.php")?>