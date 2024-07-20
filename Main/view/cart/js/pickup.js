function setPickupAction() {
    document.getElementById("checkoutForm").action = "pickup.php";




    var checkedCheckboxes = $('input[name="myCheckbox[]"]:checked');
    
    // Create arrays to store cart_id and qty data
    var cartIds = [];
    var quantities = [];

    checkedCheckboxes.each(function() {
        var checkbox = $(this);
        var cartId = checkbox.closest('.product_wrap').find('.cart-id').val();
        var quantity = checkbox.closest('.product_wrap').find('.qty-input').val();

        // Push cart_id and qty data to the arrays
        cartIds.push(cartId);
        quantities.push(quantity);
    });

    // Add hidden input fields to the form and set their values
    var form = $('#checkoutForm');
    form.empty(); // Clear any previous hidden input fields

    // Add hidden input fields for cart_id and qty
    for (var i = 0; i < cartIds.length; i++) {
        form.append('<input type="hidden" name="cart_id[]" value="' + cartIds[i] + '">');
        form.append('<input type="hidden" name="qty[]" value="' + quantities[i] + '">');
    }

    // Submit the form
    form.submit();
  }