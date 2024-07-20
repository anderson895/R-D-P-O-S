$(document).ready(function () {
    var messageInput = $('#messageInput');
    var fileInput = $('#fileInput');
    var sendButton = $('#sendButton');
    var fileDisplay = $('#fileDisplay');
    var fileNameSpan = $('#fileName');
    var removeFileButton = $('#removeFile');

    function updateSendButton() {
        if (messageInput.val() || fileInput[0].files.length > 0) {
            sendButton.removeAttr('disabled');
        } else {
            sendButton.attr('disabled', 'disabled');
        }
    }

    messageInput.on('input', function() {
        updateSendButton();
    });

    fileInput.on('change', function() {
        updateSendButton();
        var selectedFile = fileInput[0].files[0];
        if (selectedFile) {
            fileNameSpan.text('Selected File: ' + selectedFile.name);
            fileDisplay.show();
        }
    });

    removeFileButton.on('click', function() {
        fileInput.val('');
        fileNameSpan.text('');
        fileDisplay.hide();
        updateSendButton();
    });




   $('#sendButton').on('click', function () {
    var message = messageInput.val();
    const urlParams = new URLSearchParams(window.location.search);
    var account_id = urlParams.get('account_id');
    var file = fileInput[0].files[0];

    var formData = new FormData();
    formData.append('account_id', account_id);

    if (message || file) { // Check if either message or file is present
        if (message) {
            formData.append('message', message);
        }
        if (file) {
            formData.append('file', file);
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
                fileInput.val('');
                fileNameSpan.text('');
                fileDisplay.hide();
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
        console.log('Neither message nor file to send.');
        // Handle case where both message and file are empty
    }
});


    updateSendButton();
});
