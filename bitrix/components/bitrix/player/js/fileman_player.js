;(function(){

BX.namespace('BX.Fileman');

if(window.BX.Fileman.PlayerManager)
{
	return;
}

BX.Fileman.PlayerManager = {
	isStarted: false,
	players: [],
	playing: false,
	addPlayer: function(player)
	{
		this.players.push(player);

		BX.bind(BX(player.id), 'click', BX.proxy(player.onClick, player));
		BX.bind(BX(player.id), 'keydown', BX.proxy(player.onKeyDown, player));

		if(player.autostart || player.lazyload)
		{
			this.init();
		}
	},
	init: function()
	{
		if(this.isStarted)
		{
			return;
		}

		this.isStarted = true;

		BX.ready(function () {
			BX.bind(window, 'scroll', BX.throttle(BX.Fileman.PlayerManager.onScroll, 300, BX.Fileman.PlayerManager));
		});

		BX.Fileman.PlayerManager.onScroll();
	},
	onScroll: function()
	{
		if(this.players.length == 0)
		{
			return;
		}

		var topVisiblePlayer = false;
		var isAnyPlaying = false;

		for(var i in this.players)
		{
			var player = this.players[i];

			if(!BX(player.id))
			{
				this.players.splice(i, 1);
				continue;
			}

			if(player.lazyload && !player.inited)
			{
				if(this.isVisibleOnScreen(player.id, 2))
				{
					player.init();
				}
			}

			if(!player.autostart)
			{
				continue;
			}

			if(player.active)
			{
				continue;
			}

			if(player.isEnded())
			{
				continue;
			}

			if(this.isVisibleOnScreen(player.id, 1))
			{
				if(topVisiblePlayer === false)
				{
					topVisiblePlayer = player;
				}
			}
			else
			{
				if(player.isPlaying())
				{
					player.pause();
				}
			}

			if(player.isPlaying())
			{
				isAnyPlaying = true;
			}
		}

		if(isAnyPlaying)
		{
			return;
		}

		if(topVisiblePlayer !== false)
		{
			if(!topVisiblePlayer.inited)
			{
				topVisiblePlayer.autostart = true;
			}
			else if(topVisiblePlayer.isReady() && !topVisiblePlayer.isEnded())
			{
				topVisiblePlayer.play();
			}
		}
	},
	getElementCoords: function(id)
	{
		var VISIBLE_OFFSET = 0.25;

		var box = BX(id).getBoundingClientRect();

		var elementHeight = box.bottom - box.top;
		var top = box.top + VISIBLE_OFFSET * elementHeight;
		var bottom = box.bottom - VISIBLE_OFFSET * elementHeight;

		var elementWidth = box.right - box.left;
		var left = box.left + VISIBLE_OFFSET * elementWidth;
		var right = box.right - VISIBLE_OFFSET * elementWidth;

		coords = {
			top: top + window.pageYOffset,
			bottom: bottom + window.pageYOffset,
			left: left + window.pageXOffset,
			right: right + window.pageXOffset,
			originTop: top,
			originLeft: left,
			originBottom: bottom,
			originRight: right
		};

		return coords;
	},
	isVisibleOnScreen: function (id, screens)
	{
		var onScreen,
			visible = false;

		var coords = this.getElementCoords(id);
		var clientHeight = document.documentElement.clientHeight;

		var windowTop = window.pageYOffset || document.documentElement.scrollTop;
		var windowBottom = windowTop + clientHeight;

		if(screens)
		{
			screens = parseInt(screens);
		}
		if(screens > 1)
		{
			windowTop -= clientHeight * (screens - 1);
			windowBottom += clientHeight * (screens - 1);
		}
		var topVisible = coords.top > windowTop && coords.top < windowBottom;
		var bottomVisible = coords.bottom < windowBottom && coords.bottom > windowTop;

		onScreen = topVisible || bottomVisible;

		if(onScreen && screens > 1)
		{
			return true;
		}

		if(!onScreen)
		{
			return false;
		}

		var playerElement = BX(id);
		var playerCenterX = coords.originLeft + (coords.originRight - coords.originLeft) / 2;
		var playerCenterY = coords.originTop + (coords.originBottom - coords.originTop) / 2 + 20;

		var currentPlayerCenterElement = document.elementFromPoint(playerCenterX, playerCenterY);

		if(!!currentPlayerCenterElement)
		{
			if(currentPlayerCenterElement === playerElement ||
				currentPlayerCenterElement.parentNode === playerElement ||
				currentPlayerCenterElement.parentNode.parentNode === playerElement)
			{
				visible = true;
			}
		}

		return (onScreen && visible);
	},
	getPlayerById: function(id)
	{
		if(!id)
		{
			return null;
		}
		for(var i in this.players)
		{
			if(this.players[i].id == id)
			{
				return this.players[i];
			}
		}

		return null;
	}
};

BX.Fileman.Player = function(id, params)
{
	this.inited = false;
	this.isStarted = false;
	this.active = false;
	this.id = id;
	this.fillParameters(params);
	BX.Fileman.PlayerManager.addPlayer(this);
};

BX.Fileman.Player.prototype.onClick = function()
{
	var playButton = BX.findChildByClassName(this.getElement(), 'vjs-play-control');
	if(playButton)
	{
		playButton.focus();
	}
	this.active = true;
};

BX.Fileman.Player.prototype.isPlaying = function()
{
	if(this.vjsPlayer)
	{
		return (this.vjsPlayer.isReady_ && !this.vjsPlayer.paused());
	}
	return false;
};

BX.Fileman.Player.prototype.pause = function()
{
	try
	{
		this.vjsPlayer.pause();
	}
	catch(e) {}
};

BX.Fileman.Player.prototype.isEnded = function()
{
	if(this.vjsPlayer)
	{
		return this.vjsPlayer.ended();
	}
	return false;
};

BX.Fileman.Player.prototype.isReady = function()
{
	return this.vjsPlayer.isReady_;
};

BX.Fileman.Player.prototype.play = function()
{
	try
	{
		this.vjsPlayer.play();
	}
	catch(e) {}
};

BX.Fileman.Player.prototype.adjust = function()
{
	var containerWidth = BX.width(BX(this.id).parentNode);
	if(!this.vjsPlayer)
	{
		return;
	}
	if(this.vjsPlayer.videoWidth() == 0 || this.vjsPlayer.videoHeight() == 0)
	{
		return;
	}
	if(this.vjsPlayer.videoWidth() < containerWidth)
	{
		this.vjsPlayer.width(this.vjsPlayer.videoWidth());
		this.vjsPlayer.height(this.vjsPlayer.videoHeight());
		this.vjsPlayer.fluid(false);
		if(!BX(this.id + '_container'))
		{
			var container = BX.create('div', {
				'attrs': {'id': this.id + '_container'},
				'props': {
					'className': 'videojs-player-container'
				}
			});
			BX.insertAfter(container, BX(this.id));
			BX.append(BX(this.id), container);
			BX.addClass(BX(this.id), 'videojs-adjusted');
		}
	}
	else
	{
		this.vjsPlayer.fluid(true);
	}
};

BX.Fileman.Player.prototype.getElement = function()
{
	return BX(this.id);
};

BX.Fileman.Player.prototype.createElement = function()
{
	var node = this.getElement();
	if(node)
	{
		return node;
	}
	if(!this.id)
	{
		return null;
	}
	var tagName = 'video';
	if(this.isAudio)
	{
		tagName = 'audio';
	}
	var className = 'video-js vjs-big-play-centered';
	if(this.skin)
	{
		className += ' ' + this.skin;
	}
	var attrs = {
		'id': this.id,
		'className': className,
		'width': this.width,
		'height': this.height
	};
	if(this.muted)
	{
		attrs['muted'] = true;
	}
	node = BX.create(tagName, {
		'attrs': attrs
	});
	/*if(this.tracks)
	{
		if(BX.type.isArray(this.tracks))
		{
			for(var i in this.tracks)
			{
				if(!this.tracks[i].path || !this.tracks[i].type)
				{
					continue;
				}
				var source = BX.create('source', {
					'attrs': {
						'src': this.tracks[i].path,
						'type': this.tracks[i].type
					}
				});
				BX.append(source, node);
			}
		}
	}*/
	return node;
};

BX.Fileman.Player.prototype.fillParameters = function(params)
{
	this.autostart = params.autostart || false;
	this.width = params.width || 400;
	this.height = params.height || 300;
	this.hasFlash = params.hasFlash || false;
	if(params.playbackRate && !params.hasFlash)
	{
		params.playbackRate = parseInt(params.playbackRate);
		if(params.playbackRate != 1)
		{
			if(params.playbackRate <= 0)
			{
				params.playbackRate = 1;
			}
			if(params.playbackRate > 3)
			{
				params.playbackRate = 3;
			}
		}
		if(params.playbackRate != 1)
		{
			this.playbackRate = params.playbackRate;
		}
	}
	this.volume = params.volume || 0.8;
	this.playlistParams = params.playlistParams;
	this.startTime = params.startTime || 0;
	this.wmvConfig = params.wmvConfig;
	this.onInit = params.onInit;
	this.isAdjust = params.isAdjust || false;
	this.lazyload = params.lazyload;
	this.params = params;
};

BX.Fileman.Player.prototype.onKeyDown = function(event)
{
	if(event.which == 32)
	{
		this.onClick();
		if(this.isPlaying())
		{
			this.pause();
		}
		else
		{
			this.play();
		}
		event.preventDefault();
		event.stopPropagation();
		return false;
	}
};

BX.Fileman.Player.prototype.setSource = function(source)
{
	if(!source)
	{
		return false;
	}
	this.vjsPlayer.src(source);
};

BX.Fileman.Player.prototype.getSource = function()
{
	return this.vjsPlayer.src();
};

BX.Fileman.Player.prototype.init = function()
{
	if(videojs.players[this.id])
	{
		delete videojs.players[this.id];
	}
	this.vjsPlayer = videojs(this.id, this.params);
	if(this.hasFlash)
	{
		this.vjsPlayer.setTimeout(function()
		{
			if(!this.hasStarted())
			{
				this.error(BX.message('PLAYER_FLASH_REQUIRED'));
			}
		}, 10000);
	}
	this.vjsPlayer.ready(BX.proxy(function(){
		var playButton = BX.findChildByClassName(BX(this.id), 'vjs-play-control');
		if(playButton)
		{
			playButton.addEventListener('click', BX.proxy(this.onClick, this));
		}
		this.vjsPlayer.volume(this.volume);
		if(this.muted)
		{
			this.vjsPlayer.muted(true);
		}
		this.vjsPlayer.one('play', BX.proxy(function(){
			if(this.playbackRate != 1)
			{
				this.vjsPlayer.playbackRate(this.playbackRate);
			}
			if(this.volume)
			{
				this.vjsPlayer.volume(this.volume);
			}
			if(this.startTime > 0)
			{
				try
				{
					this.vjsPlayer.currentTime(this.startTime);
					var spinner = BX.findChild(BX(this.id),
						{
							"class" : "vjs-loading-spinner"
						},
						false
					);
					if(spinner)
					{
						spinner.remove();
					}
				}
				catch(error)
				{

				}
			}
		}, this));
		if(this.playlistParams)
		{
			this.vjsPlayer.playlist(this.playlistParams);
		}
		if(this.wmvConfig)
		{
			this.vjsPlayer.wmvConfig = this.wmvConfig;
		}
		this.inited = true;
		if(BX.type.isFunction(this.onInit))
		{
			this.onInit(this);
		}
		if(this.isAdjust)
		{
			if(this.vjsPlayer.videoWidth() == 0 || this.vjsPlayer.videoHeight() == 0)
			{
				this.vjsPlayer.one('loadedmetadata', BX.proxy(function(){
					this.adjust();
				}, this));
			}
			else
			{
				this.adjust();
			}
			this.isAdjust = false;
		}
	}, this));
}

})(window);