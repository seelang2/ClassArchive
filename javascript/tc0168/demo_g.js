// JavaScript Document - demo_f.js

var pageData = new function() {
	this.seriesdiv = null;
	this.modelsdiv = null;
	this.resultsdiv = null;
	this.hoverdiv = null;
	this.mode = null;
}

function init() {
	pageData.seriesdiv = document.getElementById('series');	
	pageData.modelsdiv = document.getElementById('model');	
	pageData.resultsdiv = document.getElementById('results');	
	
	pageData.hoverdiv = document.createElement('DIV');
	document.body.appendChild(pageData.hoverdiv);
	
	pageData.hoverdiv.setAttribute('ID','hover');
	
	temp = document.createElement('DIV');
	pageData.hoverdiv.appendChild(temp);
	temp.setAttribute('ID','hoverdata');
	
	temp = document.createElement('INPUT');
	pageData.hoverdiv.appendChild(temp);
	temp.setAttribute('ID','hoverbut');
	temp.setAttribute('NAME','hoverbut');
	temp.setAttribute('TYPE','button');
	temp.setAttribute('VALUE','Close Window');
//	temp.onclick = function() { hideHover(); }
	temp.onclick = function() { new Effect.Fold(pageData.hoverdiv); }



	new Draggable('hover', {revert:false});
	
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
	x = new Date();
	x = x.getTime();
	
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

	x = new Date();
	x = x.getTime();

	ajaxSendReq("GET", 'seriesdata.php?x='+x+'&mode=data&series=none&model='+tempvar.options[tempvar.selectedIndex].value, handleResultsResp, null, 'XML');
}

function handleResultsResp(data) {
	// do more stuff
	itemdata = XMLParse.xml2ObjArray(data, 'mitem');
	pageData.resultsdiv.innerHTML = '';

	for (c=0; c < itemdata.length; c++) {
		itemdiv = document.createElement('DIV');
		itemdiv.setAttribute('CLASS','item');
		itemdiv.setAttribute('ID','item_' + c);
		pageData.resultsdiv.appendChild(itemdiv);
		
		temp = document.createElement('IMG');
		temp.setAttribute('SRC','tclogo2-sm.jpg');
		temp.setAttribute('WIDTH','75');
		temp.setAttribute('HEIGHT','62');
		
		var tempitem = itemdata[c].name;
		
		temp.onmouseover = function() { showHover(); getItemData(tempitem); }
		temp.onmouseout = function() { /* hideHover(); */ }
		
		itemdiv.appendChild(temp);
		
		itemdiv.appendChild(document.createElement('BR'));
		itemdiv.appendChild(document.createTextNode(itemdata[c].name));
		itemdiv.appendChild(document.createElement('BR'));
		itemdiv.appendChild(document.createTextNode(itemdata[c].price));

	}

/*
	srcFields = Array("name", "size", "color", "type", "price");
	insertTable(itemdata, srcFields, pageData.resultsdiv);
*/

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


function showHover(itemname) {
	pageData.hoverdiv.style.visibility = 'visible';
	new Effect.Appear('hover');
	
}

function hideHover() {
	pageData.hoverdiv.style.visibility = 'hidden';
	
	
}

function getItemData(itemname) {
	x = new Date();
	x = x.getTime();

	ajaxSendReq("GET", 'seriesdata.php?x='+x+'&mode=data&series=ALL&model=ALL&item='+itemname, fillHover, null, 'XML');

}

function fillHover(resp) {

	itemdata = XMLParse.xml2ObjArray(resp, 'mitem');
	
	hoverdiv = document.getElementById('hoverdata');
	
	hoverdiv.innerHTML = '';
	
	hoverdiv.appendChild(document.createTextNode(itemdata[0].name));
	hoverdiv.appendChild(document.createElement('BR'));
	hoverdiv.appendChild(document.createTextNode(itemdata[0].size));
	hoverdiv.appendChild(document.createElement('BR'));
	hoverdiv.appendChild(document.createTextNode(itemdata[0].color));
	hoverdiv.appendChild(document.createElement('BR'));
	hoverdiv.appendChild(document.createTextNode(itemdata[0].type));
	hoverdiv.appendChild(document.createElement('BR'));
	hoverdiv.appendChild(document.createTextNode(itemdata[0].price));


}


window.onload = init;