<style>
    .bottom-link {
        text-decoration: none; /* Ito ay mag-aalis ng underline sa mga links */
        color:white;
    }
</style>


<link rel="stylesheet" href="../Main/assets/css/footer.css">

<div class="div-main-buttom">
    <div class="div-main-buttom-top">
        <div class="card-cart" onclick="products();">
            <div class="card-cart-image"><img src="../Main/assets/images/cart.png" alt="cart"></div>
            <div class="card-cart-details" >SHOP NOW</div>
        </div>
        <div class="card-pay" onclick="cart();">
            <div class="card-pay-image"><img src="../Main/assets/images/pay.png" alt="pay"></div>
            <div class="card-pay-details">PAY NOW</div>
        </div>
        <div class="card-deliver" onclick="myOrders();">
            <div class="card-deliver-image"><img src="../Main/assets/images/delivery.png" alt="deliver"></div>
            <div class="card-deliver-details">DELIVER NOW</div>
        </div>
    </div>
    <div class="div-main-buttom-mid">
        <div >
            <a class="bottom-link" href="">About Us</a>
            <a class="bottom-link" href="">Contact Us</a>
            <a class="bottom-link" onclick="products();">Shop Now</a>
            <a class="bottom-link" href="">Terms and Condition</a>
            <a class="bottom-link" href="">Policy</a>
        </div>

        
    </div>
    <div class="text-center p-3 text-light" style="background-color: #6D0F0F;">
        <p>COPYRIGHT RDPOS 2023</p>
    </div>
</div>

<script src="js/directory.js"></script>