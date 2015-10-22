// JavaScript Document
var pageData = new function() {
	this.leftDiv = null;
	this.rightDiv = null;
	this.ajax = new Ajax();
	
	this.init = function() {
		pageData.leftDiv = document.getElementById("leftcol");
		pageData.rightDiv = document.getElementById("rightcol");
		
		temp = document.createElement("A");
		pageData.leftDiv.appendChild(temp);
		temp.href = '#';
		temp.onclick = doAjaxReq;
		temp.appendChild(document.createTextNode('Click Here to continue'));
		
		document.getElementById("form1").onsubmit = doAjaxGet;

	};
	
	this.cleanup = function() {
		pageData.leftDiv = null;
		pageData.rightDiv = null;
	};

};

function doAjaxReq() {
	formdata = formData2QueryString(document.getElementById("form1"));
	
	pageData.ajax.doPost('echopost2.php?mode=xml', formdata, handleAjaxResp, 'xml');
	
//	pageData.ajax.doGet('echopost1.php?mode=html&firstname=John&lastname=Doe', handleAjaxResp, 'text');

	return false;
}

function handleAjaxResp(response) {
	pageData.rightDiv.innerHTML = '';
	
	fieldList = XMLParse.xml2ObjArray(response, 'field');
	
	temp = document.createElement("TABLE");
	pageData.rightDiv.appendChild(temp);
	
	tbody = document.createElement("TBODY");
	temp.appendChild(tbody);

	// create header row
	temp = document.createElement("TR");
	tbody.appendChild(temp);
	
	temp2 = document.createElement("TD");
	temp.appendChild(temp2);
	temp2.appendChild(document.createTextNode('Name'));
	
	temp2 = document.createElement("TD");
	temp.appendChild(temp2);
	temp2.appendChild(document.createTextNode('Value'));

	fieldCount = fieldList.length;
	for(c = 0; c < fieldCount; c++) {
		
		temp = document.createElement("TR");
		tbody.appendChild(temp);
		
		temp2 = document.createElement("TD");
		temp.appendChild(temp2);
		temp2.appendChild(document.createTextNode(fieldList[c].name));
		
		temp2 = document.createElement("TD");
		temp.appendChild(temp2);
		temp2.appendChild(document.createTextNode(fieldList[c].value));
		
		
		
	}

}

window.onload = pageData.init;
window.onunload = pageData.cleanup;

