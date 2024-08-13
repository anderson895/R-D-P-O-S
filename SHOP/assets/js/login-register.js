$(document).ready(function() {
    
    $('#login').on("click", function(event){
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
            success: function(response){
                console.log(response)
            },
            error(xhr, status, error){
                $('#result').html('<p>Error: ' + error + '</p>');
            }
        })
    });
    
});