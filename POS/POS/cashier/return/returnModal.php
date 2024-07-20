<?php 
include("validate_transaction_code.php");
?>

<style>

  
  .fade-in {
    animation: fadeIn 0.5s forwards;
  }

  @keyframes fadeIn {
    0% {
      opacity: 0;
    }
    100% {
      opacity: 1;
    }
  }

  .fade-out {
    animation: fadeOut 0.5s forwards;
  }

  @keyframes fadeOut {
    0% {
      opacity: 1;
    }
    100% {
      opacity: 0;
    }
  }
</style>
<div class="modal fade" id="ModalReturn" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" style="width: 700px;">
    <div class="modal-content">
      <div class="modal-body">
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="float:right;"></button>
        <h1 id="customer_nameDisplay"></h1>
        <div class="container">
          <div class="row">
            <div class="col">
               
              
                
                <div class="container-fluid mb-3">
               
                  <div class="d-flex justify-content-center">
                    <!-- Return item form -->
                    <form id="returnForm">
                      <!-- Purchase information -->
                      <h3>Purchase information</h3>
                      <h4>in point of sale</h4>
                      <br>
                      <div class="mb-3">
                        <label for="date_of_purchase" class="form-label">Date of Purchase:</label>
                        <input type="date" class="form-control" id="date_of_purchase" name="date_of_purchase" required>
                      </div>
                      <div class="mb-3">
                        <label for="transaction_code" class="form-label">Transaction Code:</label>
                        <input type="text" class="form-control" id="transaction_code" name="transaction_code" placeholder="Enter Transaction Code" required>
                        <span class="error" id="Tcodeerror"></span>
                      </div>
                      <div class="mb-3">
                        <label for="product_code" class="form-label">Product Code:</label>
                        <input type="text" class="form-control" id="product_code" name="product_code" placeholder="Enter Product Code" required>
                      </div>
                      <div class="mb-3">
                        <label for="product_name" class="form-label">Product Name:</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter Product Name" required>
                      </div>

                      <div class="mb-3">
                        <label for="product_name" class="form-label">Quantity</label>
                        <input type="text" class="form-control" id="product_Quantity" name="product_Quantity" placeholder="Enter Quantity" required>
                      </div>

                      <div class="mb-3">
                        <label for="product_name" class="form-label">Total </label>
                        <input type="text" class="form-control" id="product_Total" name="product_product_Total" placeholder="Enter Product Name" required>
                      </div>

                      <div class="mb-3">
                        <label for="return_resolution" class="form-label">Desired resolution:</label>
                        <select class="form-control" id="return_resolution" name="return_resolution">
                          <option value="">Select Desired Resolution</option>
                          <option value="return">Return</option>
                          <option value="refund">Refund</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="return_reason" class="form-label">Reason for Return:</label>
                        <textarea class="form-control" id="return_reason" name="return_reason" placeholder="Enter Reason for Return" required></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary" id="nextButton">Next</button>
                    </form>
                    <!-- End of return item form -->
                  </div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="container d-flex justify-content-end">
              </div>
            </div>
          </div>
        </div>
      
      <div class="container" id="contactInfoSection" style="display: none">
        <div class="row">
          <div class="col">
            <div class="container-fluid mb-3">
              <div class="d-flex justify-content-center">
                <!-- Contact information -->
                <form id="contactForm">
                  <h3>Contact information:</h3>
                  <div class="mb-3">
                    <label for="customer_name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter Your Full Name" style="width: 400px;">
                  </div>
                  <div class="mb-3">
                    <label for="contact_number" class="form-label">Contact Number</label>
                    <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="Enter Your Contact Number" style="width: 400px;">
                  </div>
                  <div class="mb-3">
                    <label for="Address" class="form-label">Address</label>
                    <textarea class="form-control" id="Address" name="Address" placeholder="Enter Your Complete Address" style="width: 400px;"></textarea>
                  </div>
                  <button type="button" class="btn btn-primary" id="backButton" style="display: none" onclick="goBack()">Back</button>
                  <button type="button" class="btn btn-primary" onclick="submitForms()">Save</button>
                </form>
                <!-- End of contact information form -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('#returnForm').submit(function(e) {
      e.preventDefault(); // Prevent the form from submitting normally

      // Serialize the form data
      var formData = $(this).serialize();

      // Send the AJAX request
      $.ajax({
        type: 'POST',
        url: 'validate_transaction_code.php',
        data: formData,
        success: function(response) {
          var response = response.replace(/\s/g, "");

          if(response == "200"){
            next()
          }else{


            $('#Tcodeerror').html("Transaction code NOT FOUND").css("color", "red");

            
          }
        
        }
      });
    });
  });
