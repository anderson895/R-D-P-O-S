
$(document).ready(function() {
    $('#btnOnline').click(function() {
        $('#btnOnline').addClass('accent-e')
        $('#btnWalkin').removeClass('accent-e')
        $('#salesWalkin').hide()
        $('#salesOnline').show()
        $('#top5Walk').hide()
        $('#top5Ol').show()
        $('#top-product').show()
        $('#top-walk').hide()
    });

    $('#btnWalkin').click(function() {
        $('#btnWalkin').addClass('accent-e')
        $('#btnOnline').removeClass('accent-e')
        $('#btnOnline').addClass('accent-f')
        $('#salesWalkin').show()
        $('#salesOnline').hide()
        $('#top5Ol').hide()
        $('#top5Walk').show()
        $('#top-product').hide()
        $('#top-walk').show()
    });
});
