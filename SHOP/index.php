<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHOP</title>
    <?php include('links.php')?>
    <style>
        .container-swiper-fyke-wrapper {
            position: relative; /* Ensure the positioning of navigation buttons is relative to this container */
        }

        .container-swiper-fyke {
            display: flex;
            overflow-x: hidden;
            white-space: nowrap;
            padding: 10px 40px; /* Add padding to accommodate for the buttons */
            align-items: center; /* Align children (buttons) vertically center */
        }

        .container-swiper-fyke .btn-swiper {
            display: inline-block;
            margin-right: 10px;
            flex: 0 0 auto;
        }

        .btn-control-left, .btn-control-right {
            position: absolute;
            background: #f0f0f0;
            border: 1px solid #ccc;
            z-index: 10;
            border-radius: 100%;
            width: 30px;
            height: 30px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            top: 50%; /* Center the buttons vertically */
            transform: translateY(-50%); /* Adjust for perfect vertical alignment */
        }

        .btn-control-left {
            left: 0; /* Position to the left with some spacing from the container edge */
        }

        .btn-control-right {
            right: 0; /* Position to the right with some spacing from the container edge */
        }

    </style>
</head>
<body>
    <?php include('navigation.php')?>
    <div class="container">
        <div class="container-swiper-fyke-wrapper">
            <button class="btn-control-left btn border"><</button>
            <div class="container-swiper-fyke">
                <button class="btn btn-swiper rounded-5 border">Accessories</button>
                <button class="btn btn-swiper rounded-5 border">Food</button>
                <button class="btn btn-swiper rounded-5 border">Clothes</button>
                <button class="btn btn-swiper rounded-5 border">Toys</button>
                <button class="btn btn-swiper rounded-5 border">Beds & Furniture</button>
                <button class="btn btn-swiper rounded-5 border">Grooming</button>
                <button class="btn btn-swiper rounded-5 border">Health & Wellness</button>
                <button class="btn btn-swiper rounded-5 border">Training</button>
                <button class="btn btn-swiper rounded-5 border">Travel & Carriers</button>
                <button class="btn btn-swiper rounded-5 border">Leashes & Collars</button>
                <button class="btn btn-swiper rounded-5 border">Aquarium Supplies</button>
                <button class="btn btn-swiper rounded-5 border">Small Animal Supplies</button>
                <button class="btn btn-swiper rounded-5 border">Bird Supplies</button>
                <button class="btn btn-swiper rounded-5 border">Reptile Supplies</button>
                <button class="btn btn-swiper rounded-5 border">Pet Doors</button>
                <button class="btn btn-swiper rounded-5 border">Feeding & Watering</button>
                <button class="btn btn-swiper rounded-5 border">Cleaning & Odor Control</button>
                <button class="btn btn-swiper rounded-5 border">Pet Supplements</button>
                <button class="btn btn-swiper rounded-5 border">Outdoor Gear</button>
                <button class="btn btn-swiper rounded-5 border">Gifts & Novelties</button>
            </div>
            <button class="btn-control-right btn border">></button>
        </div>
    </div>
    <?php include('script.php')?>
</body>
</html>
