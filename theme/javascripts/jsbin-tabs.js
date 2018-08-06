/* License for this file is in licenses/jsbin.txt. */
$(document).ready(function () {
    $('#item-view-tabs > li > a').click(function (event) {
        event.preventDefault();

        var active_tab_selector = $('#item-view-tabs > li.active > a').attr('href');
        var actived_nav = $('#item-view-tabs > li.active');

        actived_nav.removeClass('active');
        $(this).parents('li').addClass('active');

        $(active_tab_selector).removeClass('active');
        $(active_tab_selector).addClass('hide');

        var target_tab_selector = $(this).attr('href');
        $(target_tab_selector).removeClass('hide');
        $(target_tab_selector).addClass('active');
    });
});
