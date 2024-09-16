$(document).ready(function () {
    var messageInput = $('#messageInput');

    var sendButton = $('#sendButton');
   

    function updateSendButton() {
        if (messageInput.val()) {
            sendButton.removeAttr('disabled');
        } else {
            sendButton.attr('disabled', 'disabled');
        }
    }

    messageInput.on('input', function() {
        updateSendButton();
    });

  



   $('#sendButton').on('click', function () {
    var message = messageInput.val();
    const urlParams = new URLSearchParams(window.location.search);
    var account_id = urlParams.get('account_id');
  

    var formData = new FormData();
    formData.append('account_id', account_id);

    if (message) {
        if (message) {
            formData.append('message', message);
        }
       

        $("#sendButton").css("display", "none");

        $.ajax({
            url: 'chat/controller/insertMessage.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log('Data sent successfully');
                console.log(account_id);
                console.log(response);
                // Handle success, if needed
                $('#messageInput').val("");
             
            },

            beforeSend: function() {
                $("#loadingSpinner").html('<div class="spinner-border text-warning" role="status"><span class="sr-only">Loading...</span></div>').show();
              }, 

              
            error: function (xhr, status, error) {
                console.error(error);
                // Handle errors, if any
            },
            complete: function() {
                $("#loadingSpinner").hide();
                $("#sendButton").css("display", "block");
              }
            
        });
    } else {
        console.log(' message not to send.');
    }
});


    updateSendButton();
});
