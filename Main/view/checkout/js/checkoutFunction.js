function getRegionCode(placeName) {
    // Convert placeName to lowercase for case-insensitive matching
    const lowerPlaceName = placeName.toLowerCase();

    // Define a mapping of place names to region codes (all keys converted to lowercase)
    const regionMapping = {
        "ilocos region": "01",
        "cagayan valley": "02",
        "central luzon": "03",
        "calabarzon": "04",
        "mimaropa": "17",
        "bicol region": "05",
        "western visayas": "06",
        "central visayas": "07",
        "eastern visayas": "08",
        "zamboanga peninsula": "09",
        "northern mindanao": "10",
        "davao region": "11",
        "soccsksargen": "12",
        "ncr": "13",
        "car": "14",
        "armm": "15",
        "caraga": "16"
    };

    // Check if the lowercase placeName exists in the regionMapping
    for (const [name, code] of Object.entries(regionMapping)) {
        if (lowerPlaceName.includes(name)) {
            return code;
        }
    }

    // If no region code is found, return null
    return null;
}


$(document).ready(function() {

   


    var divAddressValidation= document.getElementById("addresValidation");
    var divShowRate= document.getElementById("showRate");

    $('#address').on('input', function() {
        var addressValue = $(this).val();

var addressInput = document.getElementById("address");
var addressValue = addressInput.value;

if (addressValue) {
    // Convert the input to lowercase for case-insensitive comparison
    addressValue = addressValue.toLowerCase();

    // Extract region code
    const regionCode = getRegionCode(addressValue);
    if (regionCode) {
        console.log("Region Code:", regionCode);

        $('#GenerateRegionCode').val(regionCode);

    } else {
        console.log("Region Code not found");
    }
    divAddressValidation.style.display = "none";
    divShowRate.style.display = "none";


    //start detect shipping fee rate
   // var regionCodeToFind = 'Region 1';
    var foundAddressRate = null;

for (var i = 0; i < addressArray.length; i++) {
    if (addressArray[i].address_region_code === regionCode) {
        foundAddressRate = addressArray[i].address_rate;
        foundRegionName = addressArray[i].address_region_name;
        break; // Mai-stop ang loop kapag natagpuan na ang hinahanap
    }
}

// I-display ang resulta
if (foundAddressRate !== null) {
  //  console.log('Address Rate for Region ' + regionCode + ': ' + foundAddressRate);
         divShowRate.style.display = "block";
        $('#showRate').text("Our shipping fee in "+foundRegionName+" is ₱"+foundAddressRate)
} else {
  //  console.log('Region ' + regionCode + ' not found in the addressArray.');
}

    //end detect shipping fee rate

    // Perform case-insensitive checks for region names
    if (addressValue.includes("ilocos region")) {
        $('#saveButton').prop('disabled', false);
        $('#GenerateRegionName').val("Ilocos Region");
        //showRate
       
        console.log(true);
    } else if (addressValue.includes("cagayan valley")) {
        
        $('#saveButton').prop('disabled', false);
        $('#GenerateRegionName').val("Cagayan Valley");
        console.log("Cagayan Valley");
    } else if (addressValue.includes("central luzon")) {
    
        $('#saveButton').prop('disabled', false);
        $('#GenerateRegionName').val("Central Luzon");
        console.log("Central Luzon");
    } else if (addressValue.includes("calabarzon")) {
        $('#saveButton').prop('disabled', false);
        $('#GenerateRegionName').val("CALABARZON");
        console.log("CALABARZON");
    } else if (addressValue.includes("mimaropa")) {
        $('#saveButton').prop('disabled', false);
        $('#GenerateRegionName').val("MIMAROPA");
        console.log("MIMAROPA");
    } else if (addressValue.includes("bicol region")) {
        $('#saveButton').prop('disabled', false);
        $('#GenerateRegionName').val("Bicol Region");
        console.log("Bicol Region");
    } else if (addressValue.includes("western visayas")) {
        $('#saveButton').prop('disabled', false);
        $('#GenerateRegionName').val("Western Visayas");
        console.log("Western Visayas");
    } else if (addressValue.includes("central visayas")) {
        $('#saveButton').prop('disabled', false);
        $('#GenerateRegionName').val("Central Visayas");
        console.log("Central Visayas");
    } else if (addressValue.includes("eastern visayas")) {
        $('#saveButton').prop('disabled', false);
        $('#GenerateRegionName').val("Eastern Visayas");
        console.log("Eastern Visayas");
    } else if (addressValue.includes("zamboanga peninsula")) {
        $('#saveButton').prop('disabled', false);
        console.log("Zamboanga Peninsula");
    } else if (addressValue.includes("northern mindanao")) {
        $('#saveButton').prop('disabled', false);
        $('#GenerateRegionName').val("Northern Mindanao");
        console.log("Northern Mindanao");

    } else if (addressValue.includes("davao region")) {
        $('#saveButton').prop('disabled', false);
        $('#GenerateRegionName').val("Davao Region");
        console.log("Davao Region");
    } else if (addressValue.includes("soccsksargen")) {
        $('#saveButton').prop('disabled', false);
        $('#GenerateRegionName').val("SOCCSKSARGEN");
        console.log("SOCCSKSARGEN");
    } else if (addressValue.includes("ncr")) {
        $('#saveButton').prop('disabled', false);
        $('#GenerateRegionName').val("NCR");
        console.log("NCR");
    } else if (addressValue.includes("car")) {
        $('#saveButton').prop('disabled', false);
        $('#GenerateRegionName').val("CAR");
        console.log("CAR");
    } else if (addressValue.includes("armm")) {
        $('#saveButton').prop('disabled', false);
        $('#GenerateRegionName').val("ARMM");
        console.log("ARMM");
    } else if (addressValue.includes("caraga")) {
        $('#saveButton').prop('disabled', false);
        $('#GenerateRegionName').val("Caraga");
        console.log("Caraga");

    } else {
        $('#saveButton').prop('disabled', true);
        divAddressValidation.style.display = "block";
        $('#addresValidation').text("Region not found We do not deliver to this place , Please Enter complete Address or Pin your location")
       // console.log("We do not deliver to this place");
    }

   
   
} else {
    $('#saveButton').prop('disabled', true);
    addressInput.placeholder = "Enter Your Region and complete address.";
    
   

    


    
}
});


       

//pinContainer
    // Initially hide the inputForm
    $("#summaryForm").show();
    // Initially hide the inputForm
    $("#inputForm").hide();
    $("#inputMap").hide();
    $("#btnPlaceOrder").show();
    $("#saveCancelContainer").hide();
    $("#pinContainer").hide();

// Add a click event handler to the "Pencil" button
$(".fa-pencil").parent().click(function() {

   var ready_Default_status = $("#user_add_Default_status").val();

    var ifDefault = document.getElementById("ifDefault");
    var ifNotDefault = document.getElementById("ifNotDefault");

    const latitudeInput = document.getElementById('latitude');
    const longitudeInput = document.getElementById('longitude');


    latitudeValue = latitudeInput.value;
    longitudeValue = longitudeInput.value;
    
    if (latitudeValue.trim() !== '' && longitudeValue.trim() !== '') {

        console.log("not empty");
        $("#mapFrame").show();
    } else {
        console.log("empty");
        $("#mapFrame").hide();
    }
    

  
  if (ready_Default_status == "1") {
        ifDefault.style.display = "block";
        ifNotDefault.style.display = "none";
    console.log("Default");
    } else {
        ifDefault.style.display = "none";
        ifNotDefault.style.display = "block";
     console.log("Not Default");
    }
    console.log(ready_Default_status)
    // Show the inputForm
    $("#inputForm").show();
    $("#inputMap").show();
    // Hide the labelForm
    $("#labelForm").hide();
    $("#summaryForm").hide();
    $("#btnPlaceOrder").hide();
    $("#saveCancelContainer").show();
    $("#pinContainer").show();
});


// Add a click event handler to the "Cancel" button
$("#cancelButton").click(function() {
    // Show the labelForm
    $("#labelForm").show();
    $("#summaryForm").show();
    // Hide the inputForm
    $("#inputForm").hide();
    $("#inputMap").hide();
    $("#btnPlaceOrder").show();
    $("#saveCancelContainer").hide();
    $("#pinContainer").hide();
});


    
});




