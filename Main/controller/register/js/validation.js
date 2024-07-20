function validateForm() {
    var firstName = document.getElementById("firstName").value;
    var lastName = document.getElementById("lastName").value;
    var email = document.getElementById("email").value;
    var contactNo = document.getElementById("contactNo").value;
    var region = document.getElementById("region").value;
    var province = document.getElementById("province").value;
    var city = document.getElementById("city").value;
    var barangay = document.getElementById("barangay").value;
    var streetDescription = document.getElementById("streetDescription").value;
    var uname = document.getElementById("uname").value;
    var password = document.getElementById("password").value;
    var confirmPass = document.getElementById("confirmPass").value;

    // Validate first name
    if (firstName === "") {
        alert("Please enter your first name.");
        return false;
    }

    // Validate first name format (no numbers or special characters)
    var namePattern = /^[a-zA-Z\s]*$/;
    if (!namePattern.test(firstName)) {
        alert("First name should only contain letters and spaces.");
        return false;
    }

    // Validate last name
    if (lastName === "") {
        alert("Please enter your last name.");
        return false;
    }

    // Validate last name format (no numbers or special characters)
    if (!namePattern.test(lastName)) {
        alert("Last name should only contain letters and spaces.");
        return false;
    }

    // Validate email
    if (email === "") {
        alert("Please enter your email.");
        return false;
    }

    // Validate email format (Gmail)
    var emailPattern = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;
    if (!emailPattern.test(email)) {
        alert("Please enter a valid Gmail address.");
        return false;
    }

    // Validate contact number format
    var contactNoPattern = /^0\d{10}$/;
    if (contactNo === "" || !contactNoPattern.test(contactNo)) {
        alert("Please enter a valid contact number starting with 0 and having 11 digits.");
        return false;
    }

    // Validate region
    if (region === "") {
        alert("Please select a region.");
        return false;
    }

    // Validate province
    if (province === "") {
        alert("Please select a province.");
        return false;
    }

    // Validate city
    if (city === "") {
        alert("Please select a city.");
        return false;
    }

    // Validate barangay
    if (barangay === "") {
        alert("Please select a barangay.");
        return false;
    }

    // Validate street description
    if (streetDescription === "") {
        alert("Please enter the street description.");
        return false;
    }

    // Validate username
    if (uname === "") {
        alert("Please enter a username.");
        return false;
    }

    // Validate password
    if (password === "") {
        alert("Please enter a password.");
        return false;
    }

    // Validate confirm password
    if (confirmPass === "") {
        alert("Please confirm your password.");
        return false;
    }

    // Validate password match
    if (password !== confirmPass) {
        alert("Passwords do not match.");
        return false;
    }

    // If all validations pass, the form is valid
    return true;
}




//password validation


var myInput = document.getElementById("password");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}



