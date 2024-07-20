
  // Increase quantity button click event
  $(document).on('click', '.increaseQtyBtn', function(event) {
    event.preventDefault(); // Prevent the default behavior (closing the modal)

    var input = $(this).siblings('input[type="number"]');
    var currentValue = parseInt(input.val());
    var maxValue = parseInt(input.attr('max'));

    if (currentValue < maxValue) {
      input.val(currentValue + 1);
    }
  });

  // Decrease quantity button click event
  $(document).on('click', '.decreaseQtyBtn', function(event) {
    event.preventDefault(); // Prevent the default behavior (closing the modal)

    var input = $(this).siblings('input[type="number"]');
    var currentValue = parseInt(input.val());
    var minValue = parseInt(input.attr('min'));

    if (currentValue > minValue) {
      input.val(currentValue - 1);
    }
  });

  // Additional code to handle form submission and return quantity values
  $('#requestForm').submit(function() {
    // Get all checked checkboxes and their corresponding quantities
    var selectedProducts = [];
    $('input[name="product[]"]:checked').each(function() {
      var productCode = $(this).val();
      var quantity = parseInt($(this).closest('tr').find('input[type="number"]').val());
      selectedProducts.push({ code: productCode, qty: quantity });
    });

    // Do something with the selectedProducts array (e.g., process the return quantities)
    // You can perform further actions here, such as sending the data to the server via AJAX

    // For now, let's just display the selectedProducts array in the console
    console.log(selectedProducts);

    // Close the modal after processing (optional)
    $('#request').modal('hide');

    // Prevent default form submission
    return false;
  });



  // Function to check if at least one checkbox is checked
  function checkSelectedCheckboxes() {
    const checkboxes = $('input[name="product[]"]:checked');
    if (checkboxes.length > 0) {
      $('#nextButton').show();
    } else {
      $('#nextButton').hide();
    }
  }

  // Check if at least one checkbox is checked when the page loads
  checkSelectedCheckboxes();

  // Event handler for checkbox click
  $(document).on('click', 'input[name="product[]"]', function() {
    checkSelectedCheckboxes();
  });