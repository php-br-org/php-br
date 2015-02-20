//( function ( $ ) {
    'use strict';

    var phpbr = phpbr || {};

    phpbr.prototype = {
        highlight: function() {
            hljs.initHighlightingOnLoad();
        }
    };

    $(document).ready(function() {
        $(document).foundation();
        $(document).confirmWithReveal();
    });
//} ( jQuery ) );