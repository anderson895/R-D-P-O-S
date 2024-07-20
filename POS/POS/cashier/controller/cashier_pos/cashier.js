function updateQuantity(cartId, quantity) {
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "update_cart_quantity.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            console.log("Quantity updated successfully");
        }
    };
    xhttp.send("cartId=" + cartId + "&quantity=" + quantity);
}