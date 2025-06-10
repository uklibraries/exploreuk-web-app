$(function () {
    $('.popular-resources > li > a > h3 > span').each(function () {
        if ($(this).height() > $(this).parent().height()) {
            var fraction = $(this).parent().height() / $(this).height();
            var target = Math.ceil(fraction * 100) + '%';
            $(this).css('font-size', target);
        }
    });
});
