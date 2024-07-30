$(document).ready(function() {
    $('#showLine').click(function() {
        $('#showLine').addClass('stat-btn').removeClass('reset-btn');
        $('#showBar').addClass('reset-btn').removeClass('stat-btn');
        $('#statA').hide().fadeIn();  // Adding fadeIn animation
        $('#statB').show().fadeOut();           // Adding fadeOut animation
    });

    $('#showBar').click(function() {
        $('#showBar').addClass('stat-btn').removeClass('reset-btn');
        $('#showLine').addClass('reset-btn').removeClass('stat-btn');
        $('#statB').hide().fadeIn();  // Adding fadeIn animation
        $('#statA').show().fadeOut();           // Adding fadeOut animation
    });
});