$('.togleraddAddress').click(function(){
    var new_acc_code = $(this).data("user_acc_code");
    $('#user_acc_code').val(new_acc_code);
  //  console.log(new_acc_code);
});

// Kapag pindutin ang "Confirm" button sa Select Address
$('#ConfirmSelectAddress').click(function(e) {
    e.preventDefault(); 

    const formValidationError = document.getElementById('formValidationError');
    formValidationError.style.display = "none";

    // Get the values from the input fields
   
    var user_acc_code = $('#user_acc_code').val();
    var regionId = $('#region').val();
    var provinceId = $('#province').val();
    var cityId = $('#city').val();
    var barangayId = $('#barangay').val();
    var streetDescription = $('#streetDescript').val();

    var gmail = $('#gmail').val();
    var fullname = $('#fullname').val();
    var phoneNumber = $('#phoneNumber').val();
    
    var toggleSwitch2 = $("#toggleSwitch2").prop("checked");
    
    console.log(toggleSwitch2)


    console.log(cityId)
    // Check if all required fields are filled
    if (user_acc_code && regionId && provinceId && cityId && barangayId) {
     
        var data = {
            gmail: gmail,
            fullname: fullname,
            phoneNumber: phoneNumber,
            ConfirmButtonClicked: "ConfirmSelectAddress",
            user_acc_code: user_acc_code,
            region: regionId,
            province: provinceId,
            city: cityId,
            barangay: barangayId,
            streetDescription: streetDescription,
            toggleSwitch2: toggleSwitch2

        };

        $.ajax({
            type: "POST",
            url: "insert_address.php", 
            data: data,
            success: function(response) {
                $('#ConfirmSelectAddress').prop('disabled', true);
                if (response === "success") {
                    // Update successful, you can display a success message or take further actions
                    //alert("User Remove successfully.");
                   
                    swal({
                    title: 'Success!',
                    text: 'Added new address successful',
                    icon: 'success',
                    html: true
                    }).then((value) => {
                    if (value) {
                        window.location.reload();
                    } else {
                        window.location.reload();
                    }
                    });
    
    
                } else {
                    // Update failed, you can display an error message or take further actions
                    alert("Failed to update user address.");
    
                    console.log(response);
                }
            },
            error: function(error) {
                console.log("Error: " + error);
            }
        });
    } else {
        // Display an error message in your formValidationError div
        formValidationError.style.display = "block";
        formValidationError.textContent = "Please fill in all required fields before Submit";
       
    }
});






