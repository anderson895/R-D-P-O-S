
$(document).ready(function() {
    $('#btnOnline').click(function() {
        $('#btnOnline').addClass('accent-e')
        $('#btnWalkin').removeClass('accent-e')
    });

    $('#btnWalkin').click(function() {
        $('#btnWalkin').addClass('accent-e')
        $('#btnOnline').removeClass('accent-e')
        $('#btnOnline').addClass('accent-f')
    });
});