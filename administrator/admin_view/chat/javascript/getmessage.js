

$(document).ready(function() {

    
    var account_id = $("#account_id").val();
    var pollInterval = 1000; 

    if(account_id){
        var  viewChat =$("#viewChat").show();
    }

    //console.log(account_id);
    

    function retrieveViewMessages() {
        $.ajax({
            url: 'chat/controller/getMessages.php',
            type: 'GET',
            success: function(response) {
                try {
                    // Parse JSON response
                    var messages = JSON.parse(response);
    
                    // Log the received messages for debugging
                    console.log(messages);
    
                    // Initialize an empty HTML string to append message data
                    var messagesHTML = '';
    
                    // Iterate through each message and construct the HTML
                    messages.forEach(function(message) {
                        var imagePath = '../../upload_system/empty.png'; // Default image path
    
                        // If there's an employee image, use it
                        if (message.emp_image !== '') {
                            imagePath = '../../upload_img/' + message.emp_image;
                        }
    
                        // Parse the message date
                        var messageDate = new Date(message.mess_date);
    
                        // Determine if the message is sent by the current user
                        var isActive = (message.mess_sender == account_id) ? 'active' : '';

                        // console.log(isActive);
    
                        // Build the message HTML
                        messagesHTML += '<a href="javascript:void(0);" class="changeChatView media d-flex ' + isActive + '" data-account_id="' + message.mess_sender + '">';
                        messagesHTML += '<div class="media-img-wrap flex-shrink-0">';
                        messagesHTML += '<div class="avatar avatar-away">';
                        messagesHTML += '<img src="' + imagePath + '" alt="User Image" class="avatar-img rounded-circle">';
                        messagesHTML += '</div>';
                        messagesHTML += '</div>';
                        messagesHTML += '<div class="media-body flex-grow-1">';
                        messagesHTML += '<div>';
                        messagesHTML += '<div class="user-name">' + message.acc_fname + ' ' + message.acc_lname + '</div>';
                        
                        if (message.mess_content) {
                            messagesHTML += '<div class="user-last-chat" >' + message.mess_content + '</div>';
                        } else {
                            messagesHTML += `<div class="user-last-chat">Sent Attachment</div>`;
                        }
                        
                        messagesHTML += '</div>';
                        messagesHTML += '<div>';
                        messagesHTML += '<div class="last-chat-time">' + messageDate.toLocaleString() + '</div>'; // Date as string
                        messagesHTML += '<div class="badge badge-success badge-pill">' + message.seen_count + '</div>';
                        messagesHTML += '</div>';
                        messagesHTML += '</div>';
                        messagesHTML += '</a>';
                    });
    
                    // Update the chat messages in the DOM
                    $('#chatMessages .contacts_body').html(messagesHTML);
    
                    // Attach click event listener to dynamically created elements
                    $('#chatMessages .contacts_body').on('click', '.changeChatView', function() {
                        var clickedAccountID = $(this).data("account_id");
    
                        // Update URL without reloading the page
                        var currentURL = new URL(window.location.href);
                        currentURL.searchParams.set('account_id', clickedAccountID);
                        window.history.pushState({}, '', currentURL);
                    });
    
                } catch (e) {
                    console.error("Error parsing the response:", e);
                }
            },
            error: function() {
                alert('An error occurred while fetching messages.');
            },
            complete: function() {
                // Polling mechanism to retrieve messages at regular intervals
                setTimeout(function() {
                    retrieveViewMessages();
                }, pollInterval); // Ensure `pollInterval` is defined
            }
        });
    }
    
  
        retrieveViewMessages();
});
    