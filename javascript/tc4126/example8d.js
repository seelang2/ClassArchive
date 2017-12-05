// JavaScript Document
function showContent(index) {
	// loop through contentDivs 
	for (var c = 0; c < contentDivs.length; c++) {
		if (c == index) {
			// display this content div
			contentDivs[c].style.display = 'block';
			if (titleDivs[c].className.search(/\bactive\b/) < 0) titleDivs[c].className += ' active';
		} else {
			// hid this content div
			contentDivs[c].style.display = 'none';
			titleDivs[c].className = titleDivs[c].className.replace(/ active/,'');
		}
	}
}

// get all DIVs inside my wrapper
var divList = document.getElementById("wrapper").getElementsByTagName("DIV");
var titleDivs = [];
var contentDivs = [];

var currentHash = ''; // store current hash

for (var c = 0; c < divList.length; c++) {
	if (divList[c].className.search(/\btitle\b/) > -1) { // use regex instead of divList[c].className == 'title'
		titleDivs.push(divList[c]); // add this div to the titleDivs list
	}
	if (divList[c].className.search(/\bcontent\b/) > -1) {
		contentDivs.push(divList[c]); // add this div to the titleDivs list
	}
}

// attach event handlers to title divs
for (var c = 0; c < titleDivs.length; c++) {
	titleDivs[c].arrayIndex = c;
	contentDivs[c].id = 'contentitem-' + c;
	
	titleDivs[c].onclick = function() {
		showContent(this.arrayIndex);
		document.location = '#contentitem-' + this.arrayIndex;
		currentHash = document.location.hash; // update currentHash
	}
}

showContent(0);

setInterval(function() {
	if (document.location.hash != currentHash) {
		// location has changed
		currentHash = document.location.hash; // update currentHash
		showContent(document.location.hash.split('-')[1]);
	}
}, 250);

