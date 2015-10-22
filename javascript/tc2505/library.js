// JavaScript Document
function createTable(tableData) {
	var tableElem = document.createElement("TABLE");
	
	var tHeadElem = document.createElement("THEAD");
	tableElem.appendChild(tHeadElem);
	
	var tRowElem = document.createElement("TR");
	tHeadElem.appendChild(tRowElem);
	
	for (var col = 0; col < tableData[0].length; col++) {
		tempElem = document.createElement("TH");
		tRowElem.appendChild(tempElem);
		tempElem.appendChild(document.createTextNode(tableData[0][col]));
	}
	
	var tBodyElem = document.createElement("TBODY");
	tableElem.appendChild(tBodyElem);
	
	for (var row = 1; row < tableData.length; row++) {
		tRowElem = document.createElement("TR");
		tBodyElem.appendChild(tRowElem);
		// check whether the row is even or odd using modulus
		if (row % 2 == 0) {
			tRowElem.className = 'evenrow';
		} else {
			tRowElem.className = 'oddrow';
		}
		// assign row id value
		tRowElem.id = 'row-' + row;
		
		// set event handlers for hover effect
		tRowElem.onmouseover = function() {
			this.className += ' tablerowhover';
			//alert('Row mouseover event');
		} // onmouseover
		
		tRowElem.onmouseout = function() {
			/* method 1: using arrays and split
			// split classnames into array
			var classList = this.className.split(' ');
			this.className = ''; // clear classes
			// loop through array and add classes back (except tablerowhover)
			for (var c = 0; c < classList.length; c++) {
				if (classList[c] != 'tablerowhover') {
					if (c > 0) this.className += ' ';
					this.className += classList[c];
				}
			}
			*/
			/* Method 2: using replace method */
			this.className = this.className.replace(' tablerowhover','');
			//alert('Row mouseout event');
		} // onmouseout
		
		for (var col = 0; col < tableData[row].length; col++) {
			tempElem = document.createElement("TD");
			tRowElem.appendChild(tempElem);
			tempElem.appendChild(document.createTextNode(tableData[row][col]));
		}
	}
	
	return tableElem; // return table node containing completed table
} // createTable

