$(document).ready(function() {
    
    $('#login').on("click", function(event){
        $('#login-loading').show()
        $('#login').hide().attr('disabled')
        username = $('#username').val()
        password = $('#password').val()

        postData = {
            username: username,
            password: password
        };

        $.ajax({
            url: '../SHOP/server/post_login',
            type: 'POST',
            data: postData,
            dataType: 'json',
            success: function(response) {
                let status = response.success;
                setTimeout(function(){
                    if (status === true) { // Compare with boolean true
                        window.location.href = '../SHOP/home'; // Corrected redirection
                    }else{
                        $('#login-loading').hide()
                        $('#login').show()
                    }
                }, 3000);
            },
            error: function(xhr, status, error) { // Added function keyword
                $('#result').html('<p>Error: ' + error + '</p>');
            }
        });
        
    });
    
});