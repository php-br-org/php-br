'use strict';

var phpbr = phpbr || {};

phpbr.prototype = {};

phpbr = {
    highlight : function() {
        hljs.initHighlightingOnLoad();
    },
    countdownupdate : function(element) {

        var size = $('.' + element).attr('maxlength');

        var remaining = size - $('.' + element).val().length;

        $(".span-countdown-" + element).text(remaining + ' careteres restantes de ' + size);
    },
    countdown : function(element) {
        var size = $('.' + element).attr('maxlength');

        var remaining = size - $('.' + element).val().length;

        $('.'+element).after('<div class="div-countdown-' + element + '" id="textarea-countdown"><span class="span-countdown-' + element + '">' + remaining + ' careteres restantes de ' + size + '</span></div>');

        $('.'+element).attr('onChange', "phpbr.countdownupdate('"+element+"', "+size+");");

        $('.'+element).attr('onKeyUp', "phpbr.countdownupdate('"+element+"', "+size+");");
    }
};

$(document).ready(function() {
    $(this).foundation();
    $(this).confirmWithReveal();

    $('textarea.meltdown-editor').meltdown({
        fullscreen: false
    });

    $.ajax({
        type: 'GET',
        url: 'https://api.github.com/repos/php-br-org/php-br/contributors',
        dataType: 'jsonp',
        success: function(data,status) {
            $.each(data.data, function (key, contributor) {      
                var image = " <img src=\"" + contributor.avatar_url + "\" width=\"48\" height=\"48\" class=\"avatar\">";
                var link = $(document.createElement('a'));
                link.attr('href','https://github.com/'+contributor.login);
                link.attr('target', "_blank");
                link.attr('rel', 'tooltip');
                link.attr('title', contributor.login);
                link.html(image);
                $('#contributors').append(link);
            });
        }
    });
});


