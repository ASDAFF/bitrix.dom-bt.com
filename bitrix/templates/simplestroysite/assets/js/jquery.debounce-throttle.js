(function($) {

    $.extend({

        /**
         * Debounce's decorator
         * @param {Function} fn original function
         * @param {Number} timeout timeout
         * @param {Boolean} [invokeAsap=false] invoke function as soon as possible
         * @param {Object} [ctx] context of original function
         */
        debounce : function(fn, timeout, invokeAsap, ctx) {

            if(arguments.length == 3 && typeof invokeAsap != 'boolean') {
                ctx = invokeAsap;
                invokeAsap = false;
            }

            var timer;

            return function() {

                var args = arguments;
                ctx = ctx || this;

                invokeAsap && !timer && fn.apply(ctx, args);

                clearTimeout(timer);

                timer = setTimeout(function() {
                    invokeAsap || fn.apply(ctx, args);
                    timer = null;
                }, timeout);

            };

        },

        /**
         * Throttle's decorator
         * @param {Function} fn original function
         * @param {Number} timeout timeout
         * @param {Object} [ctx] context of original function
         */
        throttle : function(fn, timeout, ctx) {

            var timer, args, needInvoke;

            return function() {

                args = arguments;
                needInvoke = true;
                ctx = ctx || this;

                timer || (function() {
                    if(needInvoke) {
                        fn.apply(ctx, args);
                        needInvoke = false;
                        timer = setTimeout(arguments.callee, timeout);
                    }
                    else {
                        timer = null;
                    }
                })();

            };

        }

    });

})(jQuery);