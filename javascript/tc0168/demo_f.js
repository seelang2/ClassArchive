// JavaScript Document - demo_f.js

var pageData = new function() {
	this.seriesdiv = null;
	this.modelsdiv = null;
	this.resultsdiv = null;
	this.mode = null;
}

function init() {
	pageData.seriesdiv = document.getElementById('series');	
	pageData.modelsdiv = document.getElementById('model');	
	pageData.resultsdiv = document.getElementById('results');	
}

function getSeries() {
	// do some stuff
	x = new Date();
	x = x.getTime();

	ajaxSendReq("GET", 'seriesdata.php?x='+x+'&mode=series', handleSeriesResp, null, 'TEXT');
}

function handleSeriesResp(data) {
	// do more stuff
	
	pageData.seriesdiv.innerHTML = data;
	
	tempvar = document.getElementById('menu1');
	tempvar.onchange = function() { getModels(); }
	
}

function getModels() {
	// do some stuff
	//value = document.getElementById('form1');
	
	tempvar = document.getElementById('menu1');
	//alert(tempvar.options[tempvar.selectedIndex].value);

	ajaxSendReq("GET", 'seriesdata.php?x='+x+'&mode=model&series='+tempvar.options[tempvar.selectedIndex].value, handleModelsResp, null, 'TEXT');
}

function handleModelsResp(data) {
	// do more stuff
	
	pageData.modelsdiv.innerHTML = data;

	tempvar = document.getElementById('menu2');
	tempvar.onchange = function() { getResults(); }

//	getResults("ALL");

}

function getResults() {
	// do some stuff
	tempvar = document.getElementById('menu2');

	ajaxSendReq("GET", 'seriesdata.php?x='+x+'&mode=data&series=none&model='+tempvar.options[tempvar.selectedIndex].value, handleResultsResp, null, 'XML');
}

function handleResultsResp(data) {
	// do more stuff
	itemdata = XMLParse.xml2ObjArray(data, 'mitem');
	pageData.resultsdiv.innerHTML = '';

	srcFields = Array("name", "size", "color", "type", "price");
	insertTable(itemdata, srcFields, pageData.resultsdiv);
}


/*
    Given an array of objects, create a table inside a target Element
    where the list of object attributes (fields) is given as an array
    (each field is a separate table cell in a row)
*/
function insertTable(srcArray, srcFields, targetElem) {
	var tableElem = document.createElement('TABLE');
	targetElem.appendChild(tableElem);

	for (c=0; c < srcArray.length; c++) {

		var temp1 = document.createElement('TR');

		for (d=0; d < srcFields.length; d++) {
			var temp2 = document.createElement('TD');
			temp2.appendChild(document.createTextNode(srcArray[c][srcFields[d]]));
			temp1.appendChild(temp2);
		}
		tableElem.appendChild(temp1);
	}
}

window.onload = init;