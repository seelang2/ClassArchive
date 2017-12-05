// JavaScript function library

function getTargetElem(e) {
	// find out who triggered the event
	if (e.target) var targetNode = e.target;
	else if (e.srcElement) var targetNode = e.srcElement;
	
	// Safari has a bug where it returns a textnode instead of element
	if (targetNode.nodeType == 3)
		targetNode = targetNode.parentNode;
	
	return targetNode;
}

function getMouseXY(e) {
	if (document.all) {
		var tempX = e.clientX + document.body.scrollLeft;
		var tempY = e.clientY + document.body.scrollTop;
	} else {
		var tempX = e.pageX;
		var tempY = e.pageY;
	}
	if (tempX < 0){ tempX = 0; }
	if (tempY < 0){ tempY = 0; }
	
	return {x:tempX,y:tempY};
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



