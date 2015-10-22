// JavaScript Document
// demo5

var PageData = new function() {
	this.rightsideDiv = null;
	this.statusmsgDiv = null;
	this.formElem = null;
	this.formFields = new Array('name','size','color','type','price');
	this.currentRow = null;
	this.enableDblClick = true;
	this.showHover = true;
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
		PageData.formElem = null;
		PageData.currentRow = null;
		
	};
	
	this.displayTable = function(response) {
		PageData.statusmsgDiv.style.visibility = 'hidden';
		
		// we clear out all the contents of the div
		PageData.rightsideDiv.innerHTML = '';

		/*
		// alternate method to clear container contents
		while(PageData.rightsideDiv.firstChild)
			PageData.rightsideDiv.removeChild(PageData.rightsideDiv.firstChild);
		*/		
		
		// take the xml object and parse it into a javascript object array
		// using the XMLParse library
		itemList = XMLParse.xml2ObjArray(response, 'mitem');
		
		// create the form OUTSIDE the table because form elements
		// must be contained within the form (child nodes)
		PageData.formElem = document.createElement("FORM");
		PageData.formElem.action = '#';
		PageData.formElem.method = 'get';
		PageData.rightsideDiv.appendChild(PageData.formElem);
		
		tempElem = document.createElement("TABLE");
		PageData.formElem.appendChild(tempElem);
		tempElem.id = 'datatable';
		
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
			inputElem = document.createElement("INPUT");
			tempElem.appendChild(inputElem);
			inputElem.type = 'button';
			inputElem.value = 'Edit';
			inputElem.className = 'formbutton';
			
			tempRow.ondblclick = function(e) {
				if (!PageData.enableDblClick) {
					return;
				}
				
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
			
			// set hover init behavior
			tempRow.onmouseover = function(e) {
				// use the library function to find out which node triggered the event
				me = getTargetElem(e);
				
				//alert(me.nodeName); <= DON'T DO THIS!!!!!
				while (me.nodeName != 'TR')
					me = me.parentNode;
				
				/*
					Set up timer event unaffected by execution scope
				*/
				var runTimedHover = function() { 
					if (PageData.showHover) {
						PageData.showHover = false;
						demoApp.showHover(me); 
					}
				};
				PageData.timer = setTimeout(runTimedHover, 2500);

			};
			
			// cancel hover effect if mouse is moved before timer event
			tempRow.onmouseout = function() {
				clearTimeout(PageData.timer);	
			};
		}
	};
	
	this.showHover = function(target) {
		
		alert(target.nodeName);
		
		
	};
	
	this.doEdit = function(targetNode) {
		PageData.enableDblClick = false;
		
		i = targetNode.childNodes.length;
		for (c = 0; c < i; c++) {
			//alert(targetNode.childNodes[c].firstChild.nodeValue);
			
			if (targetNode.childNodes[c] == targetNode.lastChild) {
				// replace the last child with an input button
				targetNode.childNodes[c].firstChild.value = 'Update';
				
				// add submit event handler functionality
				targetNode.childNodes[c].firstChild.onclick = function(e) {
					
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
					
					PageData.currentRow = targ;
	
					formData = formData2QueryString(PageData.formElem);
					x = new Date();
					x = x.getTime();
					
					PageData.statusmsgDiv.style.visibility = 'visible';
					demoApp.req.doPost('/echopost.php?mode=xml&x=' + x, formData, demoApp.updateRow, 'xml');
					return false;
				};

				
			} else {
				// handle the child cell
				inputElem = document.createElement("INPUT");
				inputElem.type = 'text';
				inputElem.name = PageData.formFields[c];
				inputElem.value = targetNode.childNodes[c].firstChild.nodeValue;
				
				targetNode.childNodes[c].removeChild(targetNode.childNodes[c].firstChild);
				targetNode.childNodes[c].appendChild(inputElem);
			}
		}
		
/*
		tdElem = document.createElement("TD");
		targetNode.appendChild(tdElem);
		inputElem = document.createElement("INPUT");
		tdElem.appendChild(inputElem);
		inputElem.type = 'submit';
		inputElem.value = 'Update';
*/

	};
	
	this.updateRow = function(response) {
		PageData.statusmsgDiv.style.visibility = 'hidden';
		
		fieldList = XMLParse.xml2ObjArray(response, 'field');
		
		// loop through and remove all children in row
		while(PageData.currentRow.firstChild)
			PageData.currentRow.removeChild(PageData.currentRow.firstChild);
		
		
		count = fieldList.length;
		
		for (c = 0; c < count; c++) {
			
			tempElem = document.createElement("TD");
			PageData.currentRow.appendChild(tempElem);
			tempElem.appendChild(document.createTextNode(fieldList[c].value));
			
		}
		
		tempElem = document.createElement("TD");
		PageData.currentRow.appendChild(tempElem);
		inputElem = document.createElement("INPUT");
		tempElem.appendChild(inputElem);
		inputElem.type = 'button';
		inputElem.value = 'Edit';
		inputElem.className = 'formbutton';
		
		//PageData.currentRow.className = 'hilight';
		new Effect.Pulsate(PageData.currentRow);
		
		PageData.enableDblClick = true;
	};
	
};


window.onload = demoApp.init;

window.onunload = demoApp.cleanup;

