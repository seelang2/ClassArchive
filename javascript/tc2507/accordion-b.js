// JavaScript Document
// create registry object to hold global data
var Registry = new Object();

// initialize environment
function init() {
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
						Registry.contentDivs[c].style.display = 'none';
					} else {
						Registry.contentDivs[c].style.display = 'block';
					}
				} else {
					Registry.contentDivs[c].style.display = 'none';
				}
				
			}
			
			
			
		};
		
	}
	
	
} // init


window.onload = init;
