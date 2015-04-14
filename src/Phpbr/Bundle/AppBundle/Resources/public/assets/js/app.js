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

        $(".span-countdown-" + element).text(remaining + ' carateres restantes de ' + size);
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
});