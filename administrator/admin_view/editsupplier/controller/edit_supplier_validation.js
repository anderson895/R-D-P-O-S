$(document).ready(function() {
    // Function to validate email format
    var acc_id =$("#acc_id").val()
    var spl_id =$("#spl_id").val()
    
  

    // Function to handle form submission
    function handleSubmit(event) {
        event.preventDefault(); // Prevent the default form submission

        // Validate Supplier Name
        const supplierName = $('#supplierName').val();
        if (supplierName.trim() === '') {
            //alert('Supplier Name is required.');
            alertify.error("Supplier Name is required")
            return;
        }else if (supplierName.trim() === '' || supplierName.length <= 3) {
            alertify.error('Supplier Name must contain more than 3 characters.');
            return;
        }

        const email = $('#email').val();
        const emailRegex = /^[^\s@]+@gmail\.com$/; // Regular expression to match "gmail.com" emails

        if (email.trim() === '' || !emailRegex.test(email) || email.length <= 4) {
            alertify.error('Enter a valid email address with at least 4 characters before "@gmail.com".');
            return;
        }


        // Validate Phone
        const phone = $('#phone').val();
        const phoneNumberRegex = /^09\d{9}$/; // Regular expression to match 11-digit phone numbers starting with "09"

        if (phone.trim() === '') {
            alertify.error('Phone number is required.');
            return;
        } else if (!phoneNumberRegex.test(phone)) {
            alertify.error('Enter a valid 11-digit phone number starting with "09".');
            return;
        }


        // Validate Address
        const address = $('#address').val();
        if (address.trim() === '') {
           // alert('Address is required.');
            alertify.error("Address is required")
            return;
        }else if (address.trim() === '' || address.length < 10) {
            alertify.error('Address must contain at least 10 characters.');
            return;
        }

        // If all validations pass, submit the form
        // Note: Since this is a simulated environment, we'll just log a message here
       // console.log('Form submitted successfully.');
        

        //insert 
        $.ajax({
            url: 'editsupplier/controller/edit_supplierProcess.php', // Palitan mo ito ng tamang URL
            type: 'POST',
            data: {
                acc_id:acc_id,
                supplierName:supplierName,
                email: email,
                phone: phone,
                spl_id:spl_id,
                address: address
            },
            success: function(response) {
                // Dito mo ilalagay ang mga actions na kailangan mong gawin kapag successful ang update

                Swal.fire({
                    type: "success",
                    title: "Success!",
                    text: "Your category has been restore.",
                    confirmButtonClass: "btn btn-success"
                }).then(function() {
                  // location.reload();
                  // Change the URL to "https://www.example.com"
                 
                 alertify.success("Form submitted successfully")

                 console.log(response)
                 // location.href = "supplierlist.php";
                
                });
            },
            error: function(xhr, status, error) {
                // Dito mo ilalagay ang mga actions para sa error handling
                Swal.fire({
                    type: "error",
                    title: "Error",
                    text: "An error occurred while deleting the product.",
                    confirmButtonClass: "btn btn-danger"
                });
            }
        });
    }

    // Attach form submission handler
    $('#btnAddSupplier').on('click', handleSubmit);
});
