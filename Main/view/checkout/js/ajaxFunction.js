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
        $('#showRate').text("Our shipping fee in "+foundRegionName+" is "+foundAddressRate)
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

// Add a click event handler to the "Save" button
$("#saveButton").click(function() {
    // Perform any save logic here

    // Show the labelForm
    $("#labelForm").show();
    // Hide the inputForm
    $("#inputForm").hide();
    $("#btnPlaceOrder").show();
    $("#saveCancelContainer").hide();
    $("#pinContainer").hide();
    
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


    $('#select-address').change(function() {
        var selectedAddressId = $(this).val();
        
        // Gumawa ng Ajax request para i-update ang user_address_status
        $.ajax({
            url: 'view/checkout/update_user_address_status.php', // Tukuyin ang tamang URL ng PHP endpoint
            method: 'POST',
            data: { address_id: selectedAddressId, user_acc_code: '<?php echo $user_acc_code; ?>' }, // Ipadala ang selectedAddressId
            success: function(response) {
                // Mag-update ng anumang UI kung kinakailangan
              //  alert('User address status updated successfully.');

              //  console.log(response)

                window.location.reload();
            },
            error: function() {
                alert('May naganap na error sa pag-update ng user address status.');
            }
        });
    });
});