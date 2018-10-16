+function ($) {
    'use strict';

    $(document).ready(function () {
        function smtAjaxFormHandler(e) {
            e.stopImmediatePropagation();
            var data = $(this).serializeArray();
            var submit = $('input[type=submit]', this);
            var formWrapper = $(this).parent();
            data.push({name: submit.attr('name'), value: submit.val()});
            submit.prop('disabled', true);

            $.ajax({
                url: $(this).attr('action'),
                type: 'post',
                dataType: 'html',
                data: data
            }).done(function(msg) {
                submit.prop('disabled', false);
                formWrapper.empty();
                formWrapper.replaceWith(msg);
                $('.date-control').datetimepicker({
                    format: 'DD-MM-YYYY',
                    locale: 'ru'
                });
                $('.smt-order-form-ajax').bind("submit", smtAjaxFormHandler);
            }).fail(function() {
                submit.prop('disabled', false);
            });
            return false;
        }

        $('.smt-order-form-ajax').bind("submit", smtAjaxFormHandler);
    });
}(jQuery);

