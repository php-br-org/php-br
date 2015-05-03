'use strict';

var phpbr = phpbr || {
    constructor: 'phpbr',

    init: function() {
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

            $(".lined").linedtextarea(
                {selectedLine: 1}
            );

            phpbr.tabbedTextarea();
        });
    },

    highlight: function () {
        hljs.initHighlightingOnLoad();
    },

    tabbedTextarea: function() {
        $(document).delegate('#phpbr_bundle_appbundle_cole_codigo', 'keydown', function(e) {
            var keyCode = e.keyCode || e.which;

            if (keyCode == 9) {
                e.preventDefault();
                var start = $(this).get(0).selectionStart;
                var end = $(this).get(0).selectionEnd;

                $(this).val($(this).val().substring(0, start)
                + "\t"
                + $(this).val().substring(end));

                $(this).get(0).selectionStart =
                    $(this).get(0).selectionEnd = start + 1;
            }
        });
    },

    countdownupdate: function (element) {
        var size = $('.' + element).attr('maxlength'),
            remaining = size - $('.' + element).val().length;

        $(".span-countdown-" + element).text(remaining + ' caracteres restantes de ' + size);
    },

    countdown: function (element) {
        var size = $('.' + element).attr('maxlength'),
            remaining = size - $('.' + element).val().length;

        $('.' + element).after('<div class="div-countdown-' + element + '" id="textarea-countdown"><span class="span-countdown-' + element + '">' + remaining + ' careteres restantes de ' + size + '</span></div>');

        $('.' + element)
            .attr('onChange', "phpbr.countdownupdate('" + element + "', " + size + ");")
            .attr('onKeyUp', "phpbr.countdownupdate('" + element + "', " + size + ");")
        ;
    },

    getComentarios: function (slug) {
        $.ajax({
            type: 'GET',
            url: '/api/v1/qtd-comentarios/' + slug,
            success: function (data, status) {
                var quantidade = parseInt(data);
                var comentario = 'comentário';
                var retorno = '<strong>' + data + '</strong> ' + comentario;

                if (quantidade > 0) {
                    if (1 == quantidade) {
                        var retornoFinal = retorno;
                    } else {
                        var retornoFinal = retorno + 's';
                    }
                    $('#comentarios_' + slug).append(retornoFinal);
                } else {
                    $('#comentarios_' + slug).append('Comente!');
                }

            }
        });
    }
};

phpbr.init();