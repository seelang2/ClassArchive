// JavaScript Document
// data registry
Registry = new function() {
	this.posDiv = null;
	this.dropDiv = null;
	this.boxA = null;
	this.boxB = null;
	this.boxC = null;
	this.dragging = null;
}; // registry

// demo app
App = new function() {
	this.init = function() {
		Registry.posDiv = document.getElementById("mousepos");
		Registry.dropDiv = document.getElementById("drop1");
		Registry.boxA = document.getElementById("boxa");
		Registry.boxB = document.getElementById("boxb");
		Registry.boxC = document.getElementById("boxc");
/*		
*/		
		alert('Top: ' + Registry.dropDiv.offsetTop+ "\n" +
			  'Left: ' + Registry.dropDiv.offsetLeft + "\n" +
			  'Bottom: ' + (Registry.dropDiv.offsetTop + 200) + "\n" +
			  'Right: ' + (Registry.dropDiv.offsetLeft + 200) + "\n"
			  );
	}; // init
	
	this.mouseDownHandler = function(e) {
		Registry.posDiv.style.color = '#FF0000';
		if (!e) e = window.event;
		Registry.dragging = getTargetElem(e);
		Registry.dragging.style.zIndex = 100;
	};
	
	this.mouseMoveHandler = function(e) {
		if (!e) e = window.event;
		
		var mousePos = getMouseXY(e);
		var text = 'X: '+mousePos[0]+'Y: '+mousePos[1];
		
		if (Registry.dragging) {
			text = text + '<br>' + Registry.dragging.id;
			Registry.dragging.style.top = mousePos[1] + 'px';
			Registry.dragging.style.left = mousePos[0] + 'px';
		}
		Registry.posDiv.innerHTML = text;
	};
		this.mouseUpHandler = function(e) {

		Registry.posDiv.style.color = '#000000';
		if (!e) e = window.event;
		target = getTargetElem(e);
		var mousePos = getMouseXY(e);
		
		// are we over a drop container?
		if ( (mousePos[1] > Registry.dropDiv.offsetLeft) &&
			 (mousePos[1] < Registry.dropDiv.offsetLeft + 200) &&
			 (mousePos[0] > Registry.dropDiv.offsetTop) &&
			 (mousePos[0] < Registry.dropDiv.offsetTop + 200) 
		   ) {
			alert ('over drop zone');
		}
		
		Registry.dragging = null;
	};
	
	this.cleanup = function() {
		
	}; // cleanup
}; // App


document.onmousemove = App.mouseMoveHandler;
document.onmousedown = App.mouseDownHandler;
document.onmouseup = App.mouseUpHandler;
document.ondrag = function () { return false; };
document.onselectstart = function () { return false; };
window.onload = App.init;
window.onunload = App.cleanup;