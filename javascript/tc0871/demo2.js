// JavaScript Document demo2.js
pageData = new function() {
	this.currentTab = 1;
};

function init() {
	menuItems = document.getElementsByTagName("A");
	
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
				
				// hide current tab
				document.getElementById("tab_"+pageData.currentTab).style.display = 'none';
				
				// show new tab
				document.getElementById("tab_"+indexNumber).style.display = 'block';
				
				//alert('border: '+targ.parentNode.style.borderBottomStyle);
				
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

function cleanup() {
		
}

window.onload = init;
window.onunload = cleanup;