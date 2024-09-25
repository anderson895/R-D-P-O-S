$(document).ready(function() {
    var account_id = $("#account_id").val(); 
    var session_id = $("#session_id").val();
    var pollInterval = 1000; 

    function retrieveViewMessages(accountId) {
        console.log("Retrieving messages for account ID:", accountId);
        
        $.ajax({
            url: 'chat/controller/getViewMessage.php',
            type: 'GET',
            data: { account_id: accountId },
            dataType: 'json',
            success: function(data) {
                console.log("Data received:", data);
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
                        $("#reciever_image").attr("src", imagePathReciever);
        
                        data.forEach(function(message) {
                            var formattedTime = formatTimeTo12HourFormat(message.mess_date);
                            $('#chatbox').toggle(message.Reciever_id !== null);
        
                            var imagePathReciever = '../../upload_system/empty.png';
                            if (message.Reciever_image !== '') {
                                imagePathReciever = '../../upload_img/' + message.Reciever_image;
                            }
        
                            var imagePath = '../../upload_system/empty.png';
                            if (message.emp_image !== '') {
                                imagePath = '../../upload_img/' + message.emp_image;
                            }
        
                            var messageHtml = '<li class="media ' + (message.mess_sender == session_id ? 'sent' : 'received') + ' d-flex">';
                            messageHtml += '<div class="avatar flex-shrink-0">';
                            messageHtml += '<img src="' + imagePath + '" alt="User Image" class="avatar-img rounded-circle">';
                            messageHtml += '</div>';
                            messageHtml += '<div class="media-body flex-grow-1">';
                            messageHtml += '<div class="msg-box"><div>';
                            messageHtml += '<i><b>' + message.acc_fname + ' ' + message.acc_lname + '</b> (' + message.acc_type + ')</i>';
                            messageHtml += '<p>' + message.mess_content + '</p>';
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
                setTimeout(function() {
                    retrieveViewMessages(account_id);
                }, pollInterval);
            }
        });
    }

    console.log("Initial Account ID:", account_id);
    retrieveViewMessages(account_id);

    $('#chatMessages .contacts_body').on('click', '.changeChatView', function() {
        var clickedAccountID = $(this).data("account_id"); // Get the clicked account_id
        account_id = clickedAccountID; // Update the account_id based on the clicked element
        console.log("Changed Account ID:", account_id);
        retrieveViewMessages(account_id);
    });

    retrieveAllMessages();

    $('#searchInput').on('input', function() {
        var searchText = $(this).val().trim();
        console.log("Search input:", searchText);

        if (searchText === '') {
            console.log('Input is empty');
            retrieveViewMessages(account_id); // Pass the account_id
        } else {
            searchMessages(searchText);
        }
    });
});

function retrieveAllMessages() {
    $.ajax({
        url: 'chat/controller/getMessages.php',
        type: 'GET',
        success: function(response) {
            displayMessages(response);
        },
        error: function() {
            alert('May nangyaring error sa pagkuha ng mga mensahe.');
        }
    });
}

function searchMessages(searchText) {
    $.ajax({
        url: 'chat/controller/searchMessages.php',
        type: 'POST',
        data: { searchText: searchText },
        success: function(response) {
            displayMessages(response);
            console.log(response);
        },
        error: function() {
            alert('May nangyaring error sa paghahanap ng mensahe.');
        }
    });
}

function displayMessages(response) {
    var messages = JSON.parse(response);
    var messagesHTML = '';

    messages.forEach(function(message) {
        var imagePath = '../../upload_system/empty.png'; // Default na image path

        if (message.emp_image !== '') {
            imagePath = '../../upload_img/' + message.emp_image; // Tamang path kung may larawan
        }

        var messageDate = new Date(message.mess_date);

        messagesHTML += '<a href="javascript:void(0);" class="media d-flex active">';
        messagesHTML += '<div class="media-img-wrap flex-shrink-0">';
        messagesHTML += '<div class="avatar avatar-away">';
        messagesHTML += '<img src="' + imagePath + '" alt="User Image" class="avatar-img rounded-circle">';
        messagesHTML += '</div>';
        messagesHTML += '</div>';
        messagesHTML += '<div class="media-body flex-grow-1">';
        messagesHTML += '<div>';
        messagesHTML += '<div class="user-name">' + message.acc_fname + '</div>';
        messagesHTML += '<div class="user-last-chat">' + message.mess_content + '</div>';
        messagesHTML += '</div>';
        messagesHTML += '<div>';
        messagesHTML += '<div class="last-chat-time">' + formatTime(messageDate) + '</div>';
        messagesHTML += '<div class="badge badge-success badge-pill">' + message.seen_count + '</div>';
        messagesHTML += '</div>';
        messagesHTML += '</div>';
        messagesHTML += '</a>';
    });

    $('#chatMessages .contacts_body').html(messagesHTML);
}
