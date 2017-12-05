/***********************************************************************
general_lib.js - General JavaScript function Library v1.3
Copyright (c) 2007-2009 Chris Langtiw
Last Revision Date: 10/20/2009 Chris Langtiw

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

function centerElement(targetElement, width, height) {
//	alert(targetElement.offsetWidth + 'x' + targetElement.offsetHeight);
	targetElement.style.top = (getViewportHeight() / 2) - (height / 2) + 'px';
	targetElement.style.left = (getViewportWidth() / 2) - (width / 2) + 'px';
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

function CalendarObj() {
	this.myDate = new Date();
	this.months = ['January','February','March','April','May','June',
				   'July','August','September','October','November','December'];
	
	this.initDate = function(theDate) {
		// theDate is a string mm/dd/yyyy
		var dateParsed = theDate.split('/');
		this.myDate.setFullYear(dateParsed[2],dateParsed[0] - 1,dateParsed[1]);
		
	}; // initDate
	
	this.getMonthName = function(shorten) {
		var monthName = this.months[this.myDate.getMonth()];
		
		if (shorten == true) {
			return monthName.substr(0,3);
		} else {
			return monthName;
		}
	}; // getMonthName
	
	this.totalDays = function() {
		// based on code from http://javascript.about.com/library/bllday.htm
		//var dd = new Date(this.myDate.getFullYear(), this.myDate.getMonth(), 0);
		//return dd.getDate();
		month = this.myDate.getMonth();
		year = this.myDate.getFullYear();
		var m = [31,28,31,30,31,30,31,31,30,31,30,31];
		if (month != 2) return m[month];
		if (year%4 != 0) return m[1];
		if (year%100 == 0 && year%400 != 0) return m[1];
		return m[1] + 1;
	} 
	
	this.insert = function(target, mode) {
		
		var tempElem = document.createElement("TABLE");
		target.appendChild(tempElem);
		tempElem.className = 'calendar';
		
		var tBody = document.createElement("TBODY");
		tempElem.appendChild(tBody);
		
		var tempRow = document.createElement("TR");
		tBody.appendChild(tempRow);
		
		var tempElem = document.createElement("TH");
		tempRow.appendChild(tempElem);
		tempElem.colSpan = '7';
		tempElem.appendChild(document.createTextNode(this.getMonthName() + ' ' + this.myDate.getFullYear()));
		
		var tempRow = document.createElement("TR");
		tBody.appendChild(tempRow);
		
		var week = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday']
		
		for(var c = 0; c < week.length; c++) {
			switch(mode) {
				default:
				case 0: // 1st letter only
					var dayName = week[c].substr(0,1);
				break;
				case 1: // Short week name
					var dayName = week[c].substr(0,3);
				break;
				case 2: // whole name
					var dayName = week[c];
				break;
			}
			var tempElem = document.createElement("TH");
			tempRow.appendChild(tempElem);
			tempElem.appendChild(document.createTextNode(dayName));
		}
		
		var tempDate = new Date(this.myDate.getFullYear(), this.myDate.getMonth(), 1);
		var today = new Date();
		var dayNumber = 1 - tempDate.getDay();
		var totalDays = this.totalDays();
		var day = null;
		var rowNumber = 1;
		while (dayNumber <= totalDays) {
			var tempRow = document.createElement("TR");
			tBody.appendChild(tempRow);
			if (rowNumber % 2 == 0) {
				tempRow.className = 'calendar-evenrow';
			} else {
				tempRow.className = 'calendar-oddrow';
			}
			
			for (var c = 1; c < 8; c++) {
				var tempElem = document.createElement("TD");
				if (c % 2 == 0) {
					tempElem.className = 'calendar-evencol';
				} else {
					tempElem.className = 'calendar-oddcol';
				}
				if (today.getFullYear() == this.myDate.getFullYear() &&
					today.getMonth() == this.myDate.getMonth() &&
					today.getDate() == dayNumber) {
					tempElem.className = tempElem.className + ' calendar-currentday';
				}
				tempElem.id = 'calendar-day_' + dayNumber;
				tempRow.appendChild(tempElem);
				if (dayNumber < 1 || dayNumber > totalDays) {
					day = ' ';
				} else {
					day = dayNumber;
				}
				
				tempElem2 = document.createElement("SPAN");
				tempElem.appendChild(tempElem2);
				tempElem2.className = 'calendar-daynumber';
				
				tempElem2.appendChild(document.createTextNode(day));
				dayNumber++;
			}
			rowNumber++;
		}
		
		
	};
} // CalendarObj class

/* Drawer class */
function Drawer() {
	this.elem = null;
	this.currentHeight = 0;
	this.maxHeight = 0;
	this.timer = null;
	this.delay = 1;
	this.step = 10;
	this.state = 1; // 0 = open, 1 = closed, 2 = transition
	
	this.init = function(targetElem, maxHeight) {
		this.elem = targetElem;
		this.maxHeight = maxHeight;
	};
	
	this.openSesame = function() {
		if (this.state != 1) return;
		this.state = 2;
		this.currentHeight = 0;
		this.elem.style.height = '0';
		this.elem.style.display = 'block';
		
		var self = this;
		var doIncrement = function() { self.increment() };
		self.timer = setInterval(doIncrement, self.delay);
	}; // openSesame
	
	this.increment = function() {
		var self = this;
		this.currentHeight = this.currentHeight + this.step;
		if (this.currentHeight > this.maxHeight)
			this.currentHeight = this.maxHeight;
		this.elem.style.height = this.currentHeight + 'px';
		
		if (this.currentHeight == this.maxHeight) {
			clearInterval(self.timer);
			this.state = 0;
		}
	};
	
	this.closeSesame = function() {
		if (this.state != 0) return;
		this.state = 2;
		this.currentHeight = this.maxHeight;
		this.elem.style.height = this.currentHeight + 'px';
		
		var self = this;
		var doDecrement = function() { self.decrement() };
		self.timer = setInterval(doDecrement, self.delay);
	}; // closeSesame
	
	this.decrement = function() {
		var self = this;
		this.currentHeight = this.currentHeight - this.step;
		if (this.currentHeight < 0)
			this.currentHeight = 0;
		this.elem.style.height = this.currentHeight + 'px';
		
		if (this.currentHeight == 0) {
			clearInterval(self.timer);
			this.elem.style.display = 'none';
			this.state = 1;
		}
	};
	
	this.toggle = function() {
		if (this.state == 0) {
			this.closeSesame();
		} else {
			this.openSesame();
		}
	}
}

