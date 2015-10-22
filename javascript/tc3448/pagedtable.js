// JavaScript Document
function PagedTable() {
	this.pageSize = 5; // # of rows to display per page
	this.pageOffset = 0; // starting record number
	var self = this; // use a local variable to refer to the PagedTable instance
	
	// target = DOM node to place paged table, data = table data
	this.display = function(target, data) {
		this.data = data; // store table data as property of object
		// create control div
		var controlDiv = document.createElement("DIV");
		controlDiv.id = 'pagetable-control';
		target.appendChild(controlDiv);
		
		controlDiv.appendChild(document.createTextNode('Show: '));
		
		var selectElem = document.createElement("SELECT");
		controlDiv.appendChild(selectElem);
		
		selectElem.onchange = function() {
			self.pageSize = parseInt(this.value); // parseInt makes sure this is a number

			// see if we need to re-enable the next button
			if (self.pageOffset + self.pageSize < self.data.length) {
				// next page available, hide button
				butElemNext.style.display = 'inline';
			}
			
			// see if we need to disable the next button
			if (self.pageOffset + self.pageSize >= self.data.length) {
				// no next page available, hide button
				butElemNext.style.display = 'none';
			}

			self.drawTableData();
		}; // onchange
		
		// use array to store option values
		var optionValues = [5,10,20];
		// now iterate through optionvalues array to create option elements
		for (var c in optionValues) {
			var optionElem = document.createElement("OPTION");
			optionElem.value = optionValues[c];
			selectElem.appendChild(optionElem);
			optionElem.appendChild(document.createTextNode(optionValues[c]));
		}
		
		controlDiv.appendChild(document.createTextNode(' '));
		
		var butElemPrev = document.createElement("INPUT");
		butElemPrev.type = 'button';
		butElemPrev.value = 'Prev';
		controlDiv.appendChild(butElemPrev);
		
		butElemPrev.onclick = function() {
			self.pageOffset -= self.pageSize;
			if (self.pageOffset <= 0) {
				self.pageOffset = 0;
				// hide previous button
				butElemPrev.style.display = 'none';
			}
			
			// see if we need to re-enable the next button
			if (self.pageOffset + self.pageSize < self.data.length) {
				// next page available, hide button
				butElemNext.style.display = 'inline';
			}
			self.drawTableData();
		}
		
		controlDiv.appendChild(document.createTextNode(' '));
		
		var butElemNext = document.createElement("INPUT");
		butElemNext.type = 'button';
		butElemNext.value = 'Next';
		controlDiv.appendChild(butElemNext);
		
		butElemNext.onclick = function() {
			self.pageOffset += self.pageSize;
			
			// re-enable prev button
			butElemPrev.style.display = 'inline';
			
			// see if we need to disable the next button
			if (self.pageOffset + self.pageSize >= self.data.length) {
				// no next page available, hide button
				butElemNext.style.display = 'none';
			}
			self.drawTableData();
		}
		
		// create data table 
		this.tableElem = document.createElement("TABLE");
		this.tableElem.id = 'pagetable-data';
		target.appendChild(this.tableElem);
		
		// create header section
		var theadElem = document.createElement("THEAD");
		this.tableElem.appendChild(theadElem);

		var trElem = document.createElement("TR");
		theadElem.appendChild(trElem);
		for (var c in data[0]) {
			var tdElem = document.createElement("TH");
			trElem.appendChild(tdElem);
			tdElem.appendChild(document.createTextNode(c.toUpperCase()));
		}

		this.tbodyElem = document.createElement("TBODY");
		this.tableElem.appendChild(this.tbodyElem);

		this.drawTableData();
		
	}; // display
	
	this.drawTableData = function() {
		// wipe out contents of tbody BEFORE redrawing rows :)
		// method 1: using DOM methods
		while (this.tbodyElem.hasChildNodes()) 
			this.tbodyElem.removeChild(this.tbodyElem.firstChild);
		
		// method 2: using innerHTML
		this.tbodyElem.innerHTML = '';
		
		alert('Offset: ' + this.pageOffset + '\n' +
			  'Pagesize: ' + this.pageSize + '\n' +
			  ''
			  );
		
		// loop through data array
		for (var r = this.pageOffset; r < this.pageOffset + this.pageSize; r++) {
			if (r >= this.data.length) break; // terminate loop
			
			var trElem = document.createElement("TR");
			this.tbodyElem.appendChild(trElem);
			if (r % 2 == 0) {
				// ODD row
				trElem.className = 'pagetable-oddrow';
			} else {
				// even row
				trElem.className = 'pagetable-evenrow';
			}
			
			trElem.onmouseover = function() {
				this.className += ' pagetable-rowhover';
			}; // onmouseover
			
			trElem.onmouseout = function() {
				this.className = this.className.replace(/ pagetable-rowhover/, '');
			}; // onmouseover
			
			for (var c in this.data[r]) {
				var tdElem = document.createElement("TD");
				trElem.appendChild(tdElem);
				tdElem.appendChild(document.createTextNode(this.data[r][c]));
			}
		}
	}; // drawTableData
	
} // PagedTable

