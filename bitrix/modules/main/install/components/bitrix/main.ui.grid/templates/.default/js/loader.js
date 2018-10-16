;(function() {
	'use strict';

	BX.namespace('BX.Grid');

	BX.Grid.Loader = function(parent)
	{
		this.parent = null;
		this.container = null;
		this.windowHeight = null;
		this.tbodyPos = null;
		this.headerPos = null;
		this.lastPosTop = null;
		this.lastBottomPos = null;
		this.table = null;
		this.init(parent);
	};

	BX.Grid.Loader.prototype = {
		init: function(parent)
		{
			this.parent = parent;
			this.table = this.parent.getTable();
			BX.bind(this.getContainer(), 'animationend', BX.proxy(this._onAnimationEnd, this));
			BX.bind(this.getContainer(), 'webkitAnimationEnd', BX.proxy(this._onAnimationEnd, this));
			BX.bind(this.getContainer(), 'oanimationend', BX.proxy(this._onAnimationEnd, this));
			BX.bind(this.getContainer(), 'MSAnimationEnd', BX.proxy(this._onAnimationEnd, this));
		},

		adjustLoaderOffset: function()
		{
			this.windowHeight = BX.height(window);
			this.tbodyPos = BX.pos(this.table.tBodies[0]);
			this.headerPos = BX.pos(this.table.tHead);

			var scrollY = window.scrollY;

			if (this.parent.isIE())
			{
				scrollY = document.documentElement.scrollTop;
			}

			var bottomPos = (scrollY + this.windowHeight) - this.tbodyPos.top;
			var posTop = scrollY - this.tbodyPos.top;

			if (bottomPos > (this.tbodyPos.bottom - this.tbodyPos.top))
			{
				bottomPos = this.tbodyPos.bottom - this.tbodyPos.top;
			}

			if (posTop < this.headerPos.height)
			{
				posTop = this.headerPos.height;
			}
			else
			{
				bottomPos -= posTop;
				bottomPos += this.headerPos.height;
			}

			BX.Grid.Utils.requestAnimationFrame(BX.proxy(function() {
				if (posTop !== this.lastPosTop)
				{
					this.getContainer().style.transform = 'translate3d(0px, ' + posTop + 'px, 0)';
				}

				if (bottomPos !== this.lastBottomPos)
				{
					this.getContainer().style.height = bottomPos + 'px';
				}

				this.lastPosTop = posTop;
				this.lastBottomPos = bottomPos;
			}, this));
		},

		getContainer: function()
		{
			if (!this.container)
			{
				this.container = BX.Grid.Utils.getByClass(this.parent.getContainer(), this.parent.settings.get('classLoader'), true);
			}

			return this.container;
		},

		show: function()
		{
			var loader = this.getContainer();
			this.adjustLoaderOffset();

			BX.style(loader, 'display', 'block');
			BX.removeClass(loader, this.parent.settings.get('classLoaderHide'));

			setTimeout(BX.delegate(function() {
				BX.addClass(loader, this.parent.settings.get('classLoaderShow'));
			}, this), 0);
		},

		hide: function()
		{
			var loader = this.getContainer();
			this.adjustLoaderOffset();
			BX.removeClass(loader, this.parent.settings.get('classLoaderShow'));
			BX.addClass(loader, this.parent.settings.get('classLoaderHide'));
		},

		_onAnimationEnd: function(event)
		{
			if ('animationName' in event &&
				event.animationName &&
				event.animationName === this.parent.settings.get('loaderHideAnimationName'))
			{
				var loader = this.getContainer();
				BX.removeClass(loader, this.parent.settings.get('classLoaderShow'));
				BX.removeClass(loader, this.parent.settings.get('classLoaderHide'));
				BX.style(loader, 'display', '');
			}
		}
	};
})();