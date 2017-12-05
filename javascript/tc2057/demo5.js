// JavaScript Document
var AppData = new function() {
	this.drwHeaders = [];
	this.drwTopics = new Array();
	this.drwObjects = new Array();
}; // AppData

var App = new function() {
	this.init = function() {
		
		AppData.drwHeaders = getElementsByClassName('drawerheading', 'DIV', document.getElementById("content"));
		AppData.drwTopics = getElementsByClassName('drawertopic', 'DIV', document.getElementById("content"));
		
		//alert(AppData.drwTopics.length);
		
		// create drawer object instances
		for (var c = 0; c < AppData.drwTopics.length; c++) {
			AppData.drwObjects[c] = new Drawer();
			AppData.drwObjects[c].init(AppData.drwTopics[c], 300);
		}
		
		for (var c = 0; c < AppData.drwHeaders.length; c++) {
			AppData.drwHeaders[c].onclick = function(e) {
				// check whether event object passed
				if (!e) var e = window.event;
				var target = getTargetElem(e);
				
				while (target.nodeName != 'DIV')
					target = target.parentNode;
					
				var topic = target.id.split("-")[1] - 1;
				
				// loop through topics to set drawer display
				for (var c = 0; c < AppData.drwTopics.length; c++) {
					if (c == (topic)) {
						//AppData.drwObjects[topic].openSesame();
						AppData.drwObjects[topic].toggle();
						/*
						if (AppData.drwTopics[c].style.display == 'block')
							AppData.drwTopics[c].style.display = 'none';
						else
							AppData.drwTopics[c].style.display = 'block';
						*/
					} else {
						// AppData.drwTopics[c].style.display = 'none';
						AppData.drwObjects[c].closeSesame();
					}
				}
			}; // onclick
			
			AppData.drwHeaders[c].onmouseover = function(e) {
				if (!e) var e = window.event;
				var target = getTargetElem(e);
				
				while (target.nodeName != 'DIV')
					target = target.parentNode;
				
				target.className = target.className + ' drwhover';
			}; // onmouseover

			AppData.drwHeaders[c].onmouseout = function(e) {
				if (!e) var e = window.event;
				var target = getTargetElem(e);
				
				while (target.nodeName != 'DIV')
					target = target.parentNode;
				
				target.className = target.className.substr(0, target.className.length - 9);
			}; // onmouseout

		}
		
	}; // init
	
	this.cleanup = function() {
		AppData.drwHeaders = null;
		AppData.drwTopics = null;
	}; // cleanup
	
	this.displayResult = function(response) {
		// hide status bar
		AppData.statusDiv.style.display = 'none';

		
	}; // displayResult
}; // App

window.onload = App.init;
window.onunload = App.cleanup;
