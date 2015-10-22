// JavaScript Document
// demo5

var PageData = new function() {
	this.rightsideDiv = null;
	this.statusmsgDiv = null;
	
};

var demoApp = new function() {
	
	this.init = function() {
		PageData.rightsideDiv = document.getElementById("rightside");
		PageData.statusmsgDiv = document.getElementById("statusmsg");
		
		demoApp.req = new Ajax1();

		// create timestamp to work around caching issue
		x = new Date();
		x = x.getTime();
		
		PageData.statusmsgDiv.style.visibility = 'visible';
		demoApp.req.doGet('/seriesdata.php?mode=data&x=' + x, demoApp.displayTable, 'xml');
		
	};
	
	this.cleanup = function() {
		PageData.rightsideDiv = null;
		PageData.statusmsgDiv = null;
		
	};
	
	this.displayTable = function(response) {
		PageData.statusmsgDiv.style.visibility = 'hidden';
		
		PageData.rightsideDiv.innerHTML = '';
		
		itemList = XMLParse.xml2ObjArray(response, 'mitem');
		
		tempElem = document.createElement("TABLE");
		PageData.rightsideDiv.appendChild(tempElem);
		tempElem.style.width = '99%';
		
		tBodyElem = document.createElement("TBODY");
		tempElem.appendChild(tBodyElem);
		
		count = itemList.length;
		
		for (c = 0; c < count; c++) {
			tempRow = document.createElement("TR");
			tBodyElem.appendChild(tempRow);
			
			if (c % 2 == 0) { 
				tempRow.className = 'evenrow';
			} else {
				tempRow.className = 'oddrow';
			}
			
			tempElem = document.createElement("TD");
			tempRow.appendChild(tempElem);
			tempElem.appendChild(document.createTextNode(itemList[c].name));
			
			tempElem = document.createElement("TD");
			tempRow.appendChild(tempElem);
			tempElem.appendChild(document.createTextNode(itemList[c].size));
			
			tempElem = document.createElement("TD");
			tempRow.appendChild(tempElem);
			tempElem.appendChild(document.createTextNode(itemList[c].color));
			
			tempElem = document.createElement("TD");
			tempRow.appendChild(tempElem);
			tempElem.appendChild(document.createTextNode(itemList[c].type));
			
			tempElem = document.createElement("TD");
			tempRow.appendChild(tempElem);
			tempElem.appendChild(document.createTextNode(itemList[c].price));
			
			tempElem = document.createElement("TD");
			tempRow.appendChild(tempElem);
			tempElem.appendChild(document.createTextNode(' '));
			
			tempRow.ondblclick = function(e) {
				var targ;
				// test for objects instead of browser type checking
				if (!e) var e = window.event;
				if (e.target) targ = e.target;
				else if (e.srcElement) targ = e.srcElement;
				if (targ.nodeType == 3) // defeat Safari bug
					targ = targ.parentNode;
				
				// bubble up the child nodes that may have triggered the event
				// until we reach the TR
				while (targ.nodeName != 'TR')
					targ = targ.parentNode;
				
				demoApp.doEdit(targ);
				
			};
		}
	};
	
	this.doEdit = function(targetNode) {
		// create form elements
		formElem = document.createElement("FORM");
		formElem.action = '#';
		formElem.method = 'get';
		
		formElem.onsubmit = function() {
			
			formData = formData2QueryString(this);
			x = new Date();
			x = x.getTime();
			
			PageData.statusmsgDiv.style.visibility = 'visible';
			//demoApp.req.doPost('/echopost.php?mode=xml&x=' + x, formData, demoApp.updateRow, 'xml');
			//return false;
		};
		
		i = targetNode.childNodes.length;
		for (c = 0; c < i; c++) {
			//alert(targetNode.childNodes[c].firstChild.nodeValue);
			
			inputElem = document.createElement("INPUT");
			inputElem.type = 'text';
			inputElem.value = targetNode.childNodes[c].firstChild.nodeValue;
			
			targetNode.childNodes[c].removeChild(targetNode.childNodes[c].firstChild);
			targetNode.childNodes[c].appendChild(inputElem);
			
		}
		
		tdElem = document.createElement("TD");
		targetNode.appendChild(tdElem);
		inputElem = document.createElement("INPUT");
		tdElem.appendChild(inputElem);
		inputElem.type = 'submit';
		inputElem.value = 'Update';

		// insert form element as first child AFTER all processing is complete
		targetNode.insertBefore(formElem, targetNode.firstChild);

/*
		// remove child nodes from original row
		while(targetNode.firstChild)
			targetNode.removeChild(targetNode.firstChild);
*/		
		
		// remove double click event while in form mode
		targetNode.ondblclick = function() { }
	};
	
	this.updateRow = function(response) {
		PageData.statusmsgDiv.style.visibility = 'hidden';
		
	};
	
};


window.onload = demoApp.init;

window.onunload = demoApp.cleanup;

