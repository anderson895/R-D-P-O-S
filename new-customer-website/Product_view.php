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
                <img id="mainImage" src="../upload_prodImg/<?=$image?>" alt="Product Image" class="product-image mb-4" data-bs-toggle="modal" data-bs-target="#imageModal">
             
             
             
                <!-- Modal Structure -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true" data-bs-backdrop="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <!-- Image in Modal -->
                <!-- <img id="modalImage" src="../upload_prodImg/<?=$image?>" alt="Product Image" class="img-fluid"> -->

                <div class="img-zoom-container">
                    <img id="myimage" src="../upload_prodImg/<?=$image?>" width="300" height="240">
                    
                    <div id="myresult" class="img-zoom-result"></div>
                </div>
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

    
function imageZoom(imgID, resultID) {
  var img, lens, result, cx, cy;
  img = document.getElementById(imgID);
  result = document.getElementById(resultID);
  /*create lens:*/
  lens = document.createElement("DIV");
  lens.setAttribute("class", "img-zoom-lens");
  /*insert lens:*/
  img.parentElement.insertBefore(lens, img);
  /*calculate the ratio between result DIV and lens:*/
  cx = result.offsetWidth / lens.offsetWidth;
  cy = result.offsetHeight / lens.offsetHeight;
  /*set background properties for the result DIV:*/
  result.style.backgroundImage = "url('" + img.src + "')";
  result.style.backgroundSize = (img.width * cx) + "px " + (img.height * cy) + "px";
  /*execute a function when someone moves the cursor over the image, or the lens:*/
  lens.addEventListener("mousemove", moveLens);
  img.addEventListener("mousemove", moveLens);
  /*and also for touch screens:*/
  lens.addEventListener("touchmove", moveLens);
  img.addEventListener("touchmove", moveLens);
  function moveLens(e) {
    var pos, x, y;
    /*prevent any other actions that may occur when moving over the image:*/
    e.preventDefault();
    /*get the cursor's x and y positions:*/
    pos = getCursorPos(e);
    /*calculate the position of the lens:*/
    x = pos.x - (lens.offsetWidth / 2);
    y = pos.y - (lens.offsetHeight / 2);
    /*prevent the lens from being positioned outside the image:*/
    if (x > img.width - lens.offsetWidth) {x = img.width - lens.offsetWidth;}
    if (x < 0) {x = 0;}
    if (y > img.height - lens.offsetHeight) {y = img.height - lens.offsetHeight;}
    if (y < 0) {y = 0;}
    /*set the position of the lens:*/
    lens.style.left = x + "px";
    lens.style.top = y + "px";
    /*display what the lens "sees":*/
    result.style.backgroundPosition = "-" + (x * cx) + "px -" + (y * cy) + "px";
  }
  function getCursorPos(e) {
    var a, x = 0, y = 0;
    e = e || window.event;
    /*get the x and y positions of the image:*/
    a = img.getBoundingClientRect();
    /*calculate the cursor's x and y coordinates, relative to the image:*/
    x = e.pageX - a.left;
    y = e.pageY - a.top;
    /*consider any page scrolling:*/
    x = x - window.pageXOffset;
    y = y - window.pageYOffset;
    return {x : x, y : y};
  }
}
         
// Initiate zoom effect:
imageZoom("myimage", "myresult");
         

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
    }

    // Update modal image each time the modal is shown, to match the current main image
    document.getElementById('imageModal').addEventListener('show.bs.modal', function() {
        document.getElementById('modalImage').src = document.getElementById('mainImage').src;
    });
</script>

<?php
include('components/footer.php');
?>