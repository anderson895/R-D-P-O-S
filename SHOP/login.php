<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <?php include('links.php')?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container d-flex flex-row justify-content-between pt-3 pb-3 align-items-center">
        <div>
            <h5 class="fw-bolder">RDPOS</h5>
        </div>
        <div>
            <a href="../SHOP/login" style="text-decoration: none; color: black"><i class="bi bi-box-arrow-in-right me-2"></i>Login</a>
            <a href="../SHOP/register" class="ms-2" style="text-decoration: none; color: black"><i class="bi bi-file-earmark-text me-2"></i>Register</a>
        </div>
    </div>
    <div class="container">
        <div class="row" style="height: 100vh; padding-top: 100px">
                <div class="col-12 col-md-4">
                        <div class="border p-5 rounded-4 shadow">
                            <h1 class="fw-bold">Login</h1>
                            <div class="form-floating mb-3">
                                <input id="username" type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Username</label>
                                </div>
                                <div class="form-floating">
                                <input id="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                                <label for="floatingPassword">Password</label>
                            </div>
                            <div class="mt-3">
                            <a href="" style="text-decoration: none; color: black">Forget Password ?</a>
                            </div>
                            <button id="login" class="mt-3 btn btn-danger btn-lg w-100">Submit</button>
                            <button disabled style="display: none;" id="login-loading" class="btn btn-lg mt-3 btn-danger w-100">
                                <div class="spinner-grow spinner-grow-sm" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </button>
                            <p class="mt-3">Don’t have an account? <a class="fw-bolder" style="text-decoration: none;" href="">Register</a></p>
                        </div>
                </div>
                <div class="col-12 col-md-6 ">
                    <img style="margin-left: 200px;" src="assets/img/cart.png" alt="">
                </div>
        </div>
    </div>
    <?php include('script.php')?>
</body>
</html>
