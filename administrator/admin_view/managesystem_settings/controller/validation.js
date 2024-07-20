// I-drag-and-drop ang imahe sa logo field
document.getElementById("img_log").addEventListener("change", function () {
    var input = this;
    var file = input.files[0];
    
    if (file) {
        if (file.type.indexOf("image/") === 0) {
            // Ito ay isang imahe, pwede ituloy ang pag-upload
            var reader = new FileReader();

            reader.onload = function (e) {
                document.getElementById("systemImagePreview_logo").src = e.target.result;
            };

            reader.readAsDataURL(file);
        } else {
            // Ito ay hindi imahe, itigil ang pag-upload at magbigay ng paliwanag
            input.value = ""; // Clear the input
            alert("Hindi pwedeng i-upload ang file na ito. Pumili ng imahe file.");
        }
    }
});

// I-drag-and-drop ang imahe sa banner field
document.getElementById("sImg_banner").addEventListener("change", function () {
    var input = this;
    var file = input.files[0];
    
    if (file) {
        if (file.type.indexOf("image/") === 0) {
            // Ito ay isang imahe, pwede ituloy ang pag-upload
            var reader = new FileReader();

            reader.onload = function (e) {
                document.getElementById("systemImagePreview_banner").src = e.target.result;
            };

            reader.readAsDataURL(file);
        } else {
            // Ito ay hindi imahe, itigil ang pag-upload at magbigay ng paliwanag
            input.value = ""; // Clear the input
            alert("Hindi pwedeng i-upload ang file na ito. Pumili ng imahe file.");
        }
    }
});


document.addEventListener("DOMContentLoaded", function () {
    var form = document.getElementById("updateForm");
    var sname = document.getElementById("sname");
    var contact = document.getElementById("contact");
    var saddress = document.getElementById("saddress");
    var scontent = document.getElementById("scontent");
    var imgLog = document.getElementById("img_log");
    var sImgBanner = document.getElementById("sImg_banner");
    var btnSubmit = document.getElementById("btnSubmit");

   // Function to validate System Name
   sname.addEventListener("input", function () {
    var errorSname = document.getElementById("errorSname");
    if (sname.value.trim().length < 3 || sname.value.trim().length > 7) {
      errorSname.style.display = "block";
      errorSname.innerText = "System Name should be between 3 and 7 characters";
    } else {
      errorSname.style.display = "none";
    }
    checkFormValidity();
  });
  
  // Function to validate Contact
    contact.addEventListener("input", function () {
      var errorContact = document.getElementById("errorContact");
      if (contact.value.trim() === "") {
        errorContact.style.display = "block";
        errorContact.innerText = "Contact is required";
      } else {
        errorContact.style.display = "none";
      }
      checkFormValidity();
    });

   // Function to validate Store Address
saddress.addEventListener("input", function () {
    var StoreError = document.getElementById("StoreError");
    if (saddress.value.trim().length < 10) {
      StoreError.style.display = "block";
      StoreError.innerText = "Store Address should be at least 10 characters";
    } else {
      StoreError.style.display = "none";
    }
    checkFormValidity();
  });
  

   // Function to validate Content
scontent.addEventListener("input", function () {
    var contentError = document.getElementById("contentError");
    if (scontent.value.trim().length < 10) {
      contentError.style.display = "block";
      contentError.innerText = "Content should be at least 10 characters";
    } else {
      contentError.style.display = "none";
    }
    checkFormValidity();
  });
  
   // Function to check form validity and enable/disable submit button
function checkFormValidity() {
//  console.log("System Name Length:", sname.value.trim().length);
//  console.log("Contact Length:", contact.value.trim().length);
//  console.log("Store Address Length:", saddress.value.trim().length);
//  console.log("Content Length:", scontent.value.trim().length);
//  console.log("imgLog Files Length:", imgLog.files.length);
 // console.log("sImgBanner Files Length:", sImgBanner.files.length);

 var isValid =
    sname.value.trim().length >= 3 && sname.value.trim().length <= 7 &&
    contact.value.trim().length > 0 &&
    saddress.value.trim().length >= 10 &&
    scontent.value.trim().length >= 10;


  console.log("Is Valid:", isValid);

  if (isValid) {
    btnSubmit.removeAttribute("disabled");
  } else {
    btnSubmit.setAttribute("disabled", "true");
  }
}

checkFormValidity();
  });