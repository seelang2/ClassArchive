
var pageData = new function() {
	this.contentDiv = null;
	this.sidebarDiv = null;
	this.statusDiv = null;
	this.hoverDiv = null;
	this.currentRow = null;
	this.productFields = Array("name", "size", "color", "type", "price");

}

function doSomething(e) {
	var targ;
	if (!e) var e = window.event;
	if (e.target) targ = e.target;
	else if (e.srcElement) targ = e.srcElement;
	if (targ.nodeType == 3) // defeat Safari bug
		targ = targ.parentNode;
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

	getProductList();

	// displayItemTable();
} 

function cleanup() {
	this.contentDiv = null;
	this.sidebarDiv = null;
	this.hoverDiv = null;
}


function getProductList() {

	// get time to pass on query string to work around IE aggressive caching
	x = new Date();
	x = x.getTime();

	ajaxSendReq("GET", 'http://localhost/seriesdata.php?x='+x+'&mode=data&series=all&model=all', displayProductList, null, 'XML');

	// turn off user feedback
	pageData.statusDiv.style.visibility = 'visible';
}

function displayProductList(response) {
	alert ('back from server');

	pageData.statusDiv.style.visibility = 'hidden';
	productList = XMLParse.xml2ObjArray(response, 'mitem');
	insertTable(productList, pageData.productFields, pageData.contentDiv, 'producttable', 'name');


}

function doHover(elem) {
	
//	alert('hover box for row ' + pageData.currentRow);
//	alert('hover box for row ' + rowid);

//elem = getSrcElem(e);

alert('target element: ' + elem.id);

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
		
		temp1.onmouseover = function(e) { 
			var targ;
			if (!e) var e = window.event;
			if (e.target) targ = e.target;
			else if (e.srcElement) targ = e.srcElement;
			if (targ.nodeType == 3) // defeat Safari bug
				targ = targ.parentNode;

//			alert('Event type: ' + e.type);

			var runTimedHover = function() { doHover(targ) };

//			doHover(targ);
			pageData.timer = setTimeout(runTimedHover, 1500);
		}

		temp1.onmouseout = function() { clearTimeout(pageData.timer); }

		for (d=0; d < srcFields.length; d++) {
			var temp2 = document.createElement('TD');
			temp2.appendChild(document.createTextNode(srcArray[c][srcFields[d]]));
			temp1.appendChild(temp2);
		}
		tableElem.appendChild(temp1);
	}
}

window.onload = init;
window.onunload = cleanup;