/*==================================*\
||  Автор кода — Сергей Мосцевенко  ||
||  f-ph.ru                         ||
||                                  ||
||  Код распространяется бесплатно  ||
\*==================================*/




// Свойства объектов
function mousePos(event) {
	event = event || window.event;
	if(event.clientX)
		return new Array(event.clientX, event.clientY);
	else if(event.screenX)
		return new Array(event.screenX, event.screenY);
	else if(event.pageX)
		return new Array(event.pageX, event.pageY);
	else
		return new Array(0, 0);
}
function getAbsolutePosition(el) {
	var r = {
		x: el.offsetLeft,
		y: el.offsetTop
	};
	if (el.offsetParent) {
		var tmp = getAbsolutePosition(el.offsetParent);
		r.x += tmp.x;
		r.y += tmp.y;
	}
	return r;
}
function getStyle(elem, name) {
	if(elem.style[name])
		return elem.style[name];
	else
		if(elem.currentStyle)
			return elem.currentStyle[name];
		else
			if(document.defaultView && document.defaultView.getComputedStyle) {
				name = name.replace(/([A-Z])/g,"-$1");
				name = name.toLowerCase();
				var s = document.defaultView.getComputedStyle(elem,"");
				return s && s.getPropertyValue(name);
			} else
				return null;
}
function getClientWidth() {
	return document.compatMode=='CSS1Compat' && !window.opera?document.documentElement.clientWidth:document.body.clientWidth;
}
function getClientHeight() {
	return document.compatMode=='CSS1Compat' && !window.opera?document.documentElement.clientHeight:document.body.clientHeight;
}
function getClientSTop() {
	return document.documentElement.scrollTop || document.body.scrollTop;
}
function getClientSLeft() {
	return document.documentElement.scrollLeft || document.body.scrollLeft;
}


// Ajax
function ajax(url, post, onload, onerror) {
	var xml = new XMLHttpRequest() || new ActiveXObject('Msxml2.XMLHTTP') || new ActiveXObject('Microsoft.XMLHTTP') || null;
	var isCancelled = false;
	this.cancel = function() {
		isCancelled = true;
	}
	if(xml === null) {
		if(!isCancelled && onerror)
			onerror();
	} else {
		var postText = '';
		var i = 0;
		for(var j in post)
			postText += (i++ == 0 ? '' : '&') + j + '=' + encodeURIComponent(post[j]);
		xml.onreadystatechange = function() {
		if(xml.readyState == 4) 
			if(xml.status == 200) {
				if(!isCancelled && onload)
					onload(xml.responseText);
			} else {
				if(!isCancelled && onerror)
					onerror();
			}
		}
		xml.open("POST", url);
		xml.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xml.send(postText);
	}
}

function ajaxFrame(url, post, onload, isFull) {
	var attemps = 0;
	if(post) {
		var frameName = 'ajaxFrame' + Math.floor(Math.random() * 1000);
		var frame = createAndAppend('iframe', document.body);
		frame.style.display = 'none';
		frame.contentWindow.name = frameName;
		var form = createAndAppend('form', document.body);
		form.style.display = 'none';
		form.action = url;
		form.method = 'post';
		form.target = frameName;
		var input;
		for(var i in post) {
			input = createAndAppend('textarea', form, false, post[i]);
			input.name = i;
		}
	} else {
		var frame = document.createElement('iframe');
		frame.style.display = 'none';
		document.body.appendChild(frame);
	}
	hookEvent(frame, 'load', loaded);
	function loaded() {
		if(attemps != 0 || frame.contentDocument.body.innerHTML.length > 0) {
			if(onload)
				onload(isFull ? frame.contentDocument.documentElement.innerHTML : frame.contentDocument.body.innerHTML);
			if(post) {
				document.body.removeChild(form);
				document.body.removeChild(frame);
			} else {
				document.body.removeChild(frame);
			}
		}
		++attemps;
	}
	if(post) {
		form.submit();
	} else
		frame.src = url;
}


