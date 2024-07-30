$(document).ready(function() {
    $('#showLine').click(function() {
        $('#showLine').addClass('stat-btn').removeClass('reset-btn');
        $('#showBar').addClass('reset-btn').removeClass('stat-btn');
        $('#statB').hide();  // Adding fadeIn animation
        $('#statA').show();           // Adding fadeOut animation
    });

    $('#showBar').click(function() {
        $('#showBar').addClass('stat-btn').removeClass('reset-btn');
        $('#showLine').addClass('reset-btn').removeClass('stat-btn');
        $('#statA').hide();  // Adding fadeIn animation
        $('#statB').show();           // Adding fadeOut animation
    });
});
