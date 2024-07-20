function updateFinalTotal() {
    var discountSelect = document.getElementById("discountSelect");
    var selectedDiscountRate = parseFloat(discountSelect.value);
    var discountAmount = (selectedDiscountRate / 100) * finalTotal;
    var updatedTotal = finalTotal - discountAmount;

    document.getElementById("discount").textContent = selectedDiscountRate.toFixed(2) + "%";
    document.getElementById("discountInput").value = selectedDiscountRate; // Set the selected discount value in the input field
    document.getElementById("tot").textContent = updatedTotal.toFixed(2);

    updateTotals(); // Update the totals whenever the discount changes
}

var discountSelect = document.getElementById("discountSelect");
discountSelect.addEventListener("change", updateFinalTotal);

function updateDiscountId() {
    var selectElement = document.getElementById("discountSelect");
    var selectedOption = selectElement.options[selectElement.selectedIndex];
    var selectedDiscountName = selectedOption.text;
    document.getElementById("discountname").value = selectedDiscountName;
}

function decreaseQuantity(button) {
    var quantityElement = button.nextElementSibling;
    var quantity = parseInt(quantityElement.innerText);
    var cartId = button.getAttribute("data-id");

    var priceChanger = parseFloat($('.price' + cartId).text()); // Parse price as a float
    var totalChanger = '.total' + cartId;

    var qty = (quantity <= 1) ? 1 : quantity - 1;

    var price = priceChanger * qty;
    $(totalChanger).text(price.toFixed(2));

    if (quantity > 1) {
        quantityElement.innerText = quantity - 1;
        updateQuantity(cartId, quantity - 1);
    }

    updateTotals();
}

function increaseQuantity(button) {
    var quantityElement = button.previousElementSibling;
    var quantity = parseInt(quantityElement.innerText);
    quantityElement.innerText = quantity + 1;
    var cartId = button.getAttribute("data-id");
    updateQuantity(cartId, quantity + 1);

    var priceChanger = parseFloat($('.price' + cartId).text()); // Parse price as a float
    var totalChanger = '.total' + cartId;

    var qty = (quantity <= 1) ? 1 + 1 : quantity + 1;

    var price = priceChanger * qty;
    $(totalChanger).text(price.toFixed(2));

    updateTotals();
}
function updateTotals() {
    var subtotal = 0;

    $('var.price.total').each(function () {
        var total = parseFloat($(this).text().replace(/,/g, '')); // Remove commas from formatted number
        subtotal += total;
    });

    var tax = subtotal * taxRate;

    var selectedDiscountRate = parseFloat($('#discountInput').val()); // Get selected discount from hidden input
    var discountAmount = (selectedDiscountRate / 100) * subtotal;

    var total = subtotal + tax - discountAmount;

    $('#subtot').text(subtotal.toFixed(2));
    $('#taxAmount').text(tax.toFixed(2));
    $('#discountAmount').text(discountAmount.toFixed(2));
    $('#discount').text(selectedDiscountRate.toFixed(2) + "%");
    $('#tot').text(total.toFixed(2));
}


function updateQuantity(cartId, quantity) {
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "update_cart_quantity.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            console.log("Quantity updated successfully");
        }
    };
    xhttp.send("cartId=" + cartId + "&quantity=" + quantity);
}




$(document).ready(function() {
    $('#checkoutForm').submit(function(e) {
      e.preventDefault(); // Prevent the form from submitting normally

      // Serialize the form data
      var formData = $(this).serialize();

      // Send the AJAX request
      $.ajax({
        type: 'POST',
        url: 'checkout.php',
        data: formData,
        success: function(response) {
          // Display the validation result in the modal
          $('.error').html(response);
		  console.log(response)
        }
      });
    });
  });