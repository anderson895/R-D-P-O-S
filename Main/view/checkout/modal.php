<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- Modal -->
<div class="modal fade" id="DeleteAddressModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Warning</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    
                <h5 class="text-center">Delete address ?</h5>

            
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="btnDelete">Confirm</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">No</button>
                </div>
            
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">[Payment] Transaction</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              
                    <select id="BankEwallet" name="paymethod" class="form-control mt-2" title="Select payment option" required>
                        <option value="">Payment option</option>
                        <option value="Cash on Delivery">Cash on Delivery</option>
                     
                        <?php
                        $view_product_query = mysqli_query($connections, "SELECT * FROM mode_of_payment where payment_status='1'");
                        while ($category_row = mysqli_fetch_assoc($view_product_query)) {
                            $payment_id  = $category_row["payment_id"];
                            $payment_name = $category_row["payment_name"];
                            $payment_number = $category_row["payment_number"];
                            $payment_image = $category_row["payment_image"];
                            $payment_status = $category_row["payment_status"];
                            ?>
                            <option data-image="<?= $payment_image ?>" data-number="<?= $payment_number ?>" value="<?= $payment_name ?>"><?= $payment_name ?></option>
                        <?php }?>
                    </select>

                    <input type="hidden" id="UpdatedShipFee" name="ship_fee" value='<?php echo number_format($address_rate, 2) ?>'>

                    <input type="hidden" class="form-control mt-2" id="order_id" name="ssid" required>
                    <input type="hidden" id="discount-name-placeOrder" name="discountname">

                    <input type="hidden" id="discount-rate-placeOrder" name="discountrate">
                    <input type="hidden" value="<?php echo $db_system_tax ?>" name="orders_tax">

              
                
                    <div class="form-group mt-2 text-center" id="proofAttachment" style="display: none;">
    
                    <div id="paymentImage" class="payment-image"></div>
                    <div id="paymentNumber" class="mt-2"></div>
                    <label for="attachment">Attach Proof of Payment:</label>
                    <input type="file" name="attachment" id="paymentAttachment" class="form-control" accept="image/*">

                </div>
                
                <div id="loadingSpinner" class="text-center" style="display: none;">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="border: none;">
                <button disabled type="button" name="btnCunfirm" id="btnCunfirmOrder" class="btn btn-danger">Confirm</button>
                <button type="button" id="no" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">No</button>
            </div>
        </div>
    </div>
</div>

<!-- Add Address Modal 
#F5F5F5
#FEFCFF
-->

<div class="modal fade" id="addAddressMod" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Address</h5>
            </div>
<div style="background-color:#F5F5F5;">

            <div class="modal-body d-flex justify-content-center align-items-center">
                <button type="button" class="btn btn-flat btn-light active" id="selectAddressBtn">Select Address</button>
                <button type="button" class="btn btn-flat btn-light" id="pinLocationBtn">Pin Location</button>
            </div>


            <form method="POST">

            <!-- Fullname -->
 
    <div class="form-group m-0">
        
    <div class="bg-light rounded ">
    
    
    <label for="contact" class="m-3">Contact</label>
    <input required type="text" class="form-control" name="fullname" id="fullname" placeholder="Fullname" value="<?php echo ucfirst($fullname)?>">
    <input required type="text" class="form-control" name="phoneNumber" id="phoneNumber" placeholder="Phone Number" value="<?php echo $db_acc_contact?>">
    <input required type="text" class="form-control" name="gmail" id="gmail" placeholder="Gmail" value="<?php echo $db_acc_email?>">
    <div id="errorDiv" style="color: red;"></div>
    </div> 

    </div> 
            <div style="display:block;" id="selectAddressBody" >
            
    <input type="hidden" id="user_acc_code" name="user_acc_code" >
    
   
    
    <!-- Region -->
  
    <label for="address" class="m-3">Address</label>
    <div class="form-group m-0">
    <div class="bg-light rounded">
    
         <select class="form-control" name="region" id="region">
            <!-- insert API response here -->
            <option value="">Select Region</option>
        </select>
    
        <select class="form-control" name="province" id="province">
            <!-- insert API response here -->
            <option value="">Select Province</option>
        </select>
  

   
        <select class="form-control" name="city" id="city">
            <!-- insert API response here -->
            <option value="">Select City</option>
        </select>


   
        <select class="form-control" name="barangay" id="barangay">
            <!-- insert API response here -->
            <option value="">Select Barangay</option>
        </select>
   
    
        
    <input required type="text" class="form-control" name="streetDescription" id="streetDescript" placeholder="Subdivision-Street-Block-Lot" name="address">
    <br>
    </div>
    </div>
    
</div>

