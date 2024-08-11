$(document).ready(function() {
    // Initialize the swiper container width and button functionality
    var container = $('.container-swiper-fyke');
    var scrollAmount = 100; // Amount to scroll per button click
    var startX;
    var scrollStartX;

    // Scroll left
    $('.btn-control-left').on('click', function() {
        container.animate({
            scrollLeft: container.scrollLeft() - scrollAmount
        }, 300); // 300ms animation duration
    });

    // Scroll right
    $('.btn-control-right').on('click', function() {
        container.animate({
            scrollLeft: container.scrollLeft() + scrollAmount
        }, 300); // 300ms animation duration
    });

    // Touch start
    container.on('touchstart', function(event) {
        startX = event.originalEvent.touches[0].pageX;
        scrollStartX = container.scrollLeft();
    });

    // Touch move
    container.on('touchmove', function(event) {
        var touch = event.originalEvent.touches[0];
        var distance = startX - touch.pageX;
        container.scrollLeft(scrollStartX + distance);
    });

    // Touch end
    container.on('touchend', function(event) {
        var touch = event.originalEvent.changedTouches[0];
        var distance = startX - touch.pageX;
        if (distance > 50) {
            container.animate({
                scrollLeft: container.scrollLeft() + scrollAmount
            }, 300); // 300ms animation duration
        } else if (distance < -50) {
            container.animate({
                scrollLeft: container.scrollLeft() - scrollAmount
            }, 300); // 300ms animation duration
        }
    });
});
