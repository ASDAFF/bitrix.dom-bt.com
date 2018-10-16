+function ($) {
    'use strict';

    var SmtMenuMain = function (element, options) {
        this.options = $.extend({}, SmtMenuMain.DEFAULTS, options);
        this.$element = $(element);

        if (this.options.container) {
            this.$container = $(this.options.container);
        } else if (this.$element.attr('data-container')) {
            this.$container = $(this.$element.attr('data-container'));
        } else {
            this.$container = this.$element.parent();
        }

        this.$cloneList = $(element).clone().removeClass();
        this.$cloneListChildren = this.$cloneList.children();

        this.$cloneList.children().addClass('hidden');
        $(this.$element).append('<li><a href="#" class="' + this.options.moreLinkClass + '">' + this.options.moreLinkContent + '</a>');
        $('> li:last-child', this.$element).append(this.$cloneList).addClass('hidden');

        this.$children = $(element).children();

        if(this.options.clearHtml) {
            this.$element.contents().filter(function(index, element) {
                return element.nodeType == 3 && /\S/.test(element.nodeValue) === false;
            }).remove();
        }

        this.resize();
        $(window).on('resize.smt-menu-main', $.proxy($.debounce(this.resize, 25), this))
    };

    SmtMenuMain.DEFAULTS = {
        moreLinkClass: 'smt-more-link',
        moreLinkContent: '...',
        clearHtml: false
    };

    SmtMenuMain.prototype.resize = function () {
        var containerWidth = this.$container.width();
        var widthLastElement = $('> li:last-child', this.$element).outerWidth(true);
        widthLastElement = 57;
        var measureWidth = containerWidth - widthLastElement;

        var width = 0;
        var counter = 0;
        var countHidden = 0;
        for(var i = 0; i<this.$children.length-1; i++) {
            var elementWidth = $(this.$children[i]).data('cacheWidth');
            if (!elementWidth) {
                elementWidth = $(this.$children[i]).outerWidth(true);
                $(this.$children[i]).data('cacheWidth', elementWidth);
            }
            width += elementWidth;

            if (i == this.$children.length-2 && countHidden == 0) {
                measureWidth = containerWidth;
            }

            if (width > measureWidth) {
                $('> li:last-child', this.$element).removeClass('hidden');
                $(this.$children[i]).addClass('hidden');
                $(this.$cloneListChildren[i]).removeClass('hidden');
                countHidden += 1;
            } else {
                $(this.$children[i]).removeClass('hidden');
                $(this.$cloneListChildren[i]).addClass('hidden');
                counter += 1;
            }
        }
        if (counter == this.$children.length-1) {
            $('> li:last-child', this.$element).addClass('hidden');
        }
        this.$element.css('overflow', 'visible');
    };

    function Plugin(option) {
        return this.each(function () {
            var $this   = $(this);
            var data    = $this.data('bs.smt-menu-main');
            var options = typeof option == 'object' && option;

            if (!data) $this.data('bs.smt-menu-main', (data = new SmtMenuMain(this, options)));
            if (typeof option == 'string') data[option]();
        })
    }

    var old = $.fn.smtMenuMain;

    $.fn.smtMenuMain             = Plugin;
    $.fn.smtMenuMain.Constructor = SmtMenuMain;

    $.fn.smtMenuMain.noConflict = function () {
        $.fn.smtMenuMain = old;
        return this
    };

    $(window).on('load', function () {
        $('[data-smt-menu="collapsed"]').each(function () {
            Plugin.call($(this), $(this).data())
        })
    });
}(jQuery);