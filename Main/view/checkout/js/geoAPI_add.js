
    
const locateButtonAdd = document.getElementById('locateButton_add');


    

const locationInfo_add = document.getElementById('locationInfo_add');
const coordinatesForm_add = document.getElementById('coordinatesForm_add');
const mapFrame_add = document.getElementById('mapFrame_add');
const addressInput_add = document.getElementById('address_add');
const latitudeInput_add = document.getElementById('latitude_add');
const longitudeInput_add = document.getElementById('longitude_add');

locateButtonAdd.addEventListener("click", getLocation_add);


function getLocation_add() {

    if ("geolocation" in navigator) {

        $("#mapFrame_add").css("display", "block");
        
        $("#address_add").css("display", "block");

       

        navigator.geolocation.getCurrentPosition(showLocation_add, showError);
    } else {
        locationInfo_add.textContent = "Geolocation is not supported by your browser.";
    }
}

function showLocation_add(position) {
    const latitude_add = position.coords.latitude;
    const longitude_add = position.coords.longitude;

    // Set latitude and longitude in the form fields
    latitudeInput_add.value = latitude_add;
    longitudeInput_add.value = longitude_add;

    // Reverse geocode latitude and longitude to get the address_add
    reverseGeocode_add(latitude_add, longitude_add, function (placeName_add) {
        if (placeName_add) {
            addressInput_add.value = placeName_add;
                // Extract region code
            const regionCode_add = getRegionCode(placeName_add);
            if (regionCode_add) {
                console.log("Region Code:", regionCode_add);

                $('#GenerateRegionCode_add').val(regionCode_add);

                

                // You can display the region code wherever you want.
            } else {
                console.log("Region Code not found");
            }
          // I-check kung may "Bulacan" sa placeName_add
            if (placeName_add.includes("Ilocos Region")) {
            console.log(true);   
            }else if(placeName_add.includes("Cagayan Valley")){
                console.log("Cagayan Valley");
            }else if(placeName_add.includes("Central Luzon")){

               $('#GenerateRegionName_add').val("Central Luzon");
                console.log("Central Luzon");
            }else if(placeName_add.includes("CALABARZON")){
                console.log("CALABARZON");
            }else if(placeName_add.includes("MIMAROPA")){
                console.log("MIMAROPA");
            }else if(placeName_add.includes("Bicol Region")){
                console.log("Bicol Region");
            }else if(placeName_add.includes("Western Visayas")){
                console.log("Western Visayas");
            }else if(placeName_add.includes("Central Visayas")){
                console.log("Central Visayas");
            }else if(placeName_add.includes("Eastern Visayas")){
                console.log("Eastern Visayas");
            }else if(placeName_add.includes("Zamboanga Peninzula")){
                console.log("Zamboanga Peninzula");
            }else if(placeName_add.includes("Northern Mindanao")){ 
            console.log("Northern Mindanao");
            }else if(placeName_add.includes("Davao Region")){ 
                console.log("Davao Region");
            }else if(placeName_add.includes("SOCCSKSARGEN")){ 
                console.log("SOCCSKSARGEN");
            }else if(placeName_add.includes("NCR")){ 
                console.log("NCR");
            }else if(placeName_add.includes("CAR")){ 
                console.log("CAR");
            }else if(placeName_add.includes("ARMM")){ 
                console.log("ARMM");
            }else if(placeName_add.includes("Caraga")){ 
            console.log("Caraga");
            } else {
            console.log("We do not deliver to this place");
            }

             
        } else {
            addressInput_add.value = "Location name not found.";
        }
    });

    locationInfo_add.textContent = `Latitude: ${latitude_add}, Longitude: ${longitude_add}`;

    // Update the map iframe source
    mapFrame_add.src = `https://maps.google.com/maps?q=${latitude_add},${longitude_add}&output=embed`;

}

function reverseGeocode_add(latitude_add, longitude_add, callback) {
    const apiUrl = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude_add}&lon=${longitude_add}&zoom=18&addressdetails=1`;

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
            locationInfo_add.textContent = "Permission to access location was denied.";
            break;
        case error.POSITION_UNAVAILABLE:
            locationInfo_add.textContent = "Location information is unavailable.";
            break;
        case error.TIMEOUT:
            locationInfo_add.textContent = "The request to get location timed out.";
            break;
        case error.UNKNOWN_ERROR:
            locationInfo_add.textContent = "An unknown error occurred.";
            break;
    }
}