</script>

<script>
  var currentForm = "purchaseInfoForm";

  function next() {
    // Retrieve form values
    var dateOfPurchase = document.getElementById("date_of_purchase").value;
    var productCode = document.getElementById("product_code").value;
    var transactionCode = document.getElementById("transaction_code").value;
    var productName = document.getElementById("product_name").value;
    var returnReason = document.getElementById("return_reason").value;
    var return_resolution = document.getElementById("return_resolution").value;
   
    // Check if all fields are filled
    if (dateOfPurchase && productCode && transactionCode && productName && returnReason && return_resolution) {
      // Save the purchase information or perform necessary actions
      // Example: You can store the values in variables or send them to a server via AJAX

      // Display the contact information section
      document.getElementById("contactInfoSection").style.display = "block";
      document.getElementById("backButton").style.display = "inline-block";

      // Hide the purchase information form with a fade-out animation
      document.getElementById("returnForm").classList.add("fade-out");
      setTimeout(function() {
        document.getElementById("returnForm").style.display = "none";
        document.getElementById("returnForm").classList.remove("fade-out");
      }, 500);

      // Apply a fade-in animation to the contact information section
      document.getElementById("contactInfoSection").classList.add("fade-in");

      currentForm = "contactInfoForm";
    } else {
      alert("Please fill in all fields in the purchase information form.");
    }
  }


  function goBack() {
  if (currentForm === "contactInfoForm") {
    // Go back to the purchase information form

    // Display the purchase information form with a fade-in animation
    document.getElementById("returnForm").classList.add("fade-in");
    document.getElementById("returnForm").style.display = "block";

    // Hide the contact information section with a fade-out animation
    document.getElementById("contactInfoSection").classList.add("fade-out");
    setTimeout(function() {
      document.getElementById("contactInfoSection").style.display = "none";
      document.getElementById("contactInfoSection").classList.remove("fade-out");
    }, 500);

    // Hide the "BACK" button
    document.getElementById("backButton").style.display = "none";

    currentForm = "purchaseInfoForm";
  } else {
    // Add your desired actions when there is no previous form
    console.log("No previous form.");
  }
}

</script>

<!---start 1 button in 2 forms--->
<script>
        function submitForms() {
            // Get form data
            var form1Data = new FormData(document.getElementById("returnForm"));
            var form2Data = new FormData(document.getElementById("contactForm"));

            // Combine form data
            var combinedData = new FormData();
            for (var pair of form1Data) {
                combinedData.append(pair[0], pair[1]);
            }
            for (var pair of form2Data) {
                combinedData.append(pair[0], pair[1]);
            }

            // Create and submit a hidden form
            var hiddenForm = document.createElement("form");
            hiddenForm.action = "returnModal_Back.php";
            hiddenForm.method = "POST";
            hiddenForm.style.display = "none";
            hiddenForm.enctype = "multipart/form-data";
            hiddenForm.appendChild(createInput("combinedData", JSON.stringify(Object.fromEntries(combinedData))));

            document.body.appendChild(hiddenForm);
            hiddenForm.submit();
        }

        function createInput(name, value) {
            var input = document.createElement("input");
            input.type = "hidden";
            input.name = name;
            input.value = value;
            return input;
        }
    </script>
    <!---end 1 button in 2 forms--->

    
