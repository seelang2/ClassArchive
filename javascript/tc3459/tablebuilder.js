// JavaScript Document

function buildTable(params) {
	/*
	Parameters: 
		targetNode
		dataList
		oddrowclass
		evenrowclass
		rowclass
		id
	*/
	var tableElem = document.createElement("TABLE");
	tableElem.id = typeof(params.id) == 'undefined' ? '' : params.id;
	
	// create table head section
	var theadElem = document.createElement("THEAD");
	tableElem.appendChild(theadElem);
	var tRowElem = document.createElement("TR");
	theadElem.appendChild(tRowElem);
	
	for (var key in params.dataList[0]) {
		var thElem = document.createElement("TH");
		tRowElem.appendChild(thElem);
		thElem.appendChild(document.createTextNode(key.toUpperCase()));
	}
	// create table body section
	var tbodyElem = document.createElement("TBODY");
	tableElem.appendChild(tbodyElem);
	
	for (var c = 0; c < params.dataList.length; c++) {
		var tRowElem = document.createElement("TR");
		tbodyElem.appendChild(tRowElem);
		tRowElem.className = typeof(params.rowclass) == 'undefined' ? '' : params.rowclass;
		// add striping classes
		if (c % 2 == 0) {
			// odd row
			tRowElem.className += (tRowElem.className.length == 0? '': ' ') 
							   + (typeof(params.oddrowclass) == 'undefined' ? '' : params.oddrowclass);
		} else {
			// even row
			tRowElem.className += (tRowElem.className.length == 0? '': ' ') 
							   + (typeof(params.evenrowclass) == 'undefined' ? '' : params.evenrowclass);
		}
		
		for (var key in params.dataList[c]) {
			var tdElem = document.createElement("TD");
			tRowElem.appendChild(tdElem);
			tdElem.appendChild(document.createTextNode(params.dataList[c][key]));
		}
		
	}
	params.targetNode.appendChild(tableElem);
	return {tableNode: tableElem, tbodyNode: tbodyElem}; // return as a DOM node reference object literal
} // buildTable



