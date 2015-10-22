// JavaScript Document demo2.js
pageData = new function() {
	this.currentTab = 1;
	this.statusDiv = null;
};

function init() {
	menuItems = document.getElementsByTagName("A");
	pageData.statusDiv = document.getElementById("statusdiv");
	
	for(c= 0; c < menuItems.length; c++) {
		// alert('Item '+ c +' classname: '+ menuItems[c].className + ' ID: ' + menuItems[c].id);
		
		// only process menu items
		if (menuItems[c].className == 'menuitem') {
			// indexNumber = menuItems[c].id.substr(9);
			// alert('IndexNumber for item '+ c +' is '+ indexNumber);
			
			menuItems[c].onclick = function(e) {
				// get node that triggered event
				var targ;
				if (!e) var e = window.event;
				if (e.target) targ = e.target;
				else if (e.srcElement) targ = e.srcElement;
				if (targ.nodeType == 3) // defeat Safari bug
				targ = targ.parentNode;

				indexNumber = targ.id.substr(9);
				
				// retrieve data set for menu item
				ajaxSendReq("GET", '/tabcontent_'+indexNumber+'.html', displayContent, null, "TEXT");
				pageData.statusDiv.style.visibility = 'visible';

				// apply bottom border to current menu item
				document.getElementById("menuitem_"+pageData.currentTab).parentNode.style.borderBottomStyle = 'solid';
				
				// remove bottom border to selected menu item
				targ.parentNode.style.borderBottomStyle = 'none';
				
				// set current tab to this item
				pageData.currentTab = indexNumber;
				
				// remove focus on link
				targ.blur();

				// cancel link
				return false;
			};
			
		}
	}
}

function displayContent(response) {
	pageData.statusDiv.style.visibility = 'hidden';
	document.getElementById("tabcontent").innerHTML = response;	
}

function cleanup() {
	pageData.statusDiv = null;
}

window.onload = init;
window.onunload = cleanup;