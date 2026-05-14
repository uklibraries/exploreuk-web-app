$(function () {
    $('.navigation li:has(ul)').each(function () {
        $(this).find('a').first().removeAttr('href');
    });
});
