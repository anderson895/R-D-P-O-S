$(document).ready(function () {
  var allFieldsValid = true;
  var $productName = $("input[name='pname']");
  var $unit = $("select[name='unit']");
  var $category = $("select[name='pcat']");
  var $criticalLevel = $("input[name='pcritical']");
  var $voucherType = $("select[name='pVouch']");
  var $currentPrice = $("input[name='pCprice']");
  var $productImage = $("input[name='pImg']");
  var $description = $("textarea[name='pDescript']");

  var $btnSubmit = $("#btnSubmit");

  var $unitType = $("select[name='unitType']");

  // Create error message elements for each field
  var $errorPname = $("#errorPname");
  var $errorUnit = $("#unitError");
  var $errorCategory = $("#categoryError");
  var $errorCriticalLevel = $("#criticalError");
  var $errorVoucherType = $("#vouchError");

  var $errorCurrentPrice = $("#CpriceError");
  var $errorProductImage = $("#pImgError");
  var $errorDescription = $("#descriptionError");

  // Function to hide error messages
  function hideErrorMessages() {
    $errorPname.hide();
    $errorUnit.hide();
    $errorCategory.hide();
    $errorCriticalLevel.hide();
    $errorVoucherType.hide();

    $errorCurrentPrice.hide();
    $errorProductImage.hide();
    $errorDescription.hide();

    $("#unitTypeError").hide();
  }

  // Function to validate the form
  // Function to validate the form
  function validateForm() {
    hideErrorMessages();
    allFieldsValid = true; // Reset the flag to true initially

    const productNameValue = $productName.val().trim(); // Remove leading and trailing spaces

    if (productNameValue.length <= 3) {
      allFieldsValid = false;
      $errorPname.text("Product Name must be more than 3 characters.");
      $errorPname.show();
    } else if (productNameValue.length > 25) {
      allFieldsValid = false;
      $errorPname.text("Product Name must not exceed 25 characters.");
      $errorPname.show();
    } else if (/^\s+$/.test(productNameValue)) {
      allFieldsValid = false;
      $errorPname.text("Product Name must not consist of spaces only.");
      $errorPname.show();
    }

    if ($unit.val() === "Choose Unit") {
      allFieldsValid = false;
      $errorUnit.text("Please select a unit.");
      $errorUnit.show();
    }

    if ($category.val() === "Choose Category") {
      allFieldsValid = false;
      $errorCategory.text("Please select a category.");
      $errorCategory.show();
    }

    if ($unitType.val() === "Choose Unit type") {
      allFieldsValid = false;
      $("#unitTypeError").text("Please select a unit type.");
      $("#unitTypeError").show();
    }

    if ($criticalLevel.val() === "") {
      allFieldsValid = false;
      $errorCriticalLevel.text("Critical Level is required.");
      $errorCriticalLevel.show();
    } else if (!/^[0-9]+$/.test($criticalLevel.val())) {
      allFieldsValid = false;
      $errorCriticalLevel.text(
        "Critical Level must be a positive integer with no special characters or decimals."
      );
      $errorCriticalLevel.show();
    } else {
      // Parse the critical level value as an integer
      const criticalLevelValue = parseInt($criticalLevel.val(), 10);

      // Check if the critical level is within the desired range (1 to 100)
      if (criticalLevelValue < 1 || criticalLevelValue > 10000) {
        allFieldsValid = false;
        $errorCriticalLevel.text(
          "Critical Level must be between 1 and 10,000."
        );
        $errorCriticalLevel.show();
      }
    }

    // Validate the "Description" field
    const descriptionValue = $description.val().trim(); // Remove leading and trailing spaces

    if (descriptionValue === "") {
      allFieldsValid = false;
      $errorDescription.text("Description is required.");
      $errorDescription.show();
    } else if (descriptionValue.length < 10) {
      allFieldsValid = false;
      $errorDescription.text("Description must be at least 10 characters.");
      $errorDescription.show();
    } else if (descriptionValue.length > 10000) {
      allFieldsValid = false;
      $errorDescription.text("Description must not exceed 10000 characters.");
      $errorDescription.show();
    }

    if ($currentPrice.val() === "") {
      allFieldsValid = false;
      $errorCurrentPrice.text("Current price is required.");
      $errorCurrentPrice.show();
    } else if (
      isNaN($currentPrice.val()) ||
      parseFloat($currentPrice.val()) <= 0
    ) {
      allFieldsValid = false;
      $errorCurrentPrice.text(
        "Current price must be a valid number greater than 0."
      );
      $errorCurrentPrice.show();
    } else if (!/^\d{1,6}(\.\d{1,2})?$/.test($currentPrice.val())) {
      allFieldsValid = false;
      $errorCurrentPrice.text(
        "Current price must have up to 6 digits before the decimal point and up to 2 digits after the decimal point."
      );
      $errorCurrentPrice.show();
      //console.log("Validation failed:", $currentPrice.val());
    } else {
      // console.log("Validation passed:", $currentPrice.val());
    }

    // Validate the product image
    var imageFileName = $productImage.val();
    if (imageFileName === "") {
    } else {
      // Check the file extension to ensure it's an image
      var validExtensions = ["jpg", "jpeg", "png", "gif"];
      var fileExtension = imageFileName.split(".").pop().toLowerCase();
      if (validExtensions.indexOf(fileExtension) === -1) {
        allFieldsValid = false;
        $errorProductImage.text(
          "Invalid file format. Only JPG, JPEG, PNG, or GIF files are allowed."
        );
        $errorProductImage.show();
      } else {
        // Display the uploaded image
        var productImagePreview = document.getElementById(
          "productImagePreview"
        );
        productImagePreview.style.display = "block";
        productImagePreview.src = URL.createObjectURL(
          $productImage[0].files[0]
        );
      }
    }

    if (allFieldsValid) {
      $btnSubmit.prop("disabled", false);
    } else {
      $btnSubmit.prop("disabled", true);
    }
  }

  // Attach input and change event listeners to form fields
  $productName
    .add($unit)
    .add($category)
    .add($criticalLevel)
    .add($voucherType)
    .add($currentPrice)
    .add($productImage)
    .on("input", validateForm);

  // Add change event listeners to the select elements
  $unit.add($category).add($voucherType).on("change", validateForm);

  $("#unitType").change(function (e) {
    e.preventDefault();
    validateForm();
  });

  $description.on("input", validateForm);
  // Initially, validate the form
  validateForm();
});
