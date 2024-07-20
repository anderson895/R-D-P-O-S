$('.checkAll').change(function() {
    $('.checked_checkbox').prop('checked', $(this).prop('checked'));
  });

  $('.checked_checkbox').change(function() {
    if (!$(this).prop('checked')) {
      $('.checkAll').prop('checked', false);
    } else {
      const allChecked = $('.checked_checkbox:checked').length === $('.checked_checkbox').length;
      $('.checkAll').prop('checked', allChecked);
    }
  });


  // Function to check if at least one checkbox is checked
function isAnyCheckboxChecked() {
    return $('.checked_checkbox:checked').length > 0;
}

// Update the "Confirm" button status when checkboxes are changed
$('.checkAll, .checked_checkbox').change(function() {
    const enableButton = isAnyCheckboxChecked();
    $('.btnCunfirmReturn').prop('disabled', !enableButton);
});






function getCheckedProdData() {
    const checkedProdData = [];

    $('.checked_checkbox:checked').each(function() {
        const prodId = $(this).data('prod_id');
        const quantity = $(this).closest('tr').find('.quantityInput').val();
        const currprice = $(this).closest('tr').find('.currPrice').val();

        checkedProdData.push({ prodId, quantity ,currprice});
    });

    return checkedProdData;
}









  function incrementQty(btn) {
    var inputElement = btn.parentNode.querySelector("input[type=number]");
    var maxQty = parseInt(inputElement.getAttribute("max"));
    var currentQty = parseInt(inputElement.value);
    
    if (currentQty < maxQty) {
        inputElement.value = currentQty + 1;
    }
}

function decrementQty(btn) {
    var inputElement = btn.parentNode.querySelector("input[type=number]");
    var currentQty = parseInt(inputElement.value);
    
    if (currentQty > 1) {
        inputElement.value = currentQty - 1;
    }
}








 // Add an event listener for each input field with the class "quantityInput"
 var quantityInputs = document.querySelectorAll('.quantityInput');
 quantityInputs.forEach(function(input) {
     input.addEventListener('input', function () {
         var quantityInput = this;
         var min = parseInt(quantityInput.min);
         var max = parseInt(quantityInput.max);
         var currentValue = parseInt(quantityInput.value);

         if (currentValue < min) {
             quantityInput.value = min;
         }

         if (currentValue > max) {
             quantityInput.value = max;
         }
     });
 });





 

 $(".btnCunfirmReturn").click(function() {
    var datePurchase = $("#datePurchase").val();
    var reason = $("#reason").val();
    var returnType = $("#returnType").val();
    var transactionCode = $("#transactionCode").val();
    

    



    if (reason && returnType) {
        const productReturnInfo = getCheckedProdData();
        console.log(productReturnInfo);

        // Perform Ajax request

        $(".btnCunfirmReturn").css("display", "none");

        $.ajax({
            url: '../assets/ajax_endpoint/post_return.php', // Replace with your server-side endpoint
            method: 'POST',
            data: {
                reason: reason,
                returnType: returnType,
                datePurchase:datePurchase,
                transactionCode:transactionCode,
                productReturnInfo: productReturnInfo
            },
            success: function(response) {
                // Handle success response from the server
                console.log(response);
              
                alertify.success("Return successfully recorded");
            },

            beforeSend: function() {
                $("#loadingSpinner").html('<div class="spinner-border text-warning" role="status"><span class="sr-only">Loading...</span></div>').show();
              }, 

            error: function(error) {
                // Handle error
                console.error(error);
            },
            complete: function() {
                $("#loadingSpinner").hide();
                $(".btnCunfirmReturn").css("display", "block");

                location.reload();

              }
        });

    } else {

        if (reason === "") {
            alert("Reason is required");
        } else if (returnType === "") {
            alert("Return type is required");
        }
    }
});