// version 2 - as object class
function HTMLTable(parameters) {
	
	this.buildTable = function(parameters) {
		// Parameters: dataList, columnheaders
		if (typeof(parameters) != 'undefined') {
			if (typeof(parameters.dataList) != 'undefined') params.dataList = parameters.dataList;
			if (typeof(parameters.columnheaders) != 'undefined') params.columnheaders = parameters.columnheaders;
		}
		// build table DOM tree structure - does not 'render' (i.e. add it to actual DOM)
		params.tableNode = document.createElement("TABLE");
		params.tableNode.id = typeof(params.tableId) == 'undefined' ? '' : params.tableId;
		// create THEAD element
		params.tHeadNode = document.createElement("THEAD");
		params.tableNode.appendChild(params.tHeadNode);
		// create TBODY element
		params.tBodyNode = document.createElement("TBODY");
		params.tableNode.appendChild(params.tBodyNode);
		
		params.tBodyNode.onmouseover = function(e) {
			if (typeof(params.rowhoverclass) == 'undefined') return;
			
			//var e = e || window.event;
			var target = self.getTargetElem(e);

			switch(target.nodeName) {
				case 'TR':
					// do nothing
				break;
				
				case 'TD':
				case 'TH':
					target = target.parentNode;
				break;
				
				default:
					return; // exit handler
				break;
			}
			//alert(target.nodeName);
			
			target.className += (target.className.length == 0? '': ' ') 
							   + (typeof(params.rowhoverclass) == 'undefined' ? '' : params.rowhoverclass);
		}; // onmouseover
		
		params.tBodyNode.onmouseout = function(e) {
			if (typeof(params.rowhoverclass) == 'undefined') return;
			
			//var e = e || window.event;
			var target = self.getTargetElem(e);

			switch(target.nodeName) {
				case 'TR':
					// do nothing
				break;
				
				case 'TD':
				case 'TH':
					target = target.parentNode;
				break;
				
				default:
					return; // exit handler
				break;
			}
			
			var pattern = new RegExp(' ' + params.rowhoverclass);
			target.className = target.className.replace(pattern, '');
		}; // onmouseout
		
		params.tBodyNode.onclick = function(e) {
			if (!e) var e = window.event;
			if (e.target) var target = e.target;
			else if (e.srcElement) var target = e.srcElement;
			if (target.nodeType == 3) target = target.parentNode;
			// adjusted for propagation
			switch(target.nodeName) {
				case 'TR':
					// do nothing
				break;
				
				case 'TD':
				case 'TH':
					target = target.parentNode;
				break;
				
				default:
					return; // exit handler
				break;
			}
			
			/*
			var message = 'Firstname: ' + target.childNodes[0].firstChild.nodeValue +
						  'Lastname: ' + target.childNodes[1].firstChild.nodeValue +
						  'Email: ' + target.childNodes[2].firstChild.nodeValue;
						  
			alert(message);
			*/
			
			var message = 'Firstname: ' + params.dataList[target.appData.arrayIndex].firstname +
						  ' Lastname: ' + params.dataList[target.appData.arrayIndex].lastname +
						  ' Email: ' + params.dataList[target.appData.arrayIndex].email;
						  
			alert(message);
			
			
		}; // onclick
		
		self.updateTHead();
		self.updateTBody();
	}; // buildTable
	
	this.updateTHead = function(parameters) {
		// Parameters: columnheaders []
		if (typeof(parameters) != 'undefined')
			if (typeof(parameters.columnheaders) != 'undefined') params.columnheaders = parameters.columnheaders;
		
		//params.tHeadNode.innerHTML = ''; // clear contents of THEAD
		// must use DOM methods to clear container instead of innerHTML thanks to IE8
		// see http://stackoverflow.com/questions/555965/javascript-replace-innerhtml-throwing-unknown-runtime-error
		while (params.tHeadNode.hasChildNodes())
			params.tHeadNode.removeChild(params.tHeadNode.firstChild);
		
		// create table head section
		var tRowElem = document.createElement("TR");
		params.tHeadNode.appendChild(tRowElem);
		/*
		if (typeof(params.columnheaders) != 'undefined') {
			for (var c = 0; c < params.columnheaders.length; c++) {
				var thElem = document.createElement("TH");
				tRowElem.appendChild(thElem);
				thElem.appendChild(document.createTextNode(params.columnheaders[c]));
			}
		} else {
			for (var key in params.dataList[0]) {
				var thElem = document.createElement("TH");
				tRowElem.appendChild(thElem);
				thElem.appendChild(document.createTextNode(key.toUpperCase()));
			}
		}
		*/
		var c = 0;
		for (var key in params.dataList[0]) {
			var thElem = document.createElement("TH");
			tRowElem.appendChild(thElem);
			if (typeof(params.columnheaders) != 'undefined') {
				var columnLabel = typeof(params.columnheaders[c]) != 'undefined'? params.columnheaders[c]: key.toUpperCase();
			} else var columnLabel = key.toUpperCase();
			thElem.appendChild(document.createTextNode(columnLabel));
			c++;
		}
	}; // updateTHead
	
	this.updateTBody = function(parameters) {
		// Parameters: dataList
		if (typeof(parameters) != 'undefined')
			if (typeof(parameters.dataList) != 'undefined') params.dataList = parameters.dataList;
		
		// params.tBodyNode.innerHTML = ''; // clear contents of TBODY
		// must use DOM methods to clear container instead of innerHTML thanks to IE8
		// see http://stackoverflow.com/questions/555965/javascript-replace-innerhtml-throwing-unknown-runtime-error
		while (params.tBodyNode.hasChildNodes())
			params.tBodyNode.removeChild(params.tBodyNode.firstChild);
		
		// create table body section
		for (var c = 0; c < params.dataList.length; c++) {
			var tRowElem = document.createElement("TR");
			params.tBodyNode.appendChild(tRowElem);
			
			tRowElem.appData = {arrayIndex: c}; // storing custom app data inside DOM element
			
			tRowElem.className = typeof(params.rowclass) == 'undefined' ? '' : params.rowclass;
			// add striping classes
			if (c % 2 == 0) {
				// odd row
				tRowElem.className += (tRowElem.className.length == 0? '': ' ') 
								   + (typeof(params.oddrowclass) == 'undefined' ? '' : params.oddrowclass);
			} else {
				// even row
				tRowElem.className += (tRowElem.className.length == 0? '': ' ') 
								   + (typeof(params.evenrowclass) == 'undefined' ? '' : params.evenrowclass);
			}
			
			for (var key in params.dataList[c]) {
				var tdElem = document.createElement("TD");
				tRowElem.appendChild(tdElem);
				tdElem.appendChild(document.createTextNode(params.dataList[c][key]));
			}
			
		}
	}; // updateTBody
	
	this.render = function(targetNode) {
		// render simple appends the table to a specific location
		targetNode.appendChild(params.tableNode);
	}; // render
	
	this.getTargetElem = function(e) {
		//alert(this.nodeName);
		if (!e) var e = window.event;
		if (e.target) var target = e.target;
		else if (e.srcElement) var target = e.srcElement;
		if (target.nodeType == 3) target = target.parentNode;
		// adjusted for propagation
		//alert(target.nodeName);
		return target;
	}; // getTargetRow
	
	// this must come AFTER defining member methods that will be called
	var self = this;
	var params = typeof(parameters) != 'undefined'? parameters: {};
	/*
	Parameters: 
		targetNode
		dataList
		oddrowclass
		evenrowclass
		rowhoverclass
		rowclass
		tableId
		tableNode
		tHeadNode
		tBodyNode
	*/
	self.buildTable();
} // HTMLTable