// Математика
function gradient(start_color, finish_color, procent) {
	procent /= 100;
	var alph = new Array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
	alph['a'] = 10; alph['b'] = 11; alph['c'] = 12; alph['d'] = 13; alph['e'] = 14; alph['f'] = 15; 
	var alph_bck = new Array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f');
	start_color = start_color.toLowerCase();
	finish_color = finish_color.toLowerCase();
	function convert_fwrd(text) {
		return alph[text.slice(0, 1)] * 16 + alph[text.slice(1, 2)] * 1;
	}
	function convert_bck(integer) {
		integer = Math.floor(integer);
		var i = integer % 16;
		return '' + alph_bck[(integer - i) / 16] + alph_bck[i];
	}
	function expl(color) {
		return Array(convert_fwrd(color.slice(0, 2)), convert_fwrd(color.slice(2, 4)), convert_fwrd(color.slice(4, 6)));
	}
	var str_clr = expl(start_color);
	var fin_clr = expl(finish_color);
	var dif_clr = new Array(fin_clr[0] - str_clr[0], fin_clr[1] - str_clr[1], fin_clr[2] - str_clr[2]);
	return '' + convert_bck(str_clr[0] + dif_clr[0] * procent) + convert_bck(str_clr[1] + dif_clr[1] * procent) + convert_bck(str_clr[2] + dif_clr[2] * procent);
}


// События
function hookEvent(elem, eventName, callback) { 
	if(typeof(elem) == 'string')
		elem = document.getElementById(elem);
	if(!elem)
		return false;
	if(elem.addEventListener) { 
		if(eventName == 'mousewheel')
			elem.addEventListener('DOMMouseScroll', callback, false);
		elem.addEventListener(eventName, callback, false); 
	} else if(elem.attachEvent)
		elem.attachEvent('on' + eventName, callback);
	else
		return false;
	return true; 
}
function unhookEvent(elem, eventName, callback) {
	if(typeof(elem) == 'string')
		elem = document.getElementById(elem);
	if(!elem)
		return false;
	if(elem.removeEventListener) { 
		if(eventName == 'mousewheel')
			elem.removeEventListener('DOMMouseScroll', callback, false);
		elem.removeEventListener(eventName, callback, false); 
	} else if(elem.detachEvent)
		elem.detachEvent('on' + eventName, callback);
	else
		return false;
	return true; 
}
function cancelEvent(e) { 
	e = e ? e : window.event; 
	if(e.stopPropagation)
		e.stopPropagation();
	if (e.preventDefault)
		e.preventDefault();
	e.cancelBubble = true; 
	e.cancel = true; 
	e.returnValue = false; 
	return false; 
}
function triggerEvent(elem, eventName, memo) {
	if(typeof(elem) == 'string')
		elem = document.getElementById(elem);
	var event;
	if(document.createEvent) {
		event = document.createEvent("HTMLEvents");
		event.initEvent(eventName, true, true);
	} else {
		event = document.createEventObject();
		event.eventType = eventName;
	}
	event.eventName = eventName;
	event.memo = memo || { };
	if(document.createEvent) {
		elem.dispatchEvent(event);
	} else {
		elem.fireEvent("on" + event.eventType, event);
	}
}
function hookOutEvent(elem, eventName, callback) {
	var	triggered = false;
	if(typeof(elem) == 'object') {
		if(!(elem instanceof Array)) elem = [elem];
	} else {
		elem = [];
	}
	for(var i in elem)
		hookEvent(elem[i], eventName, function() {
			triggered = true;
		});
	hookEvent(window, eventName, function(event) {
		if(!triggered) {
			callback(event);
		}
		triggered = false;
	});
}


// Работа с плеером
var players = new Array();
var playerAmount = 0;

function playerFlashManager(id, status, value) {
	switch(status) {
		case 'ready':
			players[id].flashOnReady();
			break;
		case 'fileLoaded':
			players[id].flashOnFileLoaded();
			break;
		case 'fileFailed':
			players[id].flashOnFileFailed();
			break;
		case 'soundComplete':
			players[id].flashOnSoundComplete();
			break;
		case 'id3Loaded':
			players[id].flashOnId3Loaded(value);
			break;
		case 'alert':
			alert(value);
			break;
	}
}

