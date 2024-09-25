$(document).ready(function() {
    var account_id = $("#account_id").val();
    var pollInterval = 1000; // Declare pollInterval here
    var pollingActive = true; // Flag to track if polling is active
    var pollingTimeout; // Variable to store the timeout reference

    // Fetch messages initially
    retrieveViewMessages();

    $('#searchInput').on('input', function() {
        var searchText = $(this).val().trim();

        if (searchText === '') {
            // If the search input is empty, retrieve all messages and resume polling
            if (!pollingActive) {
                pollingActive = true; // Set flag to active
                retrieveViewMessages(); // Resume polling
            }
        } else {
            // If there is search input, stop polling
            pollingActive = false; // Set flag to inactive
            clearTimeout(pollingTimeout); // Clear any existing polling timeout
            searchMessages(searchText); // Perform search
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
    var messages;
    try {
        messages = JSON.parse(response);
    } catch (e) {
        console.error("Error parsing the response:", e);
        return;
    }

    var messagesHTML = '';

    messages.forEach(function(message) {
        var imagePath = message.emp_image ? 
            '../../upload_img/' + message.emp_image : 
            '../../upload_system/empty.png'; // Default image path

        var messageDate = new Date(message.mess_date);
        var isActive = (message.mess_sender == account_id) ? 'active' : '';

        messagesHTML += `
            <a href="javascript:void(0);" class="changeChatView media d-flex ${isActive}" data-account_id="${message.mess_sender}">
                <div class="media-img-wrap flex-shrink-0">
                    <div class="avatar avatar-away">
                        <img src="${imagePath}" alt="User Image" class="avatar-img rounded-circle">
                    </div>
                </div>
                <div class="media-body flex-grow-1">
                    <div>
                        <div class="user-name">${message.acc_fname} ${message.acc_lname}</div>
                        <div class="user-last-chat" style="margin-right:100px!important">${message.mess_content}</div>
                    </div>
                    <div>
                        <div class="last-chat-time">${messageDate.toLocaleString()}</div> <!-- Date as string -->
                        <div class="badge badge-success badge-pill">${message.seen_count}</div>
                    </div>
                </div>
            </a>`;
    });

    $('#chatMessages .contacts_body').html(messagesHTML);

    // Attach click event listener to dynamically created elements
    $('#chatMessages .contacts_body').off('click', '.changeChatView').on('click', '.changeChatView', function() {
        var clickedAccountID = $(this).data("account_id");

        // Update URL without reloading the page
        var currentURL = new URL(window.location.href);
        currentURL.searchParams.set('account_id', clickedAccountID);
        window.history.pushState({}, '', currentURL);
    });
}

function retrieveViewMessages() {
    $.ajax({
        url: 'chat/controller/getMessages.php',
        type: 'GET',
        success: function(response) {
            displayMessages(response);
        },
        error: function() {
            alert('An error occurred while fetching messages.');
        },
        complete: function() {
            // Polling mechanism to retrieve messages at regular intervals, if polling is active
            if (pollingActive) {
                pollingTimeout = setTimeout(retrieveViewMessages, pollInterval); // Call again if polling is active
            }
        }
    });
}
