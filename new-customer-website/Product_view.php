<?php
include('components/header.php');



$id=$_GET['id'];
echo "<input hidden type='text' name='product_id' id='product_id' value='$id'>";

$productName=$_GET['productName'];

$stock = $_GET['stock'];
$stock_status = ($stock =="Out of Stock") ? 
    "<p class='stock text-danger'>Out of Stock</p>" : 
    "<p class='stock text-success'>Available Stock : " . $stock . "</p>";



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
                 <!-- Main Image with Zoom Functionality -->
                <div class="img-magnifier-container">
                    <img id="mainImage" src="../upload_prodImg/<?=$image?>" alt="Product Image" class="product-image mb-4" data-bs-toggle="modal" data-bs-target="#imageModal">
                </div>
                <!-- Modal Structure -->
                <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true" data-bs-backdrop="false">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                <!-- Image in Modal -->
                                <img id="modalImage" src="../upload_prodImg/<?=$image?>" alt="Product Image" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>


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



                    
                  
                </div>

             
            </div>

            <div class="col-md-6">
                <h1 class="h4"><?=$productName?></h1>
                <p class="price">₱ <?=$price?></p>
                <?=$stock_status?>

                <div class="d-flex align-items-center">
                    <button class="btn btn-maroon" id="btnViewProdAddToCart" data-prodid="<?=$id?>">Add to Cart</button>
                </div>

                <div class="mt-3">
                    <h5>Ratings</h5>
                    <div class="ratings">
                        <span id="star1" class="text-muted">☆</span>
                        <span id="star2" class="text-muted">☆</span>
                        <span id="star3" class="text-muted">☆</span>
                        <span id="star4" class="text-muted">☆</span>
                        <span id="star5" class="text-muted">☆</span>
                        <span id="avg-rating">(0.0)</span>
                        <span id="total-ratings" class="text-primary">0 Ratings</span>
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
     <div class="container mt-3" >
                <h4>Reviews</h4>
                <div class="scrollable-div">
                <div id="reviews-container" style="display:none;"></div>
                <script>
                    
