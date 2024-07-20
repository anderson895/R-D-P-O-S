

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
            var messages = JSON.parse(response);
            var messagesHTML = '';

           // console.log(messages)

            messages.forEach(function(message) {
                var imagePath = '../../upload_system/empty.png'; // Set default image path

                if (message.emp_image !== '') {
                    imagePath = '../../upload_img/' + message.emp_image; // Set image path if available
                }

                var messageDate = new Date(message.mess_date);

                var isActive = (message.mess_sender_id == account_id) ? 'active' : '';

                messagesHTML += '<a href="javascript:void(0);" class="media d-flex changeChatView " data-account_id="' + message.mess_sender_id + '">';
          

                messagesHTML += '<div class="media-img-wrap flex-shrink-0">';
                messagesHTML += '<div class="avatar avatar-away">';
                messagesHTML += '<img src="' + imagePath + '" alt="User Image" class="avatar-img rounded-circle">';
                messagesHTML += '</div>';
                messagesHTML += '</div>';
                messagesHTML += '<div class="media-body flex-grow-1">';
                messagesHTML += '<div>';
                messagesHTML += '<div class="user-name">' + message.acc_fname +" "+message.acc_lname+ '</div>';
                messagesHTML += '<div class="user-last-chat" style="margin-right:100px!important">' + message.mess_content + '</div>';
                messagesHTML += '</div>';
                messagesHTML += '<div>';
                messagesHTML += '<div class="last-chat-time">' + messageDate.toLocaleString() + '</div>'; // Assuming you want the date in string format
                messagesHTML += '<div class="badge badge-success badge-pill">' + message.seen_count + '</div>';
                messagesHTML += '</div>';
                messagesHTML += '</div>';
                messagesHTML += '</a>';
            });

            $('#chatMessages .contacts_body').html(messagesHTML);


            $('#chatMessages .contacts_body').on('click', '.changeChatView', function() {
                var clickedAccountID = $(this).data("account_id");
            
                //viewChat =$("#viewChat").show();
            
                console.log("Clicked account_id:", clickedAccountID);
            
                // Here you can use the clicked account ID to perform actions.
                // For example, if you want to update the URL with the new account_id:
                var currentURL = new URL(window.location.href);
                currentURL.searchParams.set('account_id', clickedAccountID);
                window.history.pushState({}, '', currentURL);
            
                
                
                // Other actions based on the clicked account ID can be performed here.
            });
            
        },
        error: function() {
            alert('An error occurred while fetching messages.');
        },
        complete: function() {
            // After each Ajax request is complete, set up the next polling request
            setTimeout(function() {
                retrieveViewMessages();
            }, pollInterval);
        }
    });

        }
  
        retrieveViewMessages();
});
    