// JavaScript Document

function showDetails(id) {
	var index = id.split('-')[1];
	
	var resultDiv = document.getElementById("resultset");
	
	resultDiv.innerHTML = ''; // clear contents of div
	// create control link
	var aElem = document.createElement("A");
	aElem.href = '#';
	resultDiv.appendChild(aElem);
	aElem.onclick = function() {
		document.getElementById("resultset").style.display = 'none';
		document.getElementById("screen").style.display = 'none';
		return false; // cancel click action
	};
	
	aElem.appendChild(document.createTextNode('Close'));
	
	var resultDataDiv = document.createElement("DIV");
	resultDataDiv.id = 'resultdata';
	resultDiv.appendChild(resultDataDiv);
	
	// the innerHTML method
	resultDataDiv.innerHTML = '<h2>Contact Details:</h2><p>' +
						  contacts[index].firstname + '<br />' +
						  contacts[index].lastname + '<br />' +
						  contacts[index].phone + '<br />' +
						  contacts[index].email + '</p>';
	
	document.getElementById("screen").style.display = 'block';
	resultDiv.style.display = 'block';
} // showDetails

// define contacts object array
var contacts =	[{firstname:'John',lastname:'Candy',phone:'312-555-1212',email:'john@email.com'},
				 {firstname:'Cameron',lastname:'Crowe',phone:'123-456-7890',email:'cam@email.com'},
				 {firstname:'Jessica',lastname:'Biel',phone:'773-588-2300',email:'jessie@email.com'},
				 {firstname:'Timothy',lastname:'Hutton',phone:'847-123-5789',email:'tim@email.com'},
				 {firstname:'Sigourney',lastname:'Weaver',phone:'312-999-8700',email:'js@email.com'},
				 {firstname:'Susan',lastname:'Sarandon',phone:'510-555-7748',email:'ss@email.com'},
				 {firstname:'Alfred',lastname:'Finney',phone:'213-555-9085',email:'alf@email.com'},
				 {firstname:'Claire',lastname:'Danes',phone:'312-282-3243',email:'claire@email.com'}
				 ];

var tableDiv = document.getElementById("datatable");

var tableElem = document.createElement("TABLE");
tableDiv.appendChild(tableElem);

var tBodyElem = document.createElement("TBODY");
tableElem.appendChild(tBodyElem);

var rowElem = document.createElement("TR");
tBodyElem.appendChild(rowElem);

var tdElem = document.createElement("TH");
rowElem.appendChild(tdElem);
tdElem.appendChild(document.createTextNode("Firstname"));

tdElem = document.createElement("TH");
rowElem.appendChild(tdElem);
tdElem.appendChild(document.createTextNode("Lastname"));

tdElem = document.createElement("TH");
rowElem.appendChild(tdElem);
tdElem.appendChild(document.createTextNode("Phone"));

tdElem = document.createElement("TH");
rowElem.appendChild(tdElem);
tdElem.appendChild(document.createTextNode("Email"));

// loop through contacts array and display table columns
for (var c = 0; c < contacts.length; c++) {
	
	rowElem = document.createElement("TR");
	tBodyElem.appendChild(rowElem);
	if (c % 2 == 0) {
		rowElem.className = 'evenrow';
	} else {
		rowElem.className = 'oddrow';
	}
	rowElem.id = 'row-' + c;
	
	// apply hover effect
	rowElem.onmouseover = function() {
		this.className += ' rowhover';
		
	}; // onmouseover
	
	rowElem.onmouseout = function() {
		this.className = this.className.replace(' rowhover', '');
	}; // onmouseout
	
	rowElem.ondblclick = function() {
		showDetails(this.id);
	}
	
	tdElem = document.createElement("TD");
	rowElem.appendChild(tdElem);
	tdElem.appendChild(document.createTextNode(contacts[c].firstname));
	
	tdElem = document.createElement("TD");
	rowElem.appendChild(tdElem);
	tdElem.appendChild(document.createTextNode(contacts[c].lastname));
	
	tdElem = document.createElement("TD");
	rowElem.appendChild(tdElem);
	tdElem.appendChild(document.createTextNode(contacts[c].phone));
	
	tdElem = document.createElement("TD");
	rowElem.appendChild(tdElem);
	tdElem.appendChild(document.createTextNode(contacts[c].email));
	
} // for contacts