$(document).ready(function() {
    // Fetch product ID from the hidden input or any other element
    var rate_prod_id = $("#product_id").val();

    console.log(rate_prod_id);

    // Fetch and display reviews
    $.ajax({
        url: 'backend/end-points/fetch_reviews.php',
        method: 'POST',
        data: { rate_prod_id: rate_prod_id },
        dataType: 'json',
        success: function(data) {
            console.log(data);
            displayReview(data);
        },
        error: function(xhr, status, error) {
            console.error('Error fetching reviews:', status, error);
        }
    });

    // Fetch and display average rating
    $.ajax({
        url: 'backend/end-points/get_average_rating.php',
        type: 'GET',
        data: { prod_id: rate_prod_id },
        dataType: 'json',
        success: function(response) {
            console.log(response);
            if (response.error) {
                console.error(response.error);
                return;
            }

            var avgRating = response.avg_rating;
            var totalRatings = response.total_ratings;

            // Update the average rating text
            $('#avg-rating').text('(' + avgRating + ')');
            $('#total-ratings').text(totalRatings + ' Ratings');

            // Update the star ratings
            for (var i = 1; i <= 5; i++) {
                var star = $('#star' + i);
                if (i <= Math.floor(avgRating)) {
                    star.removeClass('text-muted').addClass('text-warning').text('★');
                } else {
                    star.removeClass('text-warning').addClass('text-muted').text('☆');
                }
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching average rating:', status, error);
        }
    });
});

// Function to display reviews
function displayReview(reviews) {
    var reviewsContainer = $('#reviews-container');
    var scrollableDiv = $('.scrollable-div');

    if (!reviews || reviews.length === 0) {
        reviewsContainer.empty(); 
        reviewsContainer.append('<p>No reviews available.</p>'); 
        reviewsContainer.show();
        scrollableDiv.css('border', 'none'); 
        return;
    }

    // Clear existing content
    reviewsContainer.empty();

    // Append new reviews
    $.each(reviews, function(index, review) {
    const formattedDate = new Date(review.r_date_added).toLocaleDateString(); // Adjust the date format as needed
    reviewsContainer.append(`
        <div class="review-entry d-flex align-items-start mb-3">
            <div class="me-3">
                ${review.emp_image ? 
                    `<img src="../upload_img/${review.emp_image}" alt="${review.acc_username}'s image" class="mt-2 rounded-circle" style="width: 50px; height: 50px;">` : 
                    `<i class="bi bi-person-fill" style="font-size: 50px;"></i>`
                }
            </div>
            <div>
                <h6>${review.acc_username}</h6>
                <div class="ratings">
                    <p>${generateStarButtonsss(review.r_rate)}</p>
                </div>
                <p class="mt-2">${review.r_feedback}</p>
                <p class="text-muted mt-1">Commented on: ${formattedDate}</p> <!-- Displaying the comment date -->
            </div>
        </div>
        <hr>
    `);
});


    // Show container and set border
    reviewsContainer.show();
    scrollableDiv.css('border', '1px solid #ccc'); // Set border for .scrollable-div
}

// Function to generate star ratings
function generateStarButtonsss(starCount) {
    let buttons = '';
    for (let i = 1; i <= 5; i++) {
        const activeClass = i <= starCount ? 'text-warning' : 'text-muted';
        buttons += `<span class="${activeClass}">★</span>`;
    }
    return buttons;
}
</script>

                <!-- Add more reviews as needed -->
                </div>
            </div>

  <!-- End reviews -->

  <script>
    function changeImage(src) {
        // Update the main image source
        document.getElementById('mainImage').src = src;
        
        // Update the modal image to match the main image's new source
        document.getElementById('modalImage').src = src;

        // Remove 'active' class from all thumbnails
        let thumbnails = document.querySelectorAll('.thumb-img');
        thumbnails.forEach(function(thumbnail) {
            thumbnail.classList.remove('active');
        });

        // Add 'active' class to the clicked thumbnail
        event.target.classList.add('active');

        // Update the magnifier function with the new image
        magnify('mainImage', 3); // Adjust the magnification level as needed
    }

    function magnify(imgID, zoom) {
        var img, glass;
        img = document.getElementById(imgID);

        // Create magnifier glass
        glass = document.createElement("div");
        glass.setAttribute("class", "img-magnifier-glass");

        // Insert magnifier glass
        img.parentElement.insertBefore(glass, img);

        // Set background properties for the glass
        glass.style.backgroundImage = "url('" + img.src + "')";
        glass.style.backgroundRepeat = "no-repeat";
        glass.style.backgroundSize = (img.width * zoom) + "px " + (img.height * zoom) + "px";

        // Set event listeners to move the glass when hovering over the image
        glass.addEventListener("mousemove", moveMagnifier);
        img.addEventListener("mousemove", moveMagnifier);

        glass.addEventListener("mouseleave", function() {
            glass.remove(); // Remove the glass when not hovering over the image
        });

        function moveMagnifier(e) {
            var pos, x, y;
            e.preventDefault();
            pos = getCursorPos(e);
            x = pos.x;
            y = pos.y;

            // Prevent the magnifier glass from being positioned outside the image
            if (x > img.width - (glass.offsetWidth / zoom)) {x = img.width - (glass.offsetWidth / zoom);}
            if (x < glass.offsetWidth / zoom) {x = glass.offsetWidth / zoom;}
            if (y > img.height - (glass.offsetHeight / zoom)) {y = img.height - (glass.offsetHeight / zoom);}
            if (y < glass.offsetHeight / zoom) {y = glass.offsetHeight / zoom;}

            // Move the glass and change the background position
            glass.style.left = (x - glass.offsetWidth / 2) + "px";
            glass.style.top = (y - glass.offsetHeight / 2) + "px";
            glass.style.backgroundPosition = "-" + ((x * zoom) - glass.offsetWidth / 2) + "px -" + ((y * zoom) - glass.offsetHeight / 2) + "px";
        }

        function getCursorPos(e) {
            var a, x = 0, y = 0;
            e = e || window.event;
            // Get the x and y positions of the image
            a = img.getBoundingClientRect();
            // Calculate the cursor's x and y coordinates, relative to the image
            x = e.pageX - a.left;
            y = e.pageY - a.top;
            // Consider page scrolling
            x = x - window.pageXOffset;
            y = y - window.pageYOffset;
            return {x: x, y: y};
        }
    }

    // Initialize the magnifier function when the page loads
    window.onload = function() {
        magnify('mainImage', 3); // Adjust the zoom level as needed
    };
</script>

<style>
    .img-magnifier-container {
        position: relative;
    }

    .img-magnifier-glass {
        position: absolute;
        border: 3px solid #000;
        border-radius: 50%;
        cursor: none;
        width: 100px; /* Adjust the size of the magnifier glass */
        height: 100px; /* Adjust the size of the magnifier glass */
        opacity: 0.7; /* Adjust transparency */
    }
</style>

<?php
include('components/footer.php');
?>