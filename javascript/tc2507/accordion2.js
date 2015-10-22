// JavaScript Document
// create registry object to hold global data
var Registry = new Object();

// initialize environment
function init() {
	Registry.maxHeight = 200; // maximum height for content divs when open
	Registry.currentHeight = 0; // start out content divs closed and set to 0
	
	
	divList = document.getElementById("container").getElementsByTagName("DIV");
	
	//alert(divList.length);
	// define arrays
	Registry.topicDivs = [];
	Registry.contentDivs = [];
		
	for (var c = 0; c < divList.length; c++) {
		if (divList[c].className == 'topic') {
			divList[c].arrayIndex = Registry.topicDivs.length;
			Registry.topicDivs[Registry.topicDivs.length] = divList[c];
		}
		if (divList[c].className == 'content') {
			Registry.contentDivs[Registry.contentDivs.length] = divList[c];
		}
	}
	
	for (var c = 0; c < Registry.topicDivs.length; c++) {
		//Registry.topicDivs[c].arrayIndex = c;
		
		Registry.topicDivs[c].onclick = function() {
			for (var c = 0; c < Registry.contentDivs.length; c++) {
				
				if (c == this.arrayIndex) {
					if (Registry.contentDivs[c].style.display == 'block') {
						// already open, close it instead
						//Registry.contentDivs[c].style.display = 'none';
						closeSesame(c);
					} else {
						openSesame(c);
					}
				} else {
					//Registry.contentDivs[c].style.display = 'none';
					closeSesame(c);
				}
			}
		};
	}
	
} // init

function openSesame(index) {
	Registry.currentODiv = index;
	Registry.contentDivs[index].style.height = '0'; // ensure height is 0
	Registry.currentOHeight = 0; // reset current height
	Registry.contentDivs[index].style.display = 'block'; // unhiding content div
	Registry.openInterval = setInterval("expandDiv()", 5);
}

function expandDiv() {
	Registry.currentOHeight += 5;
	if (Registry.currentOHeight > Registry.maxHeight) {
		Registry.currentOHeight = Registry.maxHeight;
		clearInterval(Registry.openInterval);
	}
	Registry.contentDivs[Registry.currentODiv].style.height = Registry.currentOHeight + 'px';
}

function closeSesame(index) {
	if (Registry.contentDivs[index].style.display != 'block') { return; }
	Registry.currentCDiv = index;
	Registry.contentDivs[index].style.height = Registry.maxHeight + 'px'; // ensure height is 0
	Registry.currentCHeight = Registry.maxHeight; // reset current height
	Registry.closeInterval = setInterval("shrinkDiv()", 5);
}

function shrinkDiv() {
	Registry.currentCHeight -= 5;
	if (Registry.currentCHeight < 0) {
		Registry.currentCHeight = 0;
		clearInterval(Registry.closeInterval);
		Registry.contentDivs[Registry.currentCDiv].style.display = 'none';
	}
	Registry.contentDivs[Registry.currentCDiv].style.height = Registry.currentCHeight + 'px';
}

window.onload = init;
















