{"version":3,"sources":["assets/js/init.js"],"names":["$","jQuery","fn","extend","toggleText","a","b","that","this","text","document","ready","owlSliderAnimate","event","current","item","index","element","target","find","eq","animationClass","attr","animateCss","toUpPlugin","window","scrollTop","fadeIn","fadeOut","affix","offset","top","outerHeight","on","e","width","height","proxy","debounce","$menu","smtMenuMain","container","parents","smartmenus","subMenusSubOffsetX","subMenusSubOffsetY","subMenusMinWidth","subIndicatorsText","show","prev","addClass","animationName","one","removeClass","owlSlider","owlCarousel","items","nav","loop","navText","dots","autoplay","autoplayTimeout","smartSpeed","data","triggerElement","focus","each","margin","parent","easyPieChart","barColor","animate","lineWidth","lineCap","datetimepicker","format","locale","smtPhotoOptions","tClose","BX","message","tLoading","type","gallery","tPrev","tNext","tCounter","enabled","closeMarkup","image","tError","ajax","magnificPopup","delegate","autoFocusLast","scroll","click","countTo","$element","maxHeight","parseInt","css","prop","insertAfter","toggleClass","hideseek","highlight","filter","length","closest","hide","collapse","bind","val","_","v","replace","$elements","matchHeight","_update","byRow"],"mappings":"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","file":"init.min.js","sourcesContent":["+function ($) {\n    'use strict';\n\n    jQuery.fn.extend({\n        toggleText: function (a, b){\n            var that = this;\n            if (that.text() != a && that.text() != b){\n                that.text(a);\n            }\n            else\n            if (that.text() == a){\n                that.text(b);\n            }\n            else\n            if (that.text() == b){\n                that.text(a);\n            }\n            return this;\n        }\n    });\n\n    $(document).ready(function () {\n        $('.smt-navbar_fixed').affix({\n            offset: {\n                top:  function () {\n                    return (this.top = $('.smt-head').outerHeight(true))\n                }\n            }\n        });\n\n        $('.smt-navbar_fixed').on('affix.bs.affix', function (e) {\n            if ($(window).width() >= 768) {\n                $('.smt-head').height($('.smt-head').outerHeight(true));\n            }\n        });\n\n        $(window).on('resize.smt-menu-main', $.proxy($.debounce(function() {\n            $('.smt-head').height('auto');\n        }, 25)));\n\n        var $menu = $('.smt-menu-main_js-hidden');\n        $menu.smtMenuMain({\n            container: $menu.parents('.smt-navbar-menu-container')\n        });\n\n        $('.smt-menu-main_js-smart').smartmenus({\n            subMenusSubOffsetX: 1,\n            subMenusSubOffsetY: -8,\n            subMenusMinWidth: '12em',\n            subIndicatorsText: '<span class=\"fa fa-angle-down\"></span>'\n        });\n\n        $('.smt-main-left_js-smart').smartmenus({\n            subIndicatorsText: ''\n        });\n\n        $('.smt-main-left_js-smart').find('a.current').parents('ul').show().prev().addClass('highlighted');\n\n        $.fn.extend({\n            animateCss: function (animationName) {\n                var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';\n                $(this).addClass('animated ' + animationName).one(animationEnd, function() {\n                    $(this).removeClass('animated ' + animationName);\n                });\n            }\n        });\n\n        function owlSliderAnimate(event) {\n            var current = event.item.index;\n            var element = $(event.target).find(\".owl-item\").eq(current).find('.smt-slide__content');\n            var animationClass = element.attr('data-slide-animate');\n            element.animateCss(animationClass);\n        }\n\n        var owlSlider = $(\".smt-slider_js .owl-carousel\");\n\n        owlSlider.on('initialized.owl.carousel changed.owl.carousel', owlSliderAnimate);\n\n        owlSlider.owlCarousel($.extend({\n            'items': 1,\n            'nav': true,\n            'loop': true,\n            'navText': ['<i class=\"fa fa-angle-left\"></i>', '<i class=\"fa fa-angle-right\"></i>'],\n            'dots': true,\n            'autoplay': false,\n            'autoplayTimeout': 5000,\n            'smartSpeed': 450\n        }, owlSlider.data('owl-options')));\n\n        $('.smt-navbar-search-form_js-icon').on('show.bs.collapse', function (e) {\n            var triggerElement = $(document).find(\"[data-target='#\" + $(e.target).attr('id') + \"']\");\n            $('.smt-navbar-search_icon-open', triggerElement).addClass('hidden');\n            $('.smt-navbar-search_icon-close', triggerElement).removeClass('hidden');\n        });\n\n        $('.smt-navbar-search-form_js-icon').on('shown.bs.collapse', function (e) {\n            $('.smt-navbar-search-form__input', this).focus();\n        });\n\n        $('.smt-navbar-search-form_js-icon').on('hide.bs.collapse', function (e) {\n            var triggerElement = $(document).find(\"[data-target='#\" + $(e.target).attr('id') + \"']\");\n            $('.smt-navbar-search_icon-open', triggerElement).removeClass('hidden');\n            $('.smt-navbar-search_icon-close', triggerElement).addClass('hidden');\n        });\n\n        var owlSlider = $('.smt-owl-carousel-js .owl-carousel');\n        owlSlider.each(function () {\n            var element = $(this);\n            element.owlCarousel($.extend({\n                'items': 1,\n                'nav': true,\n                'loop': true,\n                'navText': ['<i class=\"fa fa-angle-left\"></i>', '<i class=\"fa fa-angle-right\"></i>'],\n                'dots': false,\n                'autoplay': false,\n                'margin': 10,\n                'autoplayTimeout': 5000,\n                'smartSpeed': 450\n            }, element.data('owl-options')));\n        });\n\n        $('.smt-panel-group').on('show.bs.collapse', function (e) {\n            $(e.target).parent().addClass('smt-panel-primary_in');\n        }).on('hide.bs.collapse', function (e) {\n            $(e.target).parent().removeClass('smt-panel-primary_in');\n        });\n\n        $('.smt-chart-pie-js').easyPieChart({\n            barColor: '#4090E2',\n            animate: 1200,\n            lineWidth: 24,\n            lineCap: 'square'\n        });\n\n        $('.date-control').datetimepicker({\n            format: 'DD-MM-YYYY',\n            locale: 'ru'\n        });\n\n        var smtPhotoOptions = {\n            tClose: BX.message('SMT_PHOTO_OPTIONS_TCLOSE'),\n            tLoading: BX.message('SMT_PHOTO_OPTIONS_TLOADING'),\n            type: 'image',\n            gallery: {\n                tPrev: BX.message('SMT_PHOTO_OPTIONS_GALLERY_TPREV'),\n                tNext: BX.message('SMT_PHOTO_OPTIONS_GALLERY_TNEXT'),\n                tCounter: BX.message('SMT_PHOTO_OPTIONS_GALLERY_TCOUNTER'),\n                enabled: true\n            },\n            closeMarkup: '<button title=\"%title%\" type=\"button\" class=\"mfp-close smt-popup-close smt-popup-close_out\">&#215;</button>',\n            image: {\n                tError: BX.message('SMT_PHOTO_OPTIONS_IMAGE_TERROR')\n            },\n            ajax: {\n                tError: BX.message('SMT_PHOTO_OPTIONS_AJAX_TERROR')\n            }\n        };\n\n        $('.smt-photo-gallery-js').each(function() {\n            $(this).magnificPopup($.extend({}, smtPhotoOptions, {delegate: 'a'}));\n        });\n\n        $('.smt-photo-popup-js').magnificPopup(smtPhotoOptions);\n\n        $('.smt-popup-link-js').magnificPopup({\n            type: 'inline',\n            closeMarkup: '<button title=\"%title%\" type=\"button\" class=\"mfp-close smt-popup-close\">&#215;</button>',\n            autoFocusLast: false\n        });\n\n        function toUpPlugin() {\n            var scroll = $(window).scrollTop();\n            if (scroll > 500) {\n                $('.smt-go-up-arrow-js').fadeIn();\n            } else {\n                $('.smt-go-up-arrow-js').fadeOut();\n            }\n        }\n\n        $(window).scroll(function() {\n            toUpPlugin();\n        });\n\n        toUpPlugin();\n\n        $('.smt-go-up-arrow-js').click(function () {\n            $('html, body').animate({scrollTop: 0}, 800);\n            return false;\n        });\n\n        $('.smt-counter__value').countTo();\n\n        $('.smt-read-more-text').each(function() {\n            var $element = $(this);\n            var maxHeight = parseInt($element.css('max-height'), 10);\n            var scrollHeight = $element.prop('scrollHeight');\n            if (scrollHeight > maxHeight) {\n                $('<a href=\"#\" class=\"smt-read-more-link\">'+BX.message('SMT_READ_MORE_LINK_TEXT')+'</a>').insertAfter($element);\n            }\n        });\n\n        $('.smt-read-more-link').click(function() {\n            var $element = $(this).prev();\n            $element.toggleClass('in');\n            $(this).toggleText(BX.message('SMT_READ_MORE_LINK_CLOSE'), BX.message('SMT_READ_MORE_LINK_TEXT'));\n            return false;\n        });\n\n        $('.smt-search-live').hideseek({\n            'highlight': true\n        }).on(\"_after\", function() {\n            $('.hideseek-data').filter(function() {\n                if ($(this).find('tr').length === $(this).find('tr').filter(function() {\n                        return $(this).css('display') === 'none';\n                    }).length) {\n                    $(this).closest('.panel').hide();\n                } else {\n                    $(this).closest('.panel').show();\n                    $(this).closest('.collapse').collapse('show');\n                }\n            });\n        });\n\n        $('.smt-search-live').bind('input', function(){\n            $(this).val(function(_, v){\n                return v.replace(/^[\\s\\uFEFF\\xA0]+/g, \"\");\n            });\n        });\n\n        $('.smt-project-list').each(function() {\n            var $elements = $('.smt-project-item', this);\n            var $slider = $('.smt-owl-carousel-js', this);\n            $slider.on('resized.owl.carousel', function(e) {\n                $elements.matchHeight._update();\n            });\n            if($elements.length == 1) {\n                $elements.height($elements.height());\n                $(window).on('resize.smt-project-list', $.proxy($.debounce(function() {\n                    $elements.height('auto');\n                    $elements.height($elements.height());\n                }, 25)));\n            } else {\n                $elements.matchHeight({\n                    'byRow': false\n                });\n            }\n        });\n    });\n}(jQuery);"]}