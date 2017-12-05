// JavaScript Document
// create singleton registry object
var Registry = new function() {
	
}; // Registry

var App = new function() {
	this.init = function() {
		// get reference to content container
		Registry.contentDiv = document.getElementById("content");
		// get array of all h2 elements
		Registry.headingList = document.getElementsByTagName("H2");
		// get array of topic divs
		Registry.topicsList = getElementsByClassName("topic");
		
		Registry.currentTopic = null;
		
		Registry.scrollDelay = 25;
		Registry.stepValue = 10;
		Registry.maxHeight = 250;
		
		// loop through headings and assign a custom attribute to identify index value
		for(var c = 0; c < Registry.headingList.length; c++) {
			Registry.headingList[c].arrayIndex = c;
			
		}
		
		Registry.contentDiv.onclick = function(e) {
			if (!e) e = window.event;
			// get the actual node that triggered the event
			// (this will return the local node the onclick event was assigned to)
			var target = getTargetElem(e);
			//alert(target.nodeName + ' has index ' + target.arrayIndex);
			App.showTopic(target.arrayIndex);
		};
		
		Registry.contentDiv.onmouseover = function(e) {
			if (!e) e = window.event;
			var target = getTargetElem(e);
			if (target.nodeName != 'H2') return;
			target.className = target.className + ' hilight';
		};
		
		Registry.contentDiv.onmouseout = function(e) {
			if (!e) e = window.event;
			var target = getTargetElem(e);
			if (target.nodeName != 'H2') return;
			target.className = target.className.replace('hilight','');
		};
		
	}; // init
	
	this.cleanup = function() {
		
	}; // cleanup
	
	this.showTopic = function(topicId) {
		// hide current selected topic
		if (Registry.currentTopic != null) {
			Registry.topicsList[Registry.currentTopic].style.height = '0';
			Registry.headingList[Registry.currentTopic].className = 
				Registry.headingList[Registry.currentTopic].className.replace('selected','');
		}
		// if this is the same topic then just exit the function - don't do anything
		if (topicId == Registry.currentTopic) {
			Registry.currentTopic = null;
			return;
		}
		// update current selected topic value
		Registry.currentTopic = topicId;
		// apply selected style
		Registry.headingList[Registry.currentTopic].className = 
			Registry.headingList[Registry.currentTopic].className + ' selected';
		// show new selected topic
		//Registry.topicsList[Registry.currentTopic].style.height = 'auto';
		Registry.currentItemHeight = 0;
		Registry.scrollTimer = setInterval(App.scrollOpen, Registry.scrollDelay);
		
	}; // showTopic
	
	this.scrollOpen = function() {
		// increment my height counter
		Registry.currentItemHeight = Registry.currentItemHeight + Registry.stepValue;
		// if new height >= target height cancel interval event
		if (Registry.currentItemHeight >= Registry.maxHeight) {
			clearInterval(Registry.scrollTimer);
			Registry.currentItemHeight = Registry.maxHeight;
		}
		// set height of topic div to new height
		Registry.topicsList[Registry.currentTopic].style.height = Registry.currentItemHeight + 'px';
	}; // scrollopen
	s
}; // App

window.onload = App.init;
window.onunload = App.cleanup;






