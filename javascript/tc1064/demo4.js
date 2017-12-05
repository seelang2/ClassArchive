// JavaScript Document

var PageData = new function() {
	this.rightsideDiv = null;
	this.statusmsgDiv = null;
	this.requiredFields = null;
	this.submitbutton = null;
};

var demoApp = new function() {

	this.init = function() {
		dataform = document.getElementById("dataform");
		
		PageData.rightsideDiv = document.getElementById("rightside");
		PageData.statusmsgDiv = document.getElementById("statusmsg");
		PageData.requiredFields = getElementsByClassName('required', 'input', dataform);
		PageData.submitbutton = document.getElementById("butsubmit");
		
		element = document.createElement("H2");
		PageData.rightsideDiv.appendChild(element);
		element.appendChild(document.createTextNode('Results Table'));
				
		demoApp.req = new Ajax1();

/*
		dataform.onchange = function() {
			
			validated = true;
			for (c in PageData.requiredFields) {
				//alert(PageData.requiredFields[c].value.length);
				if (PageData.requiredFields[c].value.length == 0) {
					validated = false;
				}
			}
			if (validated) {
				PageData.submitbutton.disabled = false;
			} else {
				PageData.submitbutton.disabled = true;
			}
		};
*/		
		dataform.onsubmit = function() {
			formData = formData2QueryString(this);
			
			x = new Date();
			x = x.getTime();
			
			//alert(formData);
			PageData.statusmsgDiv.style.visibility = 'visible';
			demoApp.req.doPost('/echopost.php?mode=xml&x=' + x, formData, demoApp.showResult, 'xml');
			return false;
		};
	};
	
	this.cleanup = function() {
		PageData.rightsideDiv = null;
		PageData.statusmsgDiv = null;
		PageData.requiredFields = null;
		PageData.submitbutton = null;
	};
	
	this.checkForm = function() {
		validated = true;
		for (c in PageData.requiredFields) {
			//alert(PageData.requiredFields[c].value.length);
			if (PageData.requiredFields[c].value.length == 0) {
				validated = false;
			}
		}
		if (validated) {
			PageData.submitbutton.disabled = false;
		} else {
			PageData.submitbutton.disabled = true;
		}
	};
	
	this.showResult = function(response) {
		PageData.statusmsgDiv.style.visibility = 'hidden';
		
		fieldList = XMLParse.xml2ObjArray(response, 'field');
		
		PageData.rightsideDiv.innerHTML = '';
		
		count = fieldList.length;
		
		tempElem = document.createElement("TABLE");
		PageData.rightsideDiv.appendChild(tempElem);
		
		tBodyElem = document.createElement("TBODY");
		tempElem.appendChild(tBodyElem);
		
		tempRow = document.createElement("TR");
		tBodyElem.appendChild(tempRow);
			
		tempElem = document.createElement("TH");
		tempRow.appendChild(tempElem);
		tempElem.appendChild(document.createTextNode('Name'));
		
		tempElem = document.createElement("TH");
		tempRow.appendChild(tempElem);
		tempElem.appendChild(document.createTextNode('Value'));
		
		// for (c in fieldList) { // alternate loop method
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
			tempElem.appendChild(document.createTextNode(fieldList[c].name));
			
			tempElem = document.createElement("TD");
			tempRow.appendChild(tempElem);
			tempElem.appendChild(document.createTextNode(fieldList[c].value));
			
		}
		
		
	};

};

document.onkeyup = demoApp.checkForm; 

window.onload = demoApp.init;

window.onunload = demoApp.cleanup;

