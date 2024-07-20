
$(document).ready(function() {
  var today = new Date().toISOString().split('T')[0];
  $('#preparedDeliveryDate').attr('min', today);

  $('#preparedDeliveryDate').on('change', function() {
      var selectedDate = $(this).val();
      var isValidDate = Date.parse(selectedDate);

      if (selectedDate && !isNaN(isValidDate)) {
          $('#sendRequestTogler').prop('disabled', false);
      } else {
          $('#sendRequestTogler').prop('disabled', true);
      }
  });

  
});











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






  $(document).ready(function() {

  



    $("#sendRequestTogler").on("click", function() {
     
      const fullname = $("#fullname").val();
  const acc_type = $("#acc_type").val();
  const selectedEmail = $("#supplierDropdown").val();
  const selectedSupplierText = $("#supplierDropdown option:selected").text();
  const message = $("#supplierMessage").val();
  const prod_nameinput = $("#prod_nameText").val();
  const acc_id = $("#acc_id").val();
  const preparedDeliveryDate = $("#preparedDeliveryDate").val();
  const system_contact = $("#system_contact").val();
  const system_name = $("#system_name").val();

  const productQuantities = [];

  // Gather product and quantity data
  $('.request_product').each(function(index) {
    const product = $(this).val();
    const quantity = $('.quantity_product').eq(index).val(); // Match quantity with product
    productQuantities.push({ product, quantity });
  });

  const data = {
    selectedSupplier: selectedSupplierText,
    selectedEmail: selectedEmail,
    message: message,
    prod_name: prod_nameinput,
    acc_id: acc_id,
    products: productQuantities,
    preparedDeliveryDate: preparedDeliveryDate,
    fullname: fullname,
    acc_type: acc_type,
    system_contact: system_contact,
    system_name: system_name,
  };

  console.log(data);
  
   




      // Show confirmation alert
      Swal.fire({
        title: "Are you sure?",
        text: `Send request from ${selectedEmail}`,
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, send it!",
        confirmButtonClass: "btn btn-primary",
        cancelButtonClass: "btn btn-secondary ml-1",
        buttonsStyling: false
      }).then(function(result) {
        if (result.value) {

          $("#sendRequestTogler").css("display", "none");
           $("#btnCancelModal").css("display", "none");


          $.ajax({
            type: "POST",
            url: "../../requestMailer.php",
            data: { requestData: JSON.stringify(data) }, // Sending the data as JSON string
            success: function(response) {
              console.log("Response from PHP: " + response);
              alertify.success("Request successfully sent to " + selectedEmail);
            },

            beforeSend: function() {
              $("#loadingSpinner").html('<div class="spinner-border text-warning" role="status"><span class="sr-only">Loading...</span></div>').show();
            }, 

            error: function(xhr, status, error) {
              console.error("AJAX Error: " + error);
            },
            complete: function() {
              $("#loadingSpinner").hide();
              $("#sendRequestTogler").css("display", "block");
                $("#btnCancelModal").css("display", "block");
            }
          });
        }
      });
    });
 



    $(".addStockModalTogler").on("click", function() {
      prod_name = $(this).attr('data-prod_name');
      $("#prod_nameText").val(prod_name);
  
      // Getting the checked checkboxes with the class 'checked_checkbox'
    const checkedCheckboxes = $('.checked_checkbox:checked');
    const checkedValues = checkedCheckboxes.map(function() {
      return this.value; // Get values of the checked checkboxes
    }).get();

    // Clear existing inputs
    $('#inputRow').empty();

    // Append inputs for each checked value with quantity and plus/minus buttons in the same row
    checkedValues.forEach(function(value) {
      const inputField = $('<div class="col-md-3 mb-3">' +
        '<input disabled style="border:none; width: 265px; text-align: center;" type="text" class="form-control request_product" value="' + value + '">' +
        '</div>' +
        '<div class="col-md-9 mb-3 input-group">' +
        '<button class="btn btn-outline-secondary minus-btn" type="button">-</button>' +
        '<input type="text" class="form-control quantity_product" style="width: 150px; text-align: center;" value="1">' +
        '<button class="btn btn-outline-secondary plus-btn" type="button">+</button>' +
        '</div>');

      $('#inputRow').append(inputField);
    });

   // Plus/minus button functionality
   $('.plus-btn').click(function() {
     const input = $(this).prev();
     let value = parseInt(input.val());
     if (!isNaN(value) && value >= 0) {
       value = value + 1;
       input.val(value);
     }
   });

   $('.minus-btn').click(function() {
     const input = $(this).next();
     let value = parseInt(input.val());
     if (!isNaN(value) && value > 1) {
       value = value - 1;
       input.val(value);
     }
   });

   // Validate input field for non-numeric and negative values
   $('.quantity').on('input', function() {
     const value = $(this).val();
     if (isNaN(value) || value < 0) {
       $(this).val(1); // Reset to 1 if non-numeric or negative value entered
     }
   });
 
    
    console.log(checkedValues);

    });


    $('.checkAll, .checked_checkbox').change(function() {
      const atLeastOneChecked = $('.checked_checkbox:checked').length > 0;
      $('#btnAddstocks').prop('disabled', !atLeastOneChecked);
    });

  });