// General Library

function getTargetElem(e) {
	if (e.target) {
		var targetNode = e.target;
	} else if (e.srcElement) {
		var targetNode = e.srcElement;
	}
	// fixes an old Safari bug that returns a text node instead of an element
	if (targetNode.nodeType == 3) {
		targetNode = targetNode.parentNode;
	}
	
	return targetNode;
} // getTargetElem

