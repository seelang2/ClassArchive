/***********************************************************************
general_lib.js - General JavaScript function Library v1.0
Modular Backend System Version: 1.0
Copyright (c) 2007 Chris Langtiw
Last Revision Date: 10/08/2007 Chris Langtiw

***********************************************************************/
function getTargetElem(e) {
	// find out who triggered the event
	if (e.target) targ = e.target;
	else if (e.srcElement) targ = e.srcElement;
	
	// Safari has a bug where it returns a textnode instead of element
	if (targ.nodeType == 3)
		targ = targ.parentNode;
	
//	alert(targ.nodeName + ' ' + targ.id);
	return targ;
}

function centerElement(targetElement) {
	alert('width: '+targetElement.offsetWidth + ' height: ' + targetElement.offsetHeight);
//	targetElement.style.top = (getViewportHeight() / 2) - (targetElement.offsetHeight / 2) + 'px';
//	targetElement.style.left = (getViewportWidth() / 2) - (targetElement.offsetWidth / 2) + 'px';
//	var targetRect = getRect(targetElement);
	
}

function getViewportHeight() {
  if( typeof( window.innerWidth ) == 'number' ) {
    //Non-IE
    return window.innerHeight;
  } else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
    //IE 6+ in 'standards compliant mode'
    return document.documentElement.clientHeight;
  } else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
    //IE 4 compatible
    return document.body.clientHeight;
  }

}

function getViewportWidth() {
  if( typeof( window.innerWidth ) == 'number' ) {
    //Non-IE
    return window.innerWidth;
  } else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
    //IE 6+ in 'standards compliant mode'
    return document.documentElement.clientWidth;
  } else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
    //IE 4 compatible
    return document.body.clientWidth;
  }

}

function getMouseXY(e) {
	if (!e) var e = window.event;
	if (document.all) {
		tempX = e.clientX + document.body.scrollLeft;
		tempY = e.clientY + document.body.scrollTop;
	} else {
		tempX = e.pageX;
		tempY = e.pageY;
	}
	if (tempX < 0){ tempX = 0; }
	if (tempY < 0){ tempY = 0; }
	//alert('X: ' + tempX + ' y: ' + tempY);
	
	var temppos = new Array();
	temppos[0] = tempX;
	temppos[1] = tempY;
	
	return temppos;
}

// shortcut wrapper
function $(id) {
    return document.getElementById(id);
}

// returns mouse coordinates as an object with x and y properties
function getMouseCoords(ev) { 
	if (ev.pageX || ev.pageY) { 
		return {x:ev.pageX, y:ev.pageY}; 
	} 
	return { 
		x:ev.clientX + document.body.scrollLeft - document.body.clientLeft, 
		y:ev.clientY + document.body.scrollTop  - document.body.clientTop 
	}; 
} 

function getMouseOffset(target, ev) { 
	ev = ev || window.event; 
 
	var docPos    = getPosition(target); 
	var mousePos  = getMouseCoords(ev); 
	return {x:mousePos.x - docPos.x, y:mousePos.y - docPos.y}; 
} 

function getPosition(e) { 
	var left = 0; 
	var top  = 0; 
 
	while (e.offsetParent) { 
		left += e.offsetLeft; 
		top  += e.offsetTop; 
		e     = e.offsetParent; 
	} 
 
	left += e.offsetLeft; 
	top  += e.offsetTop; 
 
	return {x:left, y:top}; 
} 

function getRect(obj) {
	//if (typeof(obj.getBoundingClientRect) == 'function') {
	//	return obj.getBoundingClientRect();
	//} else {
		var tmp = getPosition(obj);
		return {
			top:tmp.y, 
			left:tmp.x, 
			//bottom:tmp.y + this.getElementHeight(), 
			bottom:tmp.y + obj.offsetHeight,
			//right:tmp.x + this.getElementWidth(), 
			right:tmp.x + obj.offsetWidth,
			//width:this.getElementWidth(), 
			width:obj.offsetWidth,
			//height:this.getElementHeight()
			height:obj.offsetHeight
			}
	//}
}


// used to combat IE memory leaks
// call this before deleting elements (including through innerHTML)
// http://javascript.crockford.com/memory/leak.html
function purge(d) {
	var a = d.attributes, i, l, n;    
	if (a) {
		l = a.length;
		for (i = 0; i < l; i += 1) {
			n = a[i].name;
			if (typeof d[n] === 'function') {
				d[n] = null;
			}
		}
	}
	a = d.childNodes;
	if (a) {
		l = a.length;
		for (i = 0; i < l; i += 1) {
			purge(d.childNodes[i]);
		}
	}
}

// define opacity handler singleton class
// to use, first call setAlpha to initialize element
// then set opacity with setOpacity
var OpacElem = new function() {
  this.setOpacity = function(targetElement, level) {
    var decOpac = level / 100;
    if (document.all && typeof window.opera == 'undefined') {
      targetElement.filters.alpha.opacity = level;
    }
    else {
      targetElement.style.MozOpacity = decOpac;
    }
    targetElement.style.opacity = decOpac;
  };

  this.setAlpha = function(selectorText) {
    var self = OpacElem;
    if (document.all && typeof window.opera == 'undefined') {
      var styleSheets = document.styleSheets;
      for (var i = 0; i < styleSheets.length; i++) {
        var rules = styleSheets[i].rules;
        for (var j = 0; j < rules.length; j++) {
          if (rules[j].selectorText == selectorText) {
            rules[j].style.filter = 'alpha(opacity = 100)';
            return true;
          }
        }
      }
    }
    return false;
  };
};

// class to handle opacity fading
var OpacFader = new function() {
	this.div = null;
	this.start = 0;
	this.end = 0;
	this.current = 0;
	this.step = 10;
	this.procInterval = null;
	this.callfn = null;
	
	this.initFade = function(target, startOp, endOp, step, delay) {
		this.div = target;
		this.start = startOp;
		this.end = endOp;
		this.step = step;
		this.delay = delay;
	};
	
	this.setCallback = function(target) {
		this.callfn = target;
	};
	
	this.startFade = function() {
		OpacFader.current = OpacFader.start;
		OpacElem.setOpacity(OpacFader.div, OpacFader.current);
		OpacFader.procInterval = setInterval(OpacFader.doFade, OpacFader.delay);
	};
	
	this.doFade = function() {
		if (OpacFader.current == OpacFader.end) {
			clearInterval(OpacFader.procInterval);
			if (OpacFader.callfn != null) OpacFader.callfn();
		}
		if (OpacFader.start > OpacFader.end) {
			OpacFader.current = OpacFader.current - OpacFader.step;
			if (OpacFader.current < OpacFader.end) OpacFader.current = OpacFader.end;
		} else {
			OpacFader.current = OpacFader.current + OpacFader.step;
			if (OpacFader.current > OpacFader.end) OpacFader.current = OpacFader.end;
		}
		OpacElem.setOpacity(OpacFader.div, OpacFader.current);
	};
}