 // I-bind ang event handler sa Edit Cover button gamit ang jQuery
 $("#editCover").click(function() {
    // Gumamit ng fadeIn effect
    $("#saveCancelButtons").fadeIn();
    $("#backgroundimage").fadeIn();
    $(this).fadeOut(); // itinatago ang Edit Cover button
});

// I-bind ang event handler sa Cancel button gamit ang jQuery
$("#cancelButton").click(function() {
    // Gumamit ng fadeOut effect
    $("#saveCancelButtons").fadeOut();
    $("#backgroundimage").fadeOut();
    $("#editCover").fadeIn(); // ipinapakita ang Edit Cover button
});