function nextSection(nextSectionId) {
    document.getElementById(nextSectionId).style.display = "block";
    document.getElementById(nextSectionId).scrollIntoView({ behavior: "smooth" });

    if (nextSectionId === "addressSection") {
        document.getElementById("personalInfoSection").style.display = "none";
    } else if (nextSectionId === "credentialsSection") {
        document.getElementById("addressSection").style.display = "none";
    }
}

function backSection(prevSectionId) {
    document.getElementById(prevSectionId).style.display = "block";
    document.getElementById(prevSectionId).scrollIntoView({ behavior: "smooth" });

    if (prevSectionId === "personalInfoSection") {
        document.getElementById("addressSection").style.display = "none";
    } else if (prevSectionId === "addressSection") {
        document.getElementById("credentialsSection").style.display = "none";
    }
}
$(document).ready(function() {

    const getAddressId = (id, addressType, callback) => {
    $.ajax({
        url: "controller/register/get_address_id.php",
        type: "GET",
        data: {
            addressType: addressType,
            id: id,
        },
        success: function(response) {
            // Call the callback function with the response
            console.log("start-" + response + "-end");
            callback(response);
        },
        error: function(xhr, status, error) {
            console.error("Error:", status, error);
            // Call the callback function with an error value (if needed)
            callback(null);
        }
    });
}

    $.getJSON('../ph-json/region.json', function(data) {
        var regionDropdown = $('#region');
        
        regionDropdown.empty(); // Clear existing options
        
        // Loop through the data from JSON and add them as options to the dropdown
        regionDropdown.append('<option value="">Select Region</option>');
        $.each(data.data, function(key, value) {
            var checkResponse;
            getAddressId(value.region_code, 'reg_code', function(response) {
                checkResponse = response;
                if(checkResponse == 1){
                    regionDropdown.append('<option value="' + value.region_code + '">' + value.region_name + '</option>')
                }
            });
        });
    });

    $('#region').on('change', function() {
        var selectedRegionCode = $(this).val();
        var provinceDropdown = $('#province');

        provinceDropdown.empty(); // Clear existing options

        $.getJSON('../ph-json/province.json', function(data) {
            var provincesInRegion = data.data.filter(function(province) {
                return province.region_code === selectedRegionCode;
            });

            provinceDropdown.append('<option value="">Select Province</option>');
            $.each(provincesInRegion, function(key, value) {
                var checkResponse;
                getAddressId(value.province_code, 'prov_code', function(response) {
                checkResponse = response;
                    if(checkResponse == 1){
                        provinceDropdown.append('<option value="' + value.province_code + '">' + value.province_name + '</option>');
                    }
                });
            });
        });
    });

    $('#province').on('change', function() {
        var selectedProvinceCode = $(this).val();
        var cityDropdown = $('#city');

        cityDropdown.empty(); // Clear existing options

        $.getJSON('../ph-json/city.json', function(data) {
            var citiesInProvince = data.data.filter(function(city) {
                return city.province_code === selectedProvinceCode;
            });

            cityDropdown.append('<option value="">Select City</option>');
            $.each(citiesInProvince, function(key, value) {
                var checkResponse;
                getAddressId(value.city_code, 'muni_code', function(response) {
                checkResponse = response;
                    if(checkResponse == 1){
                        cityDropdown.append('<option value="' + value.city_code + '">' + value.city_name + '</option>');
                    }
                });
            });
        });
    });

    $('#city').on('change', function() {
        var selectedCityCode = $(this).val();
        var barangayDropdown = $('#barangay');

        barangayDropdown.empty(); // Clear existing options

        $.getJSON('../ph-json/barangay.json', function(data) {
            var barangaysInCity = data.data.filter(function(barangay) {
                return barangay.city_code === selectedCityCode;
            });

            barangayDropdown.append('<option value="">Select Barangay</option>');
            $.each(barangaysInCity, function(key, value) {
                var checkResponse;
                getAddressId(value.brgy_code, 'address_code', function(response) {
                checkResponse = response;
                    if(checkResponse == 1){
                        barangayDropdown.append('<option value="' + value.brgy_code + '">' + value.brgy_name + '</option>');
                    }
                });
            });
        });
    });

});
