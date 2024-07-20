
    $(document).ready(function() {
      $('input[name="tcode"]').on("input", function() {
        if($(this).val().trim()!=""){
          $('#displayRecordsBtn').attr('disabled',false)
        }else{
          $('#displayRecordsBtn').attr('disabled',true)
        }
      });

      



      $('#displayRecordsBtn').attr('disabled',true)
      $('#displayRecordsBtn').click(function() {
        var transactionCode = $('input[name="tcode"]').val();
        var nextButton = document.getElementById('nextButton');

        // Itago ang button
        nextButton.style.display = 'none';

        $.ajax({
        url: '/RDPOS/RDPOS/POS/cashier/controller/online/fetch_product.php',

          type: 'POST',
          data: {
            tcode: transactionCode,
            product_qty: $("input[name='product_qty[]']").map(function() {
              return this.value;
            }).get()
          },
          dataType: 'json',
          success: function(response) {
            $('#productTableBody').empty();

            if (response.length > 0) {
              $.each(response, function(index, product) {
                console.log(product.category);
              
                var html = '<tr>'; 
                            
                html += '<td><input id="checkBox_id" type="checkbox" class="checkBoxItem" name="product[]" value="' + product.code + '" ' + (product.qty === 0 ? 'disabled' : '' || product.category==="Medicines" ? 'disabled' : '') + '></td>';
                            
                html += '<td>' + product.code + '</td>';
                html += '<td>' + product.name + '</td>';
              
                if (product.category == "Medicines") {
                  html += '<td class="col-sm-3">';
                  html += '<div class="input-group d-flex justify-content-center">';
                  html += '<center><b style="color:red;">Not returnable</b></center>';
                  html += '</div>';
                  html += '</td>';
                } else {
                  html += '<td class="col-sm-6">';
                  html += '<div class="input-group d-flex justify-content-center">';
                  html += '<button class="btn btn-secondary decreaseQtyBtn">-</button>';
                  html += ' <input type="number" name="product_qty[]" class="text-center" value="' + product.qty + '" min="1" max="' + product.qty + '" readonly> ';
                  html += '<button class="btn btn-secondary increaseQtyBtn">+</button>';
                  html += '<input name="product_date[]" type="hidden" value="' + product.orderdate + '">';
                  html += '</div>';
                  html += '</td>';
                }
                              
                html += '</tr>';
              
                $('#productTableBody').append(html);
              });
              

              var statusMessage = '';
              var statusColor = '';

              if (response[0].status === 'expired') {
                statusMessage = '<div class="row justify-content-center"><h6>7 days Guarantee has expired.</6></div>';
                statusColor = 'red';
              
                // Alisin ang checkboxes ng mga expired na produkto
                $('.checkBoxItem').remove();
              
                // Alisin din ang parent elements ng mga checkboxes upang mawala ang buong row ng produkto
                $('.checkBoxItem').closest('tr').remove();
              
                // Itago ang "Next" button
                $('#nextButton').hide();
              
                // Itago ang div na may ID "checkAllDiv"
                $('#checkAllDiv').hide();
              } else if (response[0].status === 'valid') {
                statusMessage = '<div class="row justify-content-center"><h6>7 days Guarantee is Valid</h6></div>';
                statusColor = 'green';
              
                // Ipakita ang "Next" button
                $('#nextButton').hide();
              
                // Ipakita ulit ang div na may ID "checkAllDiv"
                $('#checkAllDiv').show();
              }else if (response[0].status === 'notyet') {
                statusMessage = '<div class="row justify-content-center"><h6>Not yet successfully delivered</h6></div>';
                statusColor = 'red';
              
                // Ipakita ang "Next" button
                $('#nextButton').hide();
              
                // Ipakita ulit ang div na may ID "checkAllDiv"
                $('#checkAllDiv').hide();
                $('#productTableBody').hide();
                
              }
              
              

              // Display the status message outside the table
              $('#statusMessage').html('<h1 style="color: ' + statusColor + ';">' + statusMessage + '</h1>');
            } else {
              // Display "No records found" message outside the table
              $('#statusMessage').html('<h1 class="text-center">No records found</h1>');

              // Hide the Next button if there are no records found
              $('#nextButton').hide();
            }
          },
          error: function(xhr, status, error) {
            // Handle the error if necessary
            console.error(xhr.responseText);
          }
        });

        // Prevent default behavior of the button
        return false;
      });
    });

