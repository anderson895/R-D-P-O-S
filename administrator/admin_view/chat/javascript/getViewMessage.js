$(document).ready(function() {
    var account_id = $("#account_id").val(); 
    var session_id= $("#session_id").val();
  
    var pollInterval = 1000; 


    

    function retrieveViewMessages(accountId) {
        $.ajax({
            url: 'chat/controller/getViewMessage.php',
            type: 'GET',
            data: { account_id: accountId },
            dataType: 'json',
            success: function(data) {

                console.log(data);
                
                var chatBody = $('#messageList');
                chatBody.empty();
        
                if (data && data.length > 0) {
                    var firstMessage = data[0];
        
                    // Check if Reciever_fullname property exists before accessing it
                    if (firstMessage.hasOwnProperty('Reciever_fullname')) {
                        $("#receiver_name").text(firstMessage.Reciever_fullname);
        
                        var imagePathReciever = '../../upload_system/empty.png';
                        if (firstMessage.Reciever_image !== '') {
                            imagePathReciever = '../../upload_img/' + firstMessage.Reciever_image;
                        }
                       // Set the image source
                        $("#reciever_image").attr("src", imagePathReciever);

                        // // Check account type and add the correct onclick event
                        // if (acc_type === "customer") {
                        //     // Set the onclick attribute for customer
                        //     $("#reciever_image").on("click", function() {
                        //         window.location.href = 'profile_customer.php?target_id=' + account_id;
                        //     });
                        // } else {
                        //     // Set the onclick attribute for other account types
                        //     $("#reciever_image").on("click", function() {
                        //         window.location.href = 'profile.php?account_id=' + account_id;
                        //     });
                        // }

        
                        data.forEach(function(message) {
                            var formattedTime = formatTimeTo12HourFormat(message.mess_date);

                            if (message.Reciever_id === null) {
                                $('#chatbox').hide();
                            }else{
                                $('#chatbox').show();
                            }
                            
        
                            var imagePathReciever = '../../upload_system/empty.png';
                            if (message.Reciever_image !== '') {
                                imagePathReciever = '../upload_img/' + message.Reciever_image;
                            }
        
                            var imagePath = '../../upload_system/empty.png';
                            if (message.emp_image !== '') {
                                imagePath = '../../upload_img/' + message.emp_image;
                            }
        
                            var messageHtml = '<li class="media ';
                            messageHtml += (message.mess_sender == session_id) ? 'sent d-flex">' : 'received d-flex">';
                             
                    messageHtml += '<div class="avatar flex-shrink-0">';
                    messageHtml += '<img src="' + imagePath + '" alt="User Image" class="avatar-img rounded-circle">';
                    messageHtml += '</div>';
                    messageHtml += '<div class="media-body flex-grow-1">';
                    messageHtml += '<div class="msg-box"><div>';

                   

                       messageHtml += '<i><b>' + message.acc_fname + ' ' + message.acc_lname + '</b> (' + message.acc_type + ')</i>';


                        messageHtml += '<p >'+ message.mess_content + '</p>';
                    

                    messageHtml += '<ul class="chat-msg-info"><li>';
                    messageHtml += '<div class="chat-time"><span>' + formattedTime + '</span></div>';
                    messageHtml += '</li></ul></div></div></div></li>';

                    chatBody.append(messageHtml);
                });

            


            } else {
                console.error('Reciever_fullname property is missing in the data:', data);
            }
        } else {
            console.error('Empty or invalid data received:', data);
        }
    },
    error: function(xhr, status, error) {
        console.error("XHR Status: " + xhr.status);
        console.error("Status: " + status);
        console.error("Error: " + error);
    },
    complete: function() {
        // After each Ajax request is complete, set up the next polling request
        setTimeout(function() {
            retrieveViewMessages(account_id);
        }, pollInterval);
    }
});
    }

    retrieveViewMessages(account_id);

    $('#chatMessages .contacts_body').on('click', '.changeChatView', function() {
        var clickedAccountID = $(this).data("account_id"); // Get the clicked account_id
         account_id = clickedAccountID; // Update the account_id based on the clicked element

        retrieveViewMessages(account_id);

        
        //window.location.href = 'profile_customer.php?target_id=' + clickedAccountID;

    });
});
