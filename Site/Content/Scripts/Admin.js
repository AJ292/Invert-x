function BindLinks() {
    $('.post-container a[rel="ajax"]').click(function() {
        var $t = $(this);
        LoadPage($t.attr('href'));
        window.history.pushState({}, document.title, $t.attr('href'));
        return false;
    });
    $('.datepicker').datepicker({ dateFormat: 'yy-mm-dd' });
    $('input.tags').select2({
        tags: ($('[name=AllTags]').val() || '').split(',')
    });
}

function LoadPage(href) {
    var p = $('.post-container').addClass('hide-left').parent();
    var c = p.load(href + " .post-container", function(data) {
        var h = $(this).find('.post-container').addClass('hide-right');//.removeClass('hide-right');
        setTimeout(function() {h.removeClass('hide-right')}, 100);
        p.removeClass('loading');
        BindLinks();
        $('.article-header-container').replaceWith($('.article-header-container', $('<div/>').append($.parseHTML(data))));
    })
}

$(function() {
    BindLinks();
    $(window).on('popstate', function(event) {
        LoadPage(document.location);
    });
});