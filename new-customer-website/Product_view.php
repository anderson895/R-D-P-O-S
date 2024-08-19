<?php
include('components/header.php');



$id=$_GET['id'];
$productName=$_GET['productName'];

$stock = $_GET['stock'];
$stock_status = ($stock <= 0) ? 
    "<p class='stock text-danger'>Out of Stock</p>" : 
    "<p class='stock text-success'>Available Stock: " . $stock . "</p>";



$description=$_GET['description'];

$image=$_GET['image'];
$price=number_format($_GET['price'], 2);


$photos=$_GET['photos'];
$hidden_photos = ($photos == null) ? "hidden" : "";






?>
 <link rel="stylesheet" href="css/view_product.css">

    <div class="container">
      

        <div class="row mt-4">
            <div class="col-md-6 text-center">
                <img id="mainImage" src="../upload_prodImg/<?=$image?>" alt="Product Image" class="product-image mb-4">

                <div class="d-flex justify-content-center">

                <?php 
                $photosArray = explode('%2C', $photos);
                foreach ($photosArray as $photo) {
                    $escapedPhoto = htmlspecialchars($photo, ENT_QUOTES, 'UTF-8');
                    $imgSrc = '../product_photos/' . $escapedPhoto;
                    echo '<img '.$hidden_photos.' src="' . $imgSrc . '" class="thumb-img me-2 active" onclick="changeImage(\'' . $imgSrc . '\')" alt="Product Thumbnail 1">';
                }
                ?>



                    
                    <!-- <img src="../NEW UI DESIGN/no-image2.png" class="thumb-img me-2" onclick="changeImage('../NEW UI DESIGN/no-image2.png')" alt="Product Thumbnail 2">
                    <img src="../NEW UI DESIGN/no-image3.png" class="thumb-img" onclick="changeImage('../NEW UI DESIGN/no-image3.png')" alt="Product Thumbnail 3"> -->
                </div>

             
            </div>

            <div class="col-md-6">
                <h1 class="h4"><?=$productName?></h1>
                <p class="price"><?=$price?></p>
                <?=$stock_status?>

                <div class="d-flex align-items-center">
                    <button class="btn btn-maroon" id="btnViewProdAddToCart" data-prodid="<?=$id?>">Add to Cart</button>
               
                </div>

                <div class="mt-4">
                    <h5>Product Description</h5>
                    <p>
                        <?=$description?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function changeImage(src) {
            document.getElementById('mainImage').src = src;

            let thumbnails = document.querySelectorAll('.thumb-img');
            thumbnails.forEach(function(thumbnail) {
                thumbnail.classList.remove('active');
            });

            event.target.classList.add('active');
        }
    </script>

<?php
include('components/footer.php');
?>