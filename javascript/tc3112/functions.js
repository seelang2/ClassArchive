// JavaScript Document

function getSrcElement(e) {
	// find out who triggered the event.
	if (e.target) {
		var targetNode = e.target;
	} else if (e.srcElement) {
		var targetNode = e.srcElement;
	}
	// check for safari bug
	if (targetNode.nodeType == 3) {
		targetNode = targetNode.parentNode;
	}
	return targetNode;
};