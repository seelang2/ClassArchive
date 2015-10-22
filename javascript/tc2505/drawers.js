// JavaScript Document
// create a registry object for global data
var Registry = new Object();

function init() {
	// get collection of all divs inside drawer div
	/* unchained method
	var drawerDiv = document.getElementById("drawers");
	var divList = drawerDiv.getElementsByTagName("DIV");
	*/
	// chained method
	var divList = document.getElementById("drawers").getElementsByTagName("DIV");
	
	// create empty registry arrays
	Registry.topicDivs = [];
	Registry.contentDivs = [];
	
	for(var c = 0; c < divList.length; c++) {
		if (divList[c].className == 'topic') {
			divList[c].id = 'topic-' + Registry.topicDivs.length;
			Registry.topicDivs[Registry.topicDivs.length] = divList[c];
			
			divList[c].onclick = function() {
				toggleContentDivs(this.id.split('-')[1]);
			};
		}
		
		if (divList[c].className == 'content') {
			divList[c].id = 'content-' + Registry.contentDivs.length;
			Registry.contentDivs[Registry.contentDivs.length] = divList[c];
		}
	} // for
	
} // init

function toggleContentDivs(target) {
	for (var c = 0; c < Registry.contentDivs.length; c++) {
		if (c == target) {
			if (Registry.contentDivs[c].style.display == 'block') {
				Registry.contentDivs[c].style.display = 'none';
			} else {
				Registry.contentDivs[c].style.display = 'block';
			}
		} else {
			Registry.contentDivs[c].style.display = 'none';
		}
	} // for
} // toggleContentDivs

//window.onload = init;
init();