function playerFlash(onLoad, playerUrl) {
	var playerSwfUrl = playerUrl ? playerUrl : 'http://f-ph.ru/swf/player.swf';
	var prot = this;
	var isFlashLoaded = false;
	var isFileLoaded = false;
	
	this.onLoad = onLoad;
	this.onFileLoad = false;
	this.onFileFail = false;
	this.onSoundComplete = false;
	this.onId3Load = false;
	
	this.id = playerAmount;
	players[playerAmount] = this;
	++playerAmount;

	var i = navigator.appVersion.indexOf('MSIE');
	if(i !== -1) {
		document.write('<object id="fphruPlayer_' + this.id + '" width="1" height="1" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab" style="position: absolute; left: -1000px;"><param name="movie" value="' + playerSwfUrl + '"><param name="allowScriptAccess" value="always"/><param name="FlashVars" value="player_id=' + this.id + '"/><embed src="' + playerSwfUrl + '?player_id=' + this.id + '" name="fphruPlayer_' + this.id + '" allowscriptaccess="always" swliveconnect="true" width="1" height="1" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"></embed></object>');
		var objEmbed = (navigator.appVersion.slice(i + 5, navigator.appVersion.indexOf('.', i + 5)) * 1 < 9) ? window['fphruPlayer_' + this.id] : window['fphruPlayer_' + this.id][0];
	} else {
		var objObject = createAndAppend('object', document.body, false, false, {
			id: 'fphruPlayer_' + this.id,
			width: 1,
			height: 1,
			data: '',
			classid: 'clsid:D27CDB6E-AE6D-11cf-96B8-444553540000',
			codebase: 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab'
		}, {
			position: 'absolute',
			left: '-1000px'
		});
		var objParam = createAndAppend('param', objObject, false, false, {
			name: 'movie',
			value: playerSwfUrl
		});

		objParam = createAndAppend('param', objObject, false, false, {
			name: 'allowScriptAccess',
			value: 'always'
		});

		objParam = createAndAppend('param', objObject, false, false, {
			name: 'FlashVars',
			value: 'player_id=' + this.id
		});

		var objEmbed = createAndAppend('embed', objObject, false, false, {
			src: playerSwfUrl + '?player_id=' + this.id,
			swliveconnect: 'true',
			name: 'fphruPlayer_' + this.id,
			allowScriptAccess: 'always',
			width: 1,
			height: 1,
			type: 'application/x-shockwave-flash',
			pluginspage: 'http://www.macromedia.com/go/getflashplayer'
		});
	}
	
	var isPlaying = false;
	
	this.flashOnReady = function() {
		isFlashLoaded = true;
		if(prot.onLoad)
			prot.onLoad();
	}
	
	this.play = function() {
		if(isFlashLoaded && isFileLoaded) {
			if(!isPlaying) {
				objEmbed.jsPlay();
				isPlaying = true;
				return true;
			}
		} else
			return false;
	}
	
	this.pause = function() {
		if(isFlashLoaded && isFileLoaded) {
			if(isPlaying) {
				objEmbed.jsPause();
				isPlaying = false;
				return true;
			}
		} else
			return false;
	}
	
	this.setVolume = function(volume) {
		if(isFlashLoaded) {
			if(volume < 0)
				volume = 0;
			else if(volume > 1)
				volume = 1;
			objEmbed.jsSetVolume(volume);
			return true;
		} else
			return false;
	}
	
	this.setFile = function(url) {
		if(isFlashLoaded) {
			isPlaying = false;
			isFileLoaded = false;
			objEmbed.jsSetFile(url);
			return true;
		} else
			return false;
	}
	
	this.flashOnFileLoaded = function() {
		isFileLoaded = true;
		if(prot.onFileLoad)
			prot.onFileLoad();
	}
	
	this.flashOnFileFailed = function() {
		isFileLoaded = false;
		if(prot.onFileFail)
			prot.onFileFail();
	}
	
	this.getPosition = function() {
		if(isFlashLoaded && isFileLoaded) {
			return objEmbed.jsGetPosition();
		} else
			return false;
	}
	
	this.flashOnSoundComplete = function() {
		isPlaying = false;
		if(prot.onSoundComplete)
			prot.onSoundComplete();
	}
	
	this.flashOnId3Loaded = function(values) {
		valuesN = new Array();
		valuesN['artist'] = values[0];
		valuesN['songName'] = values[1];
		valuesN['album'] = values[2];
		if(prot.onId3Load)
			prot.onId3Load(valuesN);
	}
	
	this.setPosition = function(position) {
		if(position < 0)
			position = 0;
		else if(position > 1)
			position = 1;
		objEmbed.jsSetPosition(position);
	}
}


