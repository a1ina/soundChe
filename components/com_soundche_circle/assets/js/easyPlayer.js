/*==================================*\
||  Автор кода — Сергей Мосцевенко  ||
||  f-ph.ru                         ||
||                                  ||
||  Код распространяется бесплатно  ||
\*==================================*/




function easyPlayerManager() {
	var prot = this;
	var tasks = new Array();
	var isPlayerManagerLoaded = false;
	var players = new Array();
	var playerCurrent = false;
	var fps = 20;

	var playerManager = new playerFlash(function() {
		prot.isPlayerManagerLoaded = true;
		
		for(var i in tasks)
			tasks[i].createHooks();
		
		playerManager.onId3Load = function(data) {
			if(players[playerCurrent])
				if(players[playerCurrent].getId3Title)
					if(data.artist || data.songName)
						players[playerCurrent].setTitle((data.artist ? data.artist + '</b> – ' : '') + (data.songName ? data.songName : 'Unknown song name'));
		}
		
		playerManager.onFileLoad = function() {
			if(players[playerCurrent])
				players[playerCurrent].loaded();
		}
		
		playerManager.onFileFail = function() {
			if(players[playerCurrent])
				players[playerCurrent].failed();
		}
		
		playerManager.onSoundComplete = function() {
			if(players[playerCurrent])
				players[playerCurrent].soundComplete();
		}
	}, 'http://f-ph.ru/swf/player.swf');
	
	this.addPlayer = function(set) {
		if(set.url)
			players[players.length] = new player(set, players.length);
	};
	
	function player(set, id) {
		var prot1 = this;
		var isCurrent = false;
		var isLoading = false;
		var isLoadingFull = false;
		var isPlaying = false;
		var obj = new Array();
		var timelineWidth, timelineSliderWidth;
		var volumeWidth, volumeSliderWidth;
		var volume = set.volume ? set.volume : 1;
		if(volume < 0)
			volume = 0;
		if(volume > 1)
			volume = 1;
		var position = 0;
		this.getId3Title = set.getId3Title ? true : false;
		var reloadInterval = false;
		var willPlay;
		var isPositionClick = false;
		
		this.createBase = function() {
			var isCreateHolder = true;
			if(set.box) {
				if(typeof(set.box) == 'string') {
					if(document.getElementById(set.box)) {
						isCreateHolder = false;
						obj['holder'] = document.getElementById(set.box);
					}
				} else if(typeof(set.box) == 'object') {
					if(set.box.innerHTML != undefined) {
						isCreateHolder = false;
						obj['holder'] = set.box;
					}
				}
			}
			if(isCreateHolder) {
				var i = 0;
				do ++i; while(document.getElementById('playerHolder_' + i));
				document.write('<div id="playerHolder_' + i + '"></div>');
				obj['holder'] = document.getElementById('playerHolder_' + i);
			}
			obj['box'] = createAndAppend('div', obj['holder'], set.cssClass);
			obj['playPauseBox'] = createAndAppend('div', obj['box'], 'playPauseBox');
			obj['playPause'] = createAndAppend('div', obj['playPauseBox'], 'playPause play');
			obj['playPause'].style.cursor = 'pointer';
			if(set.stopButton) {
				obj['stopBox'] = createAndAppend('div', obj['box'], 'stopBox');
				obj['stop'] = createAndAppend('div', obj['stopBox'], 'stop');
				obj['stop'].style.cursor = 'pointer';
			}
			obj['titleBox'] = createAndAppend('div', obj['box'], 'titleBox');
			obj['title'] = createAndAppend('div', obj['titleBox'], 'title');
			obj['title'].style.overflow = 'hidden';
			obj['titleText'] = createAndAppend('div', obj['title']);
			obj['titleText'].style.whiteSpace = 'nowrap';
			obj['timelineBox'] = createAndAppend('div', obj['box'], 'timelineBox');
			obj['timelineBackground'] = createAndAppend('div', obj['timelineBox'], 'timelineBackground');
			timelineWidth = obj['timelineBackground'].clientWidth;
			obj['timelineBackground'].style.position = 'relative';
			obj['timelineBackground'].style.cursor = 'pointer';
			obj['timelineLoad'] = createAndAppend('div', obj['timelineBackground'], 'timelineLoad');
			obj['timelinePlay'] = createAndAppend('div', obj['timelineBackground'], 'timelinePlay');
			obj['timelineLoad'].style.position = obj['timelinePlay'].style.position = 'absolute';
			obj['timelineLoad'].style.top = obj['timelinePlay'].style.top = 0;
			obj['timelineLoad'].style.left = obj['timelinePlay'].style.left = 0;
			obj['timelineLoad'].style.width = obj['timelinePlay'].style.width = 0;
			obj['timelineSlider'] = createAndAppend('div', obj['timelineBackground'], 'timelineSlider');
			obj['timelineSlider'].style.display = 'block';
			timelineSliderWidth = obj['timelineSlider'].clientWidth;
			obj['timelineSlider'].style.display = '';
			obj['timelineSlider'].style.position = 'absolute';
			obj['timelineSlider'].style.left = - timelineSliderWidth * 0.5 + 'px';
			obj['timeBox'] = createAndAppend('div', obj['box'], 'timeBox');
			obj['time'] = createAndAppend('div', obj['timeBox'], 'time');
			obj['time'].style.whiteSpace = 'nowrap';
			obj['time'].innerHTML = '0:00 / 0:00';
			obj['volumeBox'] = createAndAppend('div', obj['box'], 'volumeBox');
			obj['volumeBackground'] = createAndAppend('div', obj['volumeBox'], 'volumeBackground');
			volumeWidth = obj['volumeBackground'].clientWidth;
			obj['volumeBackground'].style.position = 'relative';
			obj['volumeBackground'].style.cursor = 'pointer';
			obj['volumeCurrent'] = createAndAppend('div', obj['volumeBackground'], 'volumeCurrent');
			obj['volumeCurrent'].style.position = 'absolute';
			obj['volumeCurrent'].style.top = 0;
			obj['volumeCurrent'].style.left = 0;
			obj['volumeCurrent'].style.width = volume * volumeWidth + 'px';
			obj['volumeSlider'] = createAndAppend('div', obj['volumeBackground'], 'volumeSlider');
			obj['volumeSlider'].style.display = 'block';
			volumeSliderWidth = obj['volumeSlider'].clientWidth;
			obj['volumeSlider'].style.display = '';
			obj['volumeSlider'].style.position = 'absolute';
			obj['volumeSlider'].style.left = - volumeSliderWidth * 0.5 + volume * volumeWidth + 'px';
			prot1.setTitle(set.title);
		}
		
		this.createHooks = function() {
			hookEvent(obj['playPause'], 'mousedown', function(event) {
				if(isCurrent) {
					if(isLoading) {
						if(willPlay) {
							obj['playPause'].setAttribute('class', 'playPause play');
							obj['playPause'].setAttribute('className', 'playPause play');
							willPlay = false;
						} else {
							obj['playPause'].setAttribute('class', 'playPause pause');
							obj['playPause'].setAttribute('className', 'playPause pause');
							willPlay = true;
						}
					} else {
						if(isPlaying) {
							obj['playPause'].setAttribute('class', 'playPause play');
							obj['playPause'].setAttribute('className', 'playPause play');
							playerManager.pause();
							isPlaying = false;
							if(!isLoadingFull && reloadInterval) {
								clearInterval(reloadInterval);
								reloadInterval = false;
							}
						} else {
							obj['playPause'].setAttribute('class', 'playPause pause');
							obj['playPause'].setAttribute('className', 'playPause pause');
							playerManager.play();
							isPlaying = true;
							if(!reloadInterval)
								reloadInterval = setInterval(timelineIntervalFunction, 1000 / fps);
						}
					}
				} else {
					if(players[playerCurrent])
						players[playerCurrent].deactivate();
					playerCurrent = id;
					playerManager.setFile(set.url);
					obj['box'].setAttribute('class', set.cssClass + ' active');
					obj['box'].setAttribute('className', set.cssClass + ' active');
					obj['playPause'].setAttribute('class', 'playPause pause');
					obj['playPause'].setAttribute('className', 'playPause pause');
					isLoading = true;
					isCurrent = true;
					willPlay = true;
				}
				cancelEvent(event);
			});
			
			if(set.stopButton)
				hookEvent(obj['stop'], 'mousedown', function(event) {
					if(isCurrent) {
						if(isLoading) {
							if(willPlay) {
								obj['playPause'].setAttribute('class', 'playPause play');
								obj['playPause'].setAttribute('className', 'playPause play');
								willPlay = false;
							}
						} else {
							if(isPlaying) {
								obj['playPause'].setAttribute('class', 'playPause play');
								obj['playPause'].setAttribute('className', 'playPause play');
								playerManager.pause();
								isPlaying = false;
								if(!isLoadingFull && reloadInterval) {
									clearInterval(reloadInterval);
									reloadInterval = false;
								}
							}
							playerManager.setPosition(0);
							obj['timelinePlay'].style.width = 0;
							obj['timelineSlider'].style.left = - timelineSliderWidth * 0.5  + 'px';
							timelineIntervalFunction();
						}
					}
					cancelEvent(event);
				});
			
			hookEvent(obj['timelineBackground'], 'mousedown', timelineMousedown);
			hookEvent(obj['volumeBackground'], 'mousedown', volumeMousedown);
		}
		
		this.setTitle = function(title) {
			obj['titleText'].innerHTML = title;
		}
		
		this.loaded = function() {
			isLoading = false;
			isLoadingFull = true;
			isPlaying = true;
			reloadInterval = setInterval(timelineIntervalFunction, 1000 / fps);
			if(willPlay) {
				playerManager.play();
				isPlaying = true;
			}
			playerManager.setPosition(position);
			playerManager.setVolume(volume);
		}
		
		function timelineIntervalFunction() {
			var info = playerManager.getPosition();
			if(!info)
				info = [0, 0, 0];
			if(isLoadingFull && info[2] >= 1)
				isLoadingFull = false;
			obj['timelineLoad'].style.width = Math.floor(timelineWidth * info[2]) + 'px';
			if(!isPositionClick) {
				obj['timelinePlay'].style.width = Math.floor(timelineWidth * info[1]) + 'px';
				obj['timelineSlider'].style.left = Math.floor(timelineWidth * info[1] - timelineSliderWidth * 0.5)  + 'px';
			}
			var minutes = Math.floor(info[0] / 60000);
			var seconds = Math.floor(info[0] / 1000) % 60;
			var timePassed = info[0] * info[1];
			var minutesPassed = Math.floor(timePassed / 60000);
			var secondsPassed = Math.floor(timePassed / 1000) % 60;
			obj['time'].innerHTML = minutesPassed + ':' + (secondsPassed < 10 ? '0' : '') + secondsPassed + ' / ' + minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
			if(!isLoadingFull && !isPlaying) {
				clearInterval(reloadInterval);
				reloadInterval = false;
			}
		}
		
		function timelineMousedown(event) {
			isPositionClick = true;
			hookEvent(window, 'mousemove', timelineMousemove);
			hookEvent(window, 'mouseup', timelineMouseup);
			cancelEvent(event);
		}
		
		function timelineMousemove(event) {
			var x = event.clientX - getAbsolutePosition(obj['timelineBackground']).x + getClientSLeft();
			if(x < 0)
				x = 0;
			if(x > timelineWidth)
				x = timelineWidth;
			obj['timelinePlay'].style.width = x + 'px';
			obj['timelineSlider'].style.left = x - timelineSliderWidth * 0.5  + 'px';
			cancelEvent(event);
		}
		
		function timelineMouseup(event) {
			var x = event.clientX - getAbsolutePosition(obj['timelineBackground']).x + getClientSLeft();
			if(x < 0)
				x = 0;
			if(x > timelineWidth)
				x = timelineWidth;
			position = x / timelineWidth;
			obj['timelinePlay'].style.width = x + 'px';
			obj['timelineSlider'].style.left = x - timelineSliderWidth * 0.5  + 'px';
			if(isCurrent && !isLoading)
				playerManager.setPosition(position);
			isPositionClick = false;
			unhookEvent(window, 'mousemove', timelineMousemove);
			unhookEvent(window, 'mouseup', timelineMouseup);
			cancelEvent(event);
		}
		
		function volumeMousedown(event) {
			volumeEvent(event);
			hookEvent(window, 'mousemove', volumeMousemove);
			hookEvent(window, 'mouseup', volumeMouseup);
			cancelEvent(event);
		}
		
		function volumeMousemove(event) {
			volumeEvent(event);
			cancelEvent(event);
		}
		
		function volumeMouseup(event) {
			unhookEvent(window, 'mousemove', volumeMousemove);
			unhookEvent(window, 'mouseup', volumeMouseup);
			cancelEvent(event);
		}
		
		function volumeEvent(event) {
			var x = event.clientX - getAbsolutePosition(obj['volumeBackground']).x + getClientSLeft();
			if(x < 0)
				x = 0;
			if(x > volumeWidth)
				x = volumeWidth;
			volume = x / volumeWidth;
			obj['volumeCurrent'].style.width = x + 'px';
			obj['volumeSlider'].style.left = x - volumeSliderWidth * 0.5  + 'px';
			if(isCurrent && !isLoading)
				playerManager.setVolume(volume);
		}
		
		this.failed = function() {
			prot1.setTitle('Loading failed');
			obj['playPause'].setAttribute('class', 'playPause play');
			obj['playPause'].setAttribute('className', 'playPause play');
			isLoading = false;
			isLoadingFull = false;
		}
		
		this.soundComplete = function() {
			obj['playPause'].setAttribute('class', 'playPause play');
			obj['playPause'].setAttribute('className', 'playPause play');
			playerManager.pause();
			isPlaying = false;
		}
		
		this.deactivate = function() {
			obj['box'].setAttribute('class', set.cssClass);
			obj['box'].setAttribute('className', set.cssClass);
			if(reloadInterval) {
				clearInterval(reloadInterval);
				reloadInterval = false;
			}
			isLoading = false;
			isLoadingFull = false;
			isCurrent = false;
			if(isPlaying) {
				isPlaying = false;
				playerManager.pause();
				obj['playPause'].setAttribute('class', 'playPause play');
				obj['playPause'].setAttribute('className', 'playPause play');
			}
			obj['timelineLoad'].style.width = 0;
			obj['timelinePlay'].style.width = 0;
			obj['timelineSlider'].style.left = - timelineSliderWidth * 0.5  + 'px';
		}
		
		this.createBase();
		if(prot.isPlayerManagerLoaded)
			this.createHooks();
		else
			tasks[tasks.length] = this;
	}
};