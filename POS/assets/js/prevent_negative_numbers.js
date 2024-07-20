function validateInput(inputElement) {
    // Remove non-digit characters (except decimal point)
    inputElement.value = inputElement.value.replace(/[^0-9.]/g, '');
  
    // Ensure that there is only one decimal point
    let value = inputElement.value;
    let decimalCount = (value.match(/\./g) || []).length;
  
    if (decimalCount > 1) {
      value = value.substring(0, value.lastIndexOf('.'));
    }
  
    // Remove leading zeros
    value = value.replace(/^0+/, '');
  
    // Set the cleaned value back into the input field
    inputElement.value = value;
  }
  