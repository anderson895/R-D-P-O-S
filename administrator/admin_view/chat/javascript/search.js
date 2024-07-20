$(document).ready(function() {
    $('#searchInput').on('input', function() {
        var searchText = $(this).val().trim();

        if (searchText === '') {
            // If the search input is empty, retrieve all messages using the original query
            retrieveAllMessages();
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
        messagesHTML += '<div class="user-name">' + message.acc_username + '</div>';
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
