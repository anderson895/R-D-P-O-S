
$(document).ready(function() {
    $('#btnOnline').click(function() {
        $('#btnOnline').addClass('accent-e')
        $('#btnWalkin').removeClass('accent-e')
        $('#salesWalkin').hide()
        $('#salesOnline').fadeIn()
        $('#top5Walk').hide()
        $('#top5Ol').fadeIn()
        $('#top-product').fadeIn()
        $('#top-walk').hide()
    });

    $('#btnWalkin').click(function() {
        $('#btnWalkin').addClass('accent-e')
        $('#btnOnline').removeClass('accent-e')
        $('#btnOnline').addClass('accent-f')
        $('#salesWalkin').fadeIn()
        $('#salesOnline').hide()
        $('#top5Ol').hide()
        $('#top5Walk').fadeIn()
        $('#top-product').hide()
        $('#top-walk').fadeIn()
    });
});
