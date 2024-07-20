$(function() {
    // Variables
    var $catName = $("input[name='catname']");
    var $catDescription = $("#catdescript");
    var $btnSubmit = $('#btnSubmit');
    var $errorCatName = $("#errorcatname");
    var $errorCatDescription = $("#errorCatDescription");
    var allFieldsValid = true;


    //console.log($catDescription.val())
    // Function to hide error messages
    function hideErrorMessages() {
        $errorCatName.hide();
        $errorCatDescription.hide();
    }

    // Function to validate the form
    function validateForm() {
       // console.log("loob ng validateForm")
        hideErrorMessages();
        allFieldsValid = true; // Reset the flag to true initially
        if($catName.val() ===""){
            allFieldsValid = false;
            $errorCatName.text("Category Name is required.");
            $errorCatName.show();

         }else if ($catName.val().length <= 3) {
            allFieldsValid = false;
            $errorCatName.text("Category Name must be more than 3 characters.");
            $errorCatName.show();
        }

        if ($catDescription.val() === "") {
            allFieldsValid = false;
            $errorCatDescription.text("Description is required.");
            $errorCatDescription.show();
        } else if ($catDescription.val() && $catDescription.val().length < 10) {
            allFieldsValid = false;
            $errorCatDescription.text("Description must be at least 10 characters.");
            $errorCatDescription.show();
            console.log("loob ng if")
        }
        

        if (allFieldsValid) {
            $btnSubmit.prop('disabled', false);
        } else {
            $btnSubmit.prop('disabled', true);
        }
    }

    $catName.add($catDescription).on('input', validateForm);
    
  validateForm();
});
