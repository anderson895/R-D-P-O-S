$(document).ready(function() {
    $('#showLine, #showLinepos').click(function() {
        toggleView('#showLine', '#showBar', '#statA', '#statB');
        toggleView('#showLinepos', '#showBarpos', '#statApos', '#statBpos');
    });

    $('#showBar, #showBarpos').click(function() {
        toggleView('#showBar', '#showLine', '#statB', '#statA');
        toggleView('#showBarpos', '#showLinepos', '#statBpos', '#statApos');
    });
});

function toggleView(buttonToShow, buttonToHide, divToShow, divToHide) {
    $(buttonToShow).addClass('stat-btn').removeClass('reset-btn');
    $(buttonToHide).addClass('reset-btn').removeClass('stat-btn');
    $(divToHide).hide();
    $(divToShow).show();
}