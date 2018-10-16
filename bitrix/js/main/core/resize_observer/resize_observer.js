;(function() {
	'use strict';

	BX.namespace('BX');


	/**
	 * Implements ResizeObserver interface
	 * @see https://wicg.github.io/ResizeObserver/#resize-observer-interface
	 *
	 * @param {function} callback
	 * @constructor
	 */
	BX.ResizeObserver = function(callback)
	{
		this.callback = callback;
		this.targets = new BX.ResizeObserverItemCollection();
		BX.ResizeObserver.observers.push(this);
	};


	/**
	 * Observers collection
	 * @static
	 * @type {BX.ResizeObserverCollection}
	 */
	BX.ResizeObserver.observers = new BX.ResizeObserverCollection();


	/**
	 * Broadcasts observations
	 * @static
	 * @private
	 */
	BX.ResizeObserver.broadcastObservation = function()
	{
		BX.ResizeObserver.observers.forEach(function(observer) {
			var activeTargets = observer.targets.getActive();

			if (activeTargets.length)
			{
				observer.callback(activeTargets);
			}
		});

		BX.ResizeObserver.setFrameWait(BX.ResizeObserver.broadcastObservation);
	};


	/**
	 * @static
	 * @private
	 * @param callback
	 */
	BX.ResizeObserver.setFrameWait = function(callback)
	{
		if (typeof window.requestAnimationFrame === 'undefined')
		{
			window.setTimeout(callback, 1000 / 60);
		}
		else
		{
			window.requestAnimationFrame(callback);
		}
	};


	/**
	 * Starts wait
	 * @static
	 * @private
	 */
	BX.ResizeObserver.run = function()
	{
		BX.ResizeObserver.setFrameWait(BX.ResizeObserver.broadcastObservation);
	};



	BX.ResizeObserver.prototype = {
		/**
		 * Adds target to the list of observed elements.
		 * @param {HTMLElement} element
		 */
		observe: function(element)
		{
			if (!this.targets.hasTarget(element))
			{
				this.targets.push(new BX.ResizeObserverItem(element));
			}
		},


		/**
		 * Removes target from the list of observed elements.
		 * @param {HTMLElement} element
		 */
		unobserve: function(element)
		{
			this.targets.removeTarget(element);
		},


		/**
		 * Clear observation targets list
		 */
		disconnect: function()
		{
			this.targets = [];
		}
	};


	BX.ResizeObserver.run();
})();