// Kapag pindutin ang "Confirm" button sa Pin location
$('#ConfirmPinAddress').click(function(e) {
    e.preventDefault(); // Pigilin ang default form submission
    // Kuhain ang form data

    const formValidationError = document.getElementById('formValidationError');
    formValidationError.style.display = "none";
    var gmail = $('#gmail').val();
  
    var user_acc_code = $('#user_acc_code').val();//user acc code
    var regionId = $('#GenerateRegionCode_add').val();//region code
    var GenerateRegionName_add = $('#GenerateRegionName_add').val();//region name
    var address_add = $('#address_add').val();//complete address
    var latitude_add = $('#latitude_add').val();
    var longitude_add = $('#longitude_add').val();
    // Gumawa ng JSON object para sa data
    //fullname
    var fullname = $('#fullname').val();
    var phoneNumber = $('#phoneNumber').val();
    
    var toggleSwitch2 = $("#toggleSwitch2").prop("checked");
    
    console.log(toggleSwitch2)

  

    var data = {
        gmail: gmail,
        fullname: fullname,
        phoneNumber: phoneNumber,
        ConfirmButtonClicked: "ConfirmPinAddress",
        user_acc_code: user_acc_code,
        region: regionId,
        RegionName: GenerateRegionName_add,
        completeAddress: address_add,
        latitude_add: latitude_add,
        longitude_add: longitude_add,
        toggleSwitch2: toggleSwitch2
    };
 // Check if all required fields are filled
 if (user_acc_code && regionId && GenerateRegionName_add && address_add && latitude_add && longitude_add) {
   $.ajax({
        type: "POST",
        url: "insert_address.php", // I-update ito ng tamang URL kung saan naka-host ang iyong PHP script
        data: data,
        success: function(response) {
            $('#ConfirmPinAddress').prop('disabled', true);
            if (response === "success") {
                // Update successful, you can display a success message or take further actions
                //alert("User Remove successfully.");
               
                swal({
                title: 'Success!',
                text: 'Added new address successful',
                icon: 'success',
                html: true
                }).then((value) => {
                if (value) {
                    window.location.reload();
                } else {
                    window.location.reload();
                }
                });


            } else {
                // Update failed, you can display an error message or take further actions
                alert("Failed to update user address.");

                console.log(response);
            }
        },
        error: function(error) {
            console.log("Error: " + error);
        }
    });

} else {
        // Display an error message in your formValidationError div
        formValidationError.style.display = "block";
        formValidationError.textContent = "Please PIN your location before Submit.";
        
    }
});



