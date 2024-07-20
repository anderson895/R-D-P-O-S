$(document).ready(function() {
    $('#confirmRemoveAll').click(function() {
    console.log('Confirm button clicked');
    var checkedItems = [];
    $('input[name="myCheckbox[]"]:checked').each(function() {
        checkedItems.push($(this).val());
    });

    console.log('Checked items:', checkedItems);

        // Send the selected item IDs to removeCart.php for processing
        $.ajax({
            type: 'POST',
            url: 'controller/remove_all.php',
            data: {
                'itemsToRemove': checkedItems
            },
            success: function(response) {
                // Handle success response from removeCart.php
                // You might want to reload the page or update the cart contents
               window.location.reload();
             //console.log(response)
            },
            error: function(error) {
                console.error('Error removing items:', error);
            }
        });
    });
});



$(document).ready(function() {
  
    $('#removeForm').submit(function(e) {
      e.preventDefault(); // Prevent the form from submitting normally

      // Serialize the form data
      var formData = $(this).serialize();

      // Send the AJAX request
      $.ajax({
        type: 'POST',
        url: 'singleRemove.php',
        data: formData,
        
        success: function(response) {
          // Display the validation result in the modal
          $('.error').html(response);
          window.location.reload();
        //  console.log(formData);
        }
      });

    });
  });










    
  
  