</div>
                <div  style="display:none;" id="pinAddressBody" class="modal-body"  >     
                  
                           
                                                        <input hidden  type="text"  id="user_address_id_add" value="<?php echo $user_address_id?>" name="user_address_id" required>
                                                        <input hidden type="text"   id="GenerateRegionCode_add" value="" name="regionCode" required>
                                                        <input hidden type="text"  id="GenerateRegionName_add" value="" name="regionName" required>
                                                        <input hidden type="text"  id="acc_code_add" value="<?php echo $user_acc_code?>" name="acc_code" required>
                                                        <br>
                                                       
                                                        <p class="mb-1">
                                                        <input type="hidden" class="form-control" name="customer_id" value="<?php echo $db_acc_id?>"  style="width:250;" required>
                                                  
                                                    <div class="mb-3">
                                                        <textarea readonly style='display:none;' name="deliveryaddress" id="address_add" class="form-control" rows="3" placeholder="Address" style="width: 100%;" required></textarea>
                                                        <div id="addresValidation" class="alert alert-danger" style='display:none;'></div>
                                                        <div id="showRate" class="alert alert-success" style='display:none;'></div>
                                                    </div>
                        <div class="text-center">
                                                    <h4> Click Here</h4>
                                                   
                                                    <button type="button" style="background-color:#600000; border-radius:25px;" id="locateButton_add"></button>
                        </div>
                                    <p hidden id="locationInfo_add"></p>

                                    
                                 
                                    <form id="coordinatesForm_add">
                                        <p>
                                            <input hidden type="text" id="latitude_add" name="latitude_add"  value="">
                                        </p>
                                        <p>

                                            <input hidden type="text" id="longitude_add" name="longitude_add"  value="">
                                        </p>

                                       
                                    </form>
                            <iframe style="display:none;" width="100%" height="500" id="mapFrame_add"></iframe>
                </div>

     <label for="Settings" class="m-3">Settings</label>
        <div class="form-group">
            <div class="bg-light rounded p-3">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="toggleSwitch2">
                        <label class="custom-control-label" for="toggleSwitch2">Set Default</label>
                    </div>
            
            </div>
        </div>

                
 <div class="container text-center">
                    <div class="row justify-content-center">
                        <div id="divConfirmSelectAddress" class="modal-footer col-md-6">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" id="ConfirmSelectAddress" name="ConfirmSelectAddress" class="btn btn-danger">Submit</button><!---button select Address---->
                          
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div id="divConfirmPinAddress" style="display:none;" class="modal-footer col-md-6">
                           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" id="ConfirmPinAddress" name="ConfirmPinAddress" class="btn btn-danger">Submit</button><!---button pin Address---->
                          
                        </div>
                    </div>
                    <div class="alert alert-danger" id="formValidationError" style="display: none;"></div>

                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Kulay ng background ng modal */
.modal-content {
    background-color: #FFFFFF; /* Kulay ng background */
}

/* Kulay ng header ng modal */
.modal-header {
    background-color: #600000; /* Kulay ng header */
    color: #FFFFFF; /* Kulay ng text sa header */
}

/* Kulay ng mga button sa loob ng modal */


/* Kulay ng mga form fields */
.form-control {
    background-color: #F5F5F5; /* Kulay ng form field background */
   
}

/* Kulay ng mga labels */
label {
    color: #000000; /* Kulay ng text sa label */
}

/* Kulay ng mga alert messages */




      /* Style for flat buttons */
      .btn.btn-flat {
        background-color: transparent; /* Set the background color to transparent */
        border: none; /* Remove the border */
        padding: 0.5rem 1rem; /* Adjust padding as needed */
        font-size: 16px; /* Set the font size as needed */
        cursor: pointer; /* Change the cursor to a pointer on hover */
        transition: background-color 0.3s; /* Add a smooth transition effect for the background color */
    }
    
    /* Style for flat buttons on hover */
    .btn.btn-flat:hover {
        background-color: #f0f0f0; /* Change the background color on hover */
    }
    
    /* Style for active flat buttons */
    .btn.btn-flat.active {
        background-color: #ccc; /* Change the background color for the active state */
    }
</style>



<script>
    // JavaScript to toggle the active class between buttons  
    document.addEventListener("DOMContentLoaded", function () {

        var divselectAddressBody= document.getElementById("selectAddressBody");
        var divpinContainer= document.getElementById("pinAddressBody");

        var divConfirmSelectAddress= document.getElementById("divConfirmSelectAddress");
        var divConfirmPinAddress= document.getElementById("divConfirmPinAddress");
       
        

   
        const selectAddressBtn = document.getElementById("selectAddressBtn");
        const pinLocationBtn = document.getElementById("pinLocationBtn");

        selectAddressBtn.addEventListener("click", function () {
            selectAddressBtn.classList.add("active");
            pinLocationBtn.classList.remove("active");

            divselectAddressBody.style.display = "block";
            divpinContainer.style.display = "none";

            divConfirmSelectAddress.style.display = "block";
            divConfirmPinAddress.style.display = "none";
        });

        pinLocationBtn.addEventListener("click", function () {
            pinLocationBtn.classList.add("active");
            selectAddressBtn.classList.remove("active");
            
            divselectAddressBody.style.display = "none";
            divpinContainer.style.display = "block";

            divConfirmSelectAddress.style.display = "none";
            divConfirmPinAddress.style.display = "block";
        });
    });
</script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.js"></script>
<!--<script type="text/javascript" src="https://f001.backblazeb2.com/file/buonzz-assets/jquery.ph-locations.js"></script>--->
<script src="../Main/controller/register/js/address_api.js"></script>
<script src="view/checkout/js/geoAPI_add.js">