// Fullscreen
var fullscreen = (function() {
	var protFs = this;

	var keyboardAllowed = typeof Element !== 'undefined' && 'ALLOW_KEYBOARD_INPUT' in Element;

	var propsMap = new Array(
		Array(
			'requestFullscreen',
			'webkitRequestFullScreen',
			'mozRequestFullScreen'
		),
		Array(
			'exitFullscreen',
			'webkitCancelFullScreen',
			'mozCancelFullScreen'
		),
		Array(
			'fullscreenchange',
			'webkitIsFullScreen',
			'mozfullscreenchange'
		),
		Array(
			'fullscreen',
			'webkitRequestFullScreen',
			'mozFullScreen'
		),
		Array(
			'fullscreenElement',
			'webkitCurrentFullScreenElement',
			'mozFullScreenElement'
		),
		Array(
			'fullscreenerror',
			'webkitfullscreenerror',
			'mozfullscreenerror'
		)
	);
	var i, j, l, l1, props = {};

	for(j = 0, l = propsMap.length, l1 = propsMap[0].length; j < l1; ++j)
		if(propsMap[1][j] in document)
			for(i = 0; i < l; ++i)
				props[propsMap[i][0]] = propsMap[i][j];

	this.isFullscreen = document[props.fullscreen];
	this.element = document[props.fullscreenElement];

	this.set = function(elem) {
		elem = elem ? elem : document.documentElement;
		elem[props.requestFullscreen](keyboardAllowed && Element.ALLOW_KEYBOARD_INPUT);
		 if(!document.isFullscreen )
			 elem[props.requestFullscreen]();
	};

	this.exit = function() {
		document[props.exitFullscreen]();
	};

	this.onChange = false;

	this.onError = false;

	if(document.addEventListener) {
		document.addEventListener(props.fullscreenchange, function(event) {
			protFs.isFullscreen = document[props.fullscreen];
			protFs.element = document[props.fullscreenElement];
			if(protFs.onChange)
				protFs.onChange(protFs, event);
		});

		document.addEventListener(props.fullscreenerror, function(event) {
			if(protFs.onError)
				protFs.onError(protFs, event);
		});
	}

	return this;
})();

function fs() {
	fullscreen.set();
}


// Хитрости
function savesel(doc) {
	if(document.selection)
		doc.sel = document.selection.createRange().duplicate();
}
function notab(textarea) {
	function act(event) {
		if(event.keyCode == 9) {
			var start = textarea.selectionStart;
			var end = textarea.selectionEnd;
			var text = textarea.value;
			textarea.value = text.slice(0, start) + "\t" + text.slice(end);
			textarea.selectionStart = start + 1;
			textarea.selectionEnd = start + 1;
			cancelEvent(event);
		}
	}
	hookEvent(textarea, 'keydown', act);
}
function inputCounter(input, max, changeFunc) {
	var length;
	function change(event) {
		length = input.value.length;
		if(length > max) {
			length = max;
			input.value = input.value.slice(0, max);
		}
		changeFunc(max - length);
	}
	hookEvent(input, 'keydown', change);
	hookEvent(input, 'keyup', change);
	hookEvent(input, 'paste', change);
	hookEvent(input, 'click', change);
}
function createAndAppend(type, parent, cssClass, inner, attributes, cssStyles) {
	var element = document.createElement(type);
	if(cssClass) {
		element.setAttribute('class', cssClass);
		element.setAttribute('className', cssClass);
	}
	if(inner)
		element.innerHTML = inner;
	for(var i in attributes)
		element.setAttribute(i, attributes[i]);
	for(var i in cssStyles)
		element.style[i] = cssStyles[i];''
	if(parent)
		parent.appendChild(element);
	return element;
}