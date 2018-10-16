+function ($) {
    'use strict';

    jQuery.fn.extend({
        toggleText: function (a, b){
            var that = this;
            if (that.text() != a && that.text() != b){
                that.text(a);
            }
            else
            if (that.text() == a){
                that.text(b);
            }
            else
            if (that.text() == b){
                that.text(a);
            }
            return this;
        }
    });

    $(document).ready(function () {
        $('.smt-navbar_fixed').affix({
            offset: {
                top:  function () {
                    return (this.top = $('.smt-head').outerHeight(true))
                }
            }
        });

        $('.smt-navbar_fixed').on('affix.bs.affix', function (e) {
            if ($(window).width() >= 768) {
                $('.smt-head').height($('.smt-head').outerHeight(true));
            }
        });

        $(window).on('resize.smt-menu-main', $.proxy($.debounce(function() {
            $('.smt-head').height('auto');
        }, 25)));

        var $menu = $('.smt-menu-main_js-hidden');
        $menu.smtMenuMain({
            container: $menu.parents('.smt-navbar-menu-container')
        });

        $('.smt-menu-main_js-smart').smartmenus({
            subMenusSubOffsetX: 1,
            subMenusSubOffsetY: -8,
            subMenusMinWidth: '12em',
            subIndicatorsText: '<span class="fa fa-angle-down"></span>'
        });

        $('.smt-main-left_js-smart').smartmenus({
            subIndicatorsText: ''
        });

        $('.smt-main-left_js-smart').find('a.current').parents('ul').show().prev().addClass('highlighted');

        $.fn.extend({
            animateCss: function (animationName) {
                var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
                $(this).addClass('animated ' + animationName).one(animationEnd, function() {
                    $(this).removeClass('animated ' + animationName);
                });
            }
        });

        function owlSliderAnimate(event) {
            var current = event.item.index;
            var element = $(event.target).find(".owl-item").eq(current).find('.smt-slide__content');
            var animationClass = element.attr('data-slide-animate');
            element.animateCss(animationClass);
        }

        var owlSlider = $(".smt-slider_js .owl-carousel");

        owlSlider.on('initialized.owl.carousel changed.owl.carousel', owlSliderAnimate);

        owlSlider.owlCarousel($.extend({
            'items': 1,
            'nav': true,
            'loop': true,
            'navText': ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
            'dots': true,
            'autoplay': false,
            'autoplayTimeout': 5000,
            'smartSpeed': 450
        }, owlSlider.data('owl-options')));

        $('.smt-navbar-search-form_js-icon').on('show.bs.collapse', function (e) {
            var triggerElement = $(document).find("[data-target='#" + $(e.target).attr('id') + "']");
            $('.smt-navbar-search_icon-open', triggerElement).addClass('hidden');
            $('.smt-navbar-search_icon-close', triggerElement).removeClass('hidden');
        });

        $('.smt-navbar-search-form_js-icon').on('shown.bs.collapse', function (e) {
            $('.smt-navbar-search-form__input', this).focus();
        });

        $('.smt-navbar-search-form_js-icon').on('hide.bs.collapse', function (e) {
            var triggerElement = $(document).find("[data-target='#" + $(e.target).attr('id') + "']");
            $('.smt-navbar-search_icon-open', triggerElement).removeClass('hidden');
            $('.smt-navbar-search_icon-close', triggerElement).addClass('hidden');
        });

        var owlSlider = $('.smt-owl-carousel-js .owl-carousel');
        owlSlider.each(function () {
            var element = $(this);
            element.owlCarousel($.extend({
                'items': 1,
                'nav': true,
                'loop': true,
                'navText': ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                'dots': false,
                'autoplay': false,
                'margin': 10,
                'autoplayTimeout': 5000,
                'smartSpeed': 450
            }, element.data('owl-options')));
        });

        $('.smt-panel-group').on('show.bs.collapse', function (e) {
            $(e.target).parent().addClass('smt-panel-primary_in');
        }).on('hide.bs.collapse', function (e) {
            $(e.target).parent().removeClass('smt-panel-primary_in');
        });

        $('.smt-chart-pie-js').easyPieChart({
            barColor: '#4090E2',
            animate: 1200,
            lineWidth: 24,
            lineCap: 'square'
        });

        $('.date-control').datetimepicker({
            format: 'DD-MM-YYYY',
            locale: 'ru'
        });

        var smtPhotoOptions = {
            tClose: BX.message('SMT_PHOTO_OPTIONS_TCLOSE'),
            tLoading: BX.message('SMT_PHOTO_OPTIONS_TLOADING'),
            type: 'image',
            gallery: {
                tPrev: BX.message('SMT_PHOTO_OPTIONS_GALLERY_TPREV'),
                tNext: BX.message('SMT_PHOTO_OPTIONS_GALLERY_TNEXT'),
                tCounter: BX.message('SMT_PHOTO_OPTIONS_GALLERY_TCOUNTER'),
                enabled: true
            },
            closeMarkup: '<button title="%title%" type="button" class="mfp-close smt-popup-close smt-popup-close_out">&#215;</button>',
            image: {
                tError: BX.message('SMT_PHOTO_OPTIONS_IMAGE_TERROR')
            },
            ajax: {
                tError: BX.message('SMT_PHOTO_OPTIONS_AJAX_TERROR')
            }
        };

        $('.smt-photo-gallery-js').each(function() {
            $(this).magnificPopup($.extend({}, smtPhotoOptions, {delegate: 'a'}));
        });

        $('.smt-photo-popup-js').magnificPopup(smtPhotoOptions);

        $('.smt-popup-link-js').magnificPopup({
            type: 'inline',
            closeMarkup: '<button title="%title%" type="button" class="mfp-close smt-popup-close">&#215;</button>',
            autoFocusLast: false
        });

        function toUpPlugin() {
            var scroll = $(window).scrollTop();
            if (scroll > 500) {
                $('.smt-go-up-arrow-js').fadeIn();
            } else {
                $('.smt-go-up-arrow-js').fadeOut();
            }
        }

        $(window).scroll(function() {
            toUpPlugin();
        });

        toUpPlugin();

        $('.smt-go-up-arrow-js').click(function () {
            $('html, body').animate({scrollTop: 0}, 800);
            return false;
        });

        $('.smt-counter__value').countTo();

        $('.smt-read-more-text').each(function() {
            var $element = $(this);
            var maxHeight = parseInt($element.css('max-height'), 10);
            var scrollHeight = $element.prop('scrollHeight');
            if (scrollHeight > maxHeight) {
                $('<a href="#" class="smt-read-more-link">'+BX.message('SMT_READ_MORE_LINK_TEXT')+'</a>').insertAfter($element);
            }
        });

        $('.smt-read-more-link').click(function() {
            var $element = $(this).prev();
            $element.toggleClass('in');
            $(this).toggleText(BX.message('SMT_READ_MORE_LINK_CLOSE'), BX.message('SMT_READ_MORE_LINK_TEXT'));
            return false;
        });

        $('.smt-search-live').hideseek({
            'highlight': true
        }).on("_after", function() {
            $('.hideseek-data').filter(function() {
                if ($(this).find('tr').length === $(this).find('tr').filter(function() {
                        return $(this).css('display') === 'none';
                    }).length) {
                    $(this).closest('.panel').hide();
                } else {
                    $(this).closest('.panel').show();
                    $(this).closest('.collapse').collapse('show');
                }
            });
        });

        $('.smt-search-live').bind('input', function(){
            $(this).val(function(_, v){
                return v.replace(/^[\s\uFEFF\xA0]+/g, "");
            });
        });

        $('.smt-project-list').each(function() {
            var $elements = $('.smt-project-item', this);
            var $slider = $('.smt-owl-carousel-js', this);
            $slider.on('resized.owl.carousel', function(e) {
                $elements.matchHeight._update();
            });
            if($elements.length == 1) {
                $elements.height($elements.height());
                $(window).on('resize.smt-project-list', $.proxy($.debounce(function() {
                    $elements.height('auto');
                    $elements.height($elements.height());
                }, 25)));
            } else {
                $elements.matchHeight({
                    'byRow': false
                });
            }
        });
    });
}(jQuery);