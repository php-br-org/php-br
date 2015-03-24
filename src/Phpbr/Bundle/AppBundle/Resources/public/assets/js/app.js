//( function ( $ ) {
    'use strict';

    var phpbr = phpbr || {};

    phpbr.prototype = {
    };

    phpbr.highlight = function() {
        hljs.initHighlightingOnLoad();
    };

    $(document).ready(function() {
        $(this).foundation();
        $(this).confirmWithReveal();

        $('textarea.meltdown-editor').meltdown({
            fullscreen: false
        });
    });
//} ( jQuery ) );