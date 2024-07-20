<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Barcode</title>
    <link rel="icon" href="favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/inventory.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
        @media (max-width: 767px) {
            /* CSS rules to hide border, shadow, and rounded styles for mobile screens */
            .border, .rounded, .shadow {
                border: none !important;
                box-shadow: none !important;
                border-radius: 0 !important;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-4 left"></div>
            <div class="col-12 col-md-4 border rounded shadow">
                <h3 class="fw-bolder mt-5 text-center">BARCODE GENERATOR</h3>
                <form action="barcode_generator.php" method="POST" class=" p-4 pb-5">
                <input required type="text" name="name" class="form-control" placeholder="Enter the text want to generate" maxlength="8">
                    <button type="submit" class="btn w-100 mt-2 btn-primary">Generate</button>
                    <a href="index.php" type="submit" class="btn w-100 mt-2 btn-danger">Reset</a>
                </form>
                <?php
                if (isset($_GET['status']) && $_GET['status'] === 'true') {
                    if (isset($_GET['name'])) {
                        $name = htmlspecialchars($_GET['name']);
                        echo '<div class="container mb-5 text-center" id="loader" style="display: flex; justify-content: center; align-items: center;">
                            <div class="spinner-grow text-dark" role="status">
                            <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>';

                        echo '<div class="container mb-5 text-center" id="barcode-container" style="display: none; justify-content: center; align-items: center; text-align: center;"><img src="../../uploads/barcodes/'.$name.'" ></div>';
                        echo '<script>
                                setTimeout(function() {
                                    var loader = document.getElementById("loader");
                                    loader.style.display = "none";
                                }, 3000);
                            </script>';
                        echo '<script>
                            setTimeout(function() {
                                var barcodeContainer = document.getElementById("barcode-container");
                                barcodeContainer.style.display = "flex";
                            }, 3000);
                            </script>';
                    }

                } else {
                    $status = "Status is not true";
                }
                ?>
            </div>
            <div class="col-4 right"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
