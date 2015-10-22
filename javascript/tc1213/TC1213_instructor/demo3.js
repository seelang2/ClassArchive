// JavaScript Document

PageData = new function() {
	this.leftDiv = null;
	this.rightDiv = null;
	this.ajaxreq = null;
	this.statusDiv = null;
	this.timer = null;
}; 

DemoApp = new function() {

	this.init = function() {
		PageData.leftDiv = document.getElementById("leftside");
		PageData.rightDiv = document.getElementById("rightside");
		PageData.statusDiv = document.getElementById("statusmsg");
		PageData.ajaxreq = new Ajax();
		PageData.ajaxreq.async = true;
		
		document.getElementById("form1").onsubmit = function() {
			
			formData = formData2QueryString(document.getElementById("form1"));
			
			x = new Date();
			x = x.getTime();

			PageData.ajaxreq.doPost('echopost.php?mode=xml&x=' + x, formData, DemoApp.handleResp, 'xml');
			PageData.statusDiv.style.visibility = 'visible';
			return false;
		};

	};
	
	this.cleanup = function() {
		PageData.leftDiv = null;
		PageData.rightDiv = null;
		PageData.statusDiv = null;
	};
	
	this.handleResp = function(resp) {

		PageData.statusDiv.style.visibility = 'hidden';

		// clearing an element method 1
		/*
		while (PageData.rightDiv.firstChild) {
			PageData.rightDiv.removeChild(PageData.rightDiv.firstChild);
		}
		*/
		
		// clearing an element method 2
		PageData.rightDiv.innerHTML = '';
		
		
		fieldList = XMLParse.xml2ObjArray(resp, 'field');
		
			tempElem = document.createElement("TABLE");
			PageData.rightDiv.appendChild(tempElem);
			
			tbody = document.createElement("TBODY");
			tempElem.appendChild(tbody);

			// create header row
			tempRow = document.createElement("TR");
			tbody.appendChild(tempRow);
			
			tempElem = document.createElement("TH");
			tempElem.appendChild(document.createTextNode('#'));
			tempRow.appendChild(tempElem);
			
			tempElem = document.createElement("TH");
			tempElem.appendChild(document.createTextNode('Name'));
			tempRow.appendChild(tempElem);
			
			tempElem = document.createElement("TH");
			tempElem.appendChild(document.createTextNode('Value'));
			tempRow.appendChild(tempElem);

		fieldCount = fieldList.length;
		for (c = 0; c < fieldCount; c++) {
			
			tempRow = document.createElement("TR");
			tbody.appendChild(tempRow);
			
			if (c % 2 == 0) {
				tempRow.className = 'evenrow';
			} else {
				tempRow.className = 'oddrow';
			}
			
			tempElem = document.createElement("TD");
			tempElem.appendChild(document.createTextNode(c));
			tempRow.appendChild(tempElem);
			
			tempElem = document.createElement("TD");
			tempElem.appendChild(document.createTextNode(fieldList[c].name));
			tempRow.appendChild(tempElem);
			
			tempElem = document.createElement("TD");
			tempElem.appendChild(document.createTextNode(fieldList[c].value));
			tempRow.appendChild(tempElem);
			
			
		}
		
		// notify user where state change occurred
		
		Flasher.timedEvent = setInterval(Flasher.resetBackground, 50);
		
	};
	

};

Flasher = new function() {
	this.timedEvent = null;
	this.counter = 0;
	
	this.resetBackground = function() {
		Flasher.counter++;
		if (Flasher.counter % 2 == 0) {
			bgcolor = '#ff0000';	
		} else {
			bgcolor = '#ffffff';	
		}
		PageData.rightDiv.style.backgroundColor = bgcolor;
		
		if (Flasher.counter > 4) {
			clearInterval(Flasher.timedEvent);
			Flasher.counter = 0;
		}
	}
	
};

window.onload = DemoApp.init;
window.onunload = DemoApp.cleanup;

