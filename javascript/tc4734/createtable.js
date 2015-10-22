
function createTable(params) {
	// options properties: rowData, columnNames, oddRowClassName, evenRowClassName
	var tableElem = document.createElement("TABLE"); // create new element node
	// create table header
	var theadElem = document.createElement("THEAD");
	tableElem.appendChild(theadElem);
	
	var trElem = document.createElement("TR"); // create a row for the THEAD
	theadElem.appendChild(trElem);
	
	for (var c = 0; c < params.columnNames.length; c++) {
		//alert(field);
		var tdElem = document.createElement("TH");
		trElem.appendChild(tdElem);
		tdElem.appendChild(document.createTextNode(params.columnNames[c]));
	}
	
	var tbodyElem = document.createElement("TBODY"); // create TBODY
	tableElem.appendChild(tbodyElem);
	
	// loop through contactList
	for (var c = 0; c < params.rowData.length; c++) {
		
		// create new row for each contact
		var trElem = document.createElement("TR");
		tbodyElem.appendChild(trElem);
		// apply even or odd classes to rows
		if (c % 2 == 0) {
			if (params.oddRowClassName) trElem.className = params.oddRowClassName; // the first row (1) starts at array index 0
		} else {
			if (params.evenRowClassName) trElem.className = params.evenRowClassName;
		}
		
		// loop through contact fields and create column for each field
		for (var field in params.rowData[c]) {
			//alert(field);
			var tdElem = document.createElement("TD");
			trElem.appendChild(tdElem);
			tdElem.appendChild(document.createTextNode(params.rowData[c][field]));
		}
	} // for params.rowData

	return tableElem; // returns completed table
} // createTable