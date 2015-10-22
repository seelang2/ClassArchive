// demoe.js

pageData = new function() {
	this.resultsDiv = null;
}

function init() {
	pageData.resultsDiv = document.getElementById("results");
	document.getElementById("list").onclick = getList;
	document.getElementById("edit1").onclick = function() { getEdit(1); return false; }

}

function getList() {

	// cache fix, want to constantly give a parameter that changes (time in milliseconds will change) to prevent caching
	x = new Date();
	x = x.getTime();

	ajaxSendReq('GET', 'demoe-visits.php?mode=list&ajax=1&x='+x, displayList, null, 'TEXT', true);
	return false;
}

function getEdit(id) {

	// cache fix, want to constantly give a parameter that changes (time in milliseconds will change) to prevent caching
	x = new Date();
	x = x.getTime();

	ajaxSendReq('GET', 'demoe-visits.php?mode=edit&id='+id+'&ajax=1&x='+x, displayList, null, 'TEXT', true);
	return false;
}

function displayList(response) {

	pageData.resultsDiv.innerHTML = response;

}


window.onload = init;