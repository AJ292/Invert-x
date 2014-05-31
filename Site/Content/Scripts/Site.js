$(function() {
    $('.content-jump-button').click(function() {
        $.scrollTo('.content-container', 800, {easing:'easeInOutExpo'});
        return false;
    });
});