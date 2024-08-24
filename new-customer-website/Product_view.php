<?php
include('components/header.php');



$id=$_GET['id'];
echo "<input hidden type='text' name='product_id' id='product_id' value='$id'>";

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
            <div class="text-center">
                <img id="mainImage" src="../upload_prodImg/<?=$image?>" alt="Product Image" class="product-image mb-4" >

                <div class="d-flex justify-content-center">

                <div class="scroll-container">
                <?php 
                $photosArray = explode('%2C', $photos);
                foreach ($photosArray as $photo) {
                    $escapedPhoto = htmlspecialchars($photo, ENT_QUOTES, 'UTF-8');
                    $imgSrc = '../product_photos/' . $escapedPhoto;
                    echo '<img '.$hidden_photos.' src="' . $imgSrc . '" class="thumb-img me-2 active" onclick="changeImage(\'' . $imgSrc . '\')" alt="Product Thumbnail 1">';
                    

                    
                }
                ?>
                </div>



                    
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

                <div class="mt-3">
                    <h5>Ratings</h5>
                    <div class="ratings">
                        <span class="text-warning">★</span>
                        <span class="text-warning">★</span>
                        <span class="text-warning">★</span>
                        <span class="text-warning">★</span>
                        <span class="text-muted">☆</span>
                        <span>(4.0)</span>
                        <span class="text-primary">5 Ratings</span>
                    </div>
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

     <!-- Start reviews -->
     <div class="container mt-1 mb-4">
                <h4>Reviews</h4>
                <div class="scrollable-div">
                <div id="reviews-container" style="display:none; "></div>
            <script>
        $(document).ready(function() {

                    var rate_prod_id = $("#product_id").val();

                    console.log(rate_prod_id);

                    $.ajax({
                        url: 'backend/end-points/fetch_reviews.php',
                        method: 'POST',
                        data: { rate_prod_id: rate_prod_id },
                        success: function (data) {
                            console.log(data);
                            displayReviews(data);
                        },
                        error: function (xhr, status, error) {
                            console.error('Error fetching reviews:', status, error);
                        }
                    });
                });

                function displayReviews(reviews) {
                var reviewsContainer = $('#reviews-container');
                var scrollableDiv = $('.scrollable-div');

                // Check if reviews array is empty
                if (reviews.length === 0) {
                    reviewsContainer.empty(); // Clear any existing content
                    reviewsContainer.append('<p>No reviews available.</p>'); // Display no review message
                    reviewsContainer.show(); // Show the container with the message
                    scrollableDiv.css('border', 'none'); // Remove border from .scrollable-div
                    return;
                }

                // Clear existing content
                reviewsContainer.empty();

                // Append new reviews
                $.each(reviews, function (index, review) {
                    reviewsContainer.append(`
                        <div class="review mt-3">
                            <h4>${review.acc_username}</h4>
                            <p>Rate: ${generateStarButtons(review.r_rate)}</p>
                            <p>Comment: ${review.r_feedback}</p>
                        </div>

                        

                    `);
                });

                    // Show container and set border
                    reviewsContainer.show();
                    scrollableDiv.css('border', '1px solid #ccc'); // Set border for .scrollable-div
            }




                function generateStarButtons(starCount) {
                    let buttons = '';
                    for (let i = 1; i <= 5; i++) {
                        const activeClass = i <= starCount ? 'text-warning' : 'text-muted';
                       // buttons += `<button style="width:20px;" type="button" class="btn ${activeClass} " data-id="${i}"><i class="bi bi-star"></i></button>
                        buttons += `<span class="btn ${activeClass} ">★</span>
                       
                        
                        `;
                    }
                    return buttons;
                
            };
            </script>
                <!-- Add more reviews as needed -->
                </div>
            </div>

  <!-- End reviews -->

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