$(document).ready(function() {

    const locateButtonAdd = document.getElementById('locateButton');
const locationInfo = document.getElementById('locationInfo');
const coordinatesForm = document.getElementById('coordinatesForm');
const mapFrame = document.getElementById('mapFrame');
const addressInput = document.getElementById('address');
const latitudeInput = document.getElementById('latitude');
const longitudeInput = document.getElementById('longitude');






locateButtonAdd.addEventListener("click", getLocation);


$("#mapFrame").css("display", "block");


function getLocation() {
    if ("geolocation" in navigator) {

        
        $("#mapFrame").css("display", "block");

        

        navigator.geolocation.getCurrentPosition(showLocation, showError);
    } else {
        locationInfo.textContent = "Geolocation is not supported by your browser.";
    }
}

function showLocation(position) {
    const latitude = position.coords.latitude;
    const longitude = position.coords.longitude;

    // Set latitude and longitude in the form fields
    latitudeInput.value = latitude;
    longitudeInput.value = longitude;

    // Reverse geocode latitude and longitude to get the address
    reverseGeocode(latitude, longitude, function (placeName) {
        if (placeName) {
            addressInput.value = placeName;
                // Extract region code
            const regionCode = getRegionCode(placeName);
            if (regionCode) {
                console.log("Region Code:", regionCode);

                $('#GenerateRegionCode').val(regionCode);

                

                // You can display the region code wherever you want.
            } else {
                console.log("Region Code not found");
            }
          // I-check kung may "Bulacan" sa placeName
            if (placeName.includes("Ilocos Region")) {
            console.log(true);   
            }else if(placeName.includes("Cagayan Valley")){
                console.log("Cagayan Valley");
            }else if(placeName.includes("Central Luzon")){

               $('#GenerateRegionName').val("Central Luzon");
                console.log("Central Luzon");
            }else if(placeName.includes("CALABARZON")){
                console.log("CALABARZON");
            }else if(placeName.includes("MIMAROPA")){
                console.log("MIMAROPA");
            }else if(placeName.includes("Bicol Region")){
                console.log("Bicol Region");
            }else if(placeName.includes("Western Visayas")){
                console.log("Western Visayas");
            }else if(placeName.includes("Central Visayas")){
                console.log("Central Visayas");
            }else if(placeName.includes("Eastern Visayas")){
                console.log("Eastern Visayas");
            }else if(placeName.includes("Zamboanga Peninzula")){
                console.log("Zamboanga Peninzula");
            }else if(placeName.includes("Northern Mindanao")){ 
            console.log("Northern Mindanao");
            }else if(placeName.includes("Davao Region")){ 
                console.log("Davao Region");
            }else if(placeName.includes("SOCCSKSARGEN")){ 
                console.log("SOCCSKSARGEN");
            }else if(placeName.includes("NCR")){ 
                console.log("NCR");
            }else if(placeName.includes("CAR")){ 
                console.log("CAR");
            }else if(placeName.includes("ARMM")){ 
                console.log("ARMM");
            }else if(placeName.includes("Caraga")){ 
            console.log("Caraga");
            } else {
            console.log("We do not deliver to this place");
            }

             
        } else {
            addressInput.value = "Location name not found.";
        }
    });

    locationInfo.textContent = `Latitude: ${latitude}, Longitude: ${longitude}`;

    // Update the map iframe source
    mapFrame.src = `https://maps.google.com/maps?q=${latitude},${longitude}&output=embed`;

}

function reverseGeocode(latitude, longitude, callback) {
    const apiUrl = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}&zoom=18&addressdetails=1`;

    fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
            if (data.display_name) {
                callback(data.display_name);
            } else {
                callback(null);
            }
        })
        .catch(error => {
            callback("Error fetching location name.");
        });
}

function showError(error) {
    switch (error.code) {
        case error.PERMISSION_DENIED:
            locationInfo.textContent = "Permission to access location was denied.";
            break;
        case error.POSITION_UNAVAILABLE:
            locationInfo.textContent = "Location information is unavailable.";
            break;
        case error.TIMEOUT:
            locationInfo.textContent = "The request to get location timed out.";
            break;
        case error.UNKNOWN_ERROR:
            locationInfo.textContent = "An unknown error occurred.";
            break;
    }
}

    



//deleteModal

    $("#btnDelete").click(function() {
        
       var ready_Default_status = $("#user_add_Default_status").val();

        var userAccCode = $("#acc_code").val();
        var user_add_Default_status = $("#user_add_Default_status").val();
        var user_add_display_status = $("#user_add_display_status").val();
        

        var user_address_id = $("#user_address_id").val();
        

       console.log(user_address_id);
      

    
var DefaultAlert= document.getElementById("DefaultAlert");
DefaultAlert.style.display = "none";

console.log(ready_Default_status)

if (ready_Default_status === '1') {
    // Set the text for the element with ID 'DefaultAlert'
    $('#DefaultAlert').text('This is your default address. You need to set a new default address if you want to remove it');
    
    // Display the element with ID 'DefaultAlert'
    $('#DefaultAlert').css('display', 'block');

    // Dismiss the modal
    $('[data-bs-dismiss="modal"]').attr('aria-label', 'Close').click();
}
else{
    $.ajax({
            url: "remove_address.php", // Create a PHP file to handle the update
            type: "POST",
            data: {
                userAccCode: userAccCode,
                user_add_Default_status: user_add_Default_status,
                user_add_display_status: user_add_display_status,
                user_address_id: user_address_id
            },
            success: function(response) {
                if (response === "success") {
                    // Update successful, you can display a success message or take further actions
                    //alert("User Remove successfully.");
                   
                    swal({
                    title: 'Success!',
                    text: 'Remove Address Successful',
                    icon: 'success',
                    html: true
                    }).then((value) => {
                    if (value) {
                        window.location.reload();
                    } else {
                        window.location.reload();
                    }
                    });


                } else {
                    // Update failed, you can display an error message or take further actions
                    alert("Failed to update user address.");

                    console.log(response);
                }
            },
            error: function(xhr, status, error) {
                // Handle the error, you can display an error message or take further actions
                console.error("AJAX Error: " + status + "\n" + error);
            }
        });
    DefaultAlert.style.display = "none";
}
       
        
    });
    


    // Attach a click event handler to the Save button
    $("#saveButton").click(function() {
        // Get the values you want to   //toggleSwitch
        var toggleSwitch = $("#toggleSwitch").prop("checked");
    
    console.log(toggleSwitch)


        var edit_email = $("#edit_email").val();
        var edit_Fullname = $("#edit_Fullname").val();
        var edit_Contact = $("#edit_Contact").val();
        var user_address_id = $("#user_address_id").val();
        var userAccCode = $("#acc_code").val();
        var userRegionCode = $("#GenerateRegionCode").val();
        var userRegionName = $("#GenerateRegionName").val();
        var userCompleteAddress = $("#address").val();
        var longitude = $("#longitude").val();
        var latitude = $("#latitude").val();



console.log("longitude ",longitude)

console.log("latitude ",latitude)


     
        $.ajax({
            url: "update_user_address.php", // Create a PHP file to handle the update
            type: "POST",
            data: {
                toggleSwitch: toggleSwitch,
                edit_email: edit_email,
                edit_Fullname: edit_Fullname,
                edit_Contact: edit_Contact,
                user_address_id: user_address_id,
                acc_code: userAccCode,
                regionCode: userRegionCode,
                regionName: userRegionName,
                deliveryaddress: userCompleteAddress,
                longitude: longitude,
                latitude: latitude
            },
            success: function(response) {
                if (response === "success") {
                    // Update successful, you can display a success message or take further actions
                    swal({
                    title: 'Success!',
                    text: 'User Address Update Successful',
                    icon: 'success',
                    html: true
                    }).then((value) => {
                    if (value) {
                        window.location.reload();
                    } else {
                        window.location.reload();
                    }
                    });
                } else {

                    console.log(response)
                    // Update failed, you can display an error message or take further actions
                    alert("Failed to update user address.");

                    console.log(response);
                }
            },
            error: function(xhr, status, error) {
                // Handle the error, you can display an error message or take further actions
                console.error("AJAX Error: " + status + "\n" + error);
            }
        });
        
    });
});




