(function ($) {
    "use strict";
    var adforest_ajax_url = $('#adforest_ajax_url').val();
    var ua = navigator.userAgent.toLowerCase();
    if (ua.indexOf("safari/") !== -1 && ua.indexOf("windows") !== -1 && ua.indexOf("chrom") === -1  ) { $('.sb-top-bar_notification').show(); }
    $(".comming-soon-grid").height($(window).height());
    $(window).resize(function () { $(".comming-soon-grid").height($(window).height()); });
    $('#clock').countdown($('#when_live').val(), function (event) { var $this = $(this).html(event.strftime($('#get_time').val())); });
})(jQuery);

function adforest_validateEmail(sEmail)
{
    var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
    if (filter.test(sEmail)) { return true; } else { return false; }
}
