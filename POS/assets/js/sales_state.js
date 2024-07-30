$(document).ready(function() {
    $('#btnOnline').click(function() {
        $('#onlineDiv').toggleClass('accent-e');
        console.log('selected')
    });

    $('#btnWalkin').click(function() {
        $('#walkinDiv').toggleClass('accent-e');
        console.log('selected')
    });
});