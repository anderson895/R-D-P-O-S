<div class="p-3">
    <div class="container align-items-center d-flex flex-row justify-content-between">
        <div>
            <h5 class="fw-bolder">RDPOS</h5>
        </div>
        <div class="d-flex align-items-center flex-row">
            <div>
                <input class="form-control rounded-5 bg-light border-none" type="text" placeholder="Search">
            </div>
            <div>
                <button class="btn_nav"><i style="font-size: 20px" class="bi bi-person"></i></i></button>
                <button class="btn_nav btn-sm position-relative" data-bs-toggle="offcanvas" href="#cart" role="button" aria-controls="offcanvasExample">
                    <i style="font-size: 20px" class="bi bi-cart"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">0</span>
                </button>
            </div>
        </div>
    </div>
</div>
<?php include("cart.php")?>