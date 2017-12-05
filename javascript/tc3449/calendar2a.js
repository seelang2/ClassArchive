var weekdays = ["Sun","Mon","Tue","Wed","Thu","Fri","Sat"];

// get reference to calendar div
var calendarDiv = document.getElementById("calendar");

var tableElem = document.createElement("TABLE"); // create new element node
calendarDiv.appendChild(tableElem); // append new child to its parent node

var tbodyElem = document.createElement("TBODY");
tableElem.appendChild(tbodyElem);

var rowElem = document.createElement("TR");
tbodyElem.appendChild(rowElem);

var thElem = document.createElement("TH");
rowElem.appendChild(thElem);
thElem.colSpan = weekdays.length;

var textNode = document.createTextNode("April");
thElem.appendChild(textNode);

var rowElem = document.createElement("TR");
tbodyElem.appendChild(rowElem);

// for each element in weekdays array
for(var c = 0; c < weekdays.length; c++) {
	var tdElem = document.createElement("TD"); // create td
	rowElem.appendChild(tdElem); // add td to row
	tdElem.appendChild(document.createTextNode(weekdays[c])); // add weekdays element data to td
}

// build body of the calendar

var columnNum = 1; // initialize column counter
// loop through days in month
for(dayNum = 1; dayNum < 29; dayNum++) {
	// if columnNum is 1 then I'm on a new row
	if (columnNum == 1) {
		var rowElem = document.createElement("TR"); // create new row
		tbodyElem.appendChild(rowElem); // add row to tbody
	}
	var tdElem = document.createElement("TD"); // create new column
	rowElem.appendChild(tdElem); // add column to row
	var textNode = document.createTextNode(dayNum); // create text for column
	tdElem.appendChild(textNode); // add text to column
	columnNum++; // increment columnNum
	// reset columnNum every 7 columns
	if (columnNum > 7) {
		columnNum = 1;
	}
} // for dayNum








