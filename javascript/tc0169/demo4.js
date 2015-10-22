
var pageData = new function() {
	this.contentDiv = null;
	this.sidebarDiv = null;
	this.statusDiv = null;
	this.hoverDiv = null;
	this.currentRow = null;
	this.productFields = Array("name", "size", "color", "type", "price");

}

getSrcElem = function(e) {
    var ret = null;
    if (!e) { e = window.event; }
    if (e.srcElement) {
      ret = e.srcElement;
    }
    else if (e.target) {
      ret = e.target;
    }
    while (!ret.id && ret) {
      ret = ret.parentNode;
    }
    return ret;
};

function init() {
	pageData.contentDiv = document.getElementById('content');
	pageData.sidebarDiv = document.getElementById('sidebar');
	pageData.statusDiv = document.getElementById('statusbar');

//	getProductList();

	displayItemTable();
} 

function cleanup() {
	this.contentDiv = null;
	this.sidebarDiv = null;
	this.hoverDiv = null;
}


function getProductList() {

	ajaxSendReq("GET", 'http://localhost/seriesdata.php?mode=data&series=all&model=all', displayProductList, null, 'XML');
	pageData.statusDiv.style.visibility = 'visible';
}

function displayProductList(response) {

	pageData.statusDiv.style.visibility = 'hidden';
	productList = XMLParse.xml2ObjArray(response, 'mitem');
	insertTable(productList, pageData.productFields, pageData.contentDiv, 'producttable', 'name');


}

function doHover(rowid) {
	
//	alert('hover box for row ' + pageData.currentRow);
	alert('hover box for row ' + rowid);

//elem = getSrcElem(e);

//alert('target element' + elem);

}



/*
    Given an array of objects, create a table inside a target Element
    where the list of object attributes (fields) is given as an array
    (each field is a separate table cell in a row)
*/
function insertTable(srcArray, srcFields, targetElem, className, idField) {
	var tableElem = document.createElement('TABLE');
	targetElem.appendChild(tableElem);
	tableElem.className = className;

	for (c=0; c < srcArray.length; c++) {

		var temp1 = document.createElement('TR');
		temp1.setAttribute('ID', srcArray[c][idField]);

		if ((c%2)>0) {
			temp1.className = className + 'row2';
		} else {
			temp1.className = className + 'row1';
		}

		var test = srcArray[c][idField];

//		temp1.onmouseover = function() { pageData.timer = setTimeout(doHover, 1500); }
//		temp1.onmouseout = function() { clearTimeout(pageData.timer); }
		
		temp1.onmouseover = function() { alert(c+' mouseover function: ' + test); doHover(test); }


		for (d=0; d < srcFields.length; d++) {
			var temp2 = document.createElement('TD');
			temp2.appendChild(document.createTextNode(srcArray[c][srcFields[d]]));
			temp1.appendChild(temp2);
		}
		tableElem.appendChild(temp1);
	}
}

function test(test1) {
alert('calling function test');
	pageData.currentRow = test1;
	pageData.timer = setTimeout(doHover, 1500);
}

function displayItemTable() {

alert('displaying table...');

	temptable = document.createElement('TABLE');
	pageData.contentDiv.appendChild(temptable);

	temptbody = document.createElement('TBODY');
	temptable.appendChild(temptbody);

	temprow = document.createElement('TR');
	temptbody.appendChild(temprow);

	tempcell = document.createElement('TD');
	tempcell.appendChild(document.createTextNode('Name'));
	temprow.appendChild(tempcell);

	tempcell = document.createElement('TD');
	tempcell.appendChild(document.createTextNode('Size'));
	temprow.appendChild(tempcell);

	tempcell = document.createElement('TD');
	tempcell.appendChild(document.createTextNode('Color'));
	temprow.appendChild(tempcell);

	tempcell = document.createElement('TD');
	tempcell.appendChild(document.createTextNode('Type'));
	temprow.appendChild(tempcell);

	tempcell = document.createElement('TD');
	tempcell.appendChild(document.createTextNode('Price'));
	temprow.appendChild(tempcell);


}


window.onload = init;
window.onunload = cleanup;