// JavaScript Document
var Registry = new function() {
	this.leaderboardDiv = null;
	this.statusDiv = null;
	this.ajax = null;
	this.poll = null;
	/*
	this.tempData = "id=1,name='John Doe',status=1;" + 
					"id=2,name='Jane Smith',status=1;" + 
					"id=3,name='Foo Bar',status=1";
	*/
}; // Registry

var Leaderboard = new function() {
	this.init = function() {
		Registry.leaderboardDiv = document.getElementById("leaderboard");
		Registry.statusDiv = document.getElementById("status");
		Registry.ajax = new Ajax();
		
		//Leaderboard.displayBoard();
		// set up polling timer event
		Registry.poll = setInterval(Leaderboard.getUpdate, 1000);
	}; // init
	
	this.cleanup = function() {
		
	}; // cleanup
	
	this.getUpdate = function() {
		
		Registry.ajax.doGet('demo3.php?action=show&output=xml', Leaderboard.displayBoard, 'xml');
		Registry.statusDiv.style.visibility = 'visible';
	}; // getUpdate
	
	this.displayBoard = function(response) {
		if (response == null) {
			alert ('There was an error encountered.' + "\n" + Registry.ajax.responseText);
			return;
		}
		
		purge(Registry.leaderboardDiv);
		
		// clear tree using DOM method
		while (Registry.leaderboardDiv.hasChildNodes())
			Registry.leaderboardDiv.removeChild(Registry.leaderboardDiv.firstChild);
		
		// clear tree - innerHTML method
		//Registry.leaderboardDiv.innerHTML = '';
		
		patientList = response.getElementsByTagName("patient");
		
		//alert(patientList.length);
		//alert('Number of childen in patient: ' + patientList[0].childNodes.length);
		//for (x = 0; x < patientList[0].childNodes.length; x++) {
			/*
			alert('Node Type: ' + patientList[0].childNodes[x].nodeType + "\n" + 
				  'Node Name: ' + patientList[0].childNodes[x].nodeName + "\n" +
				  'Node Value: ' + patientList[0].childNodes[x].nodeValue + "\n" +
				  '# Attributes: ' + patientList[0].childNodes[x].attributes.length);
			*/
			/*
			if (patientList[0].childNodes[x].nodeType == 1) {
				alert('Node Name: ' + patientList[0].childNodes[x].nodeName + "\n" +
					  'Text: ' + patientList[0].childNodes[x].firstChild.nodeValue);
			}
			*/
		//}
		//return;
		
		var tempElem = document.createElement("TABLE");
		Registry.leaderboardDiv.appendChild(tempElem);
		
		var tempTbody = document.createElement("TBODY");
		tempElem.appendChild(tempTbody);

		for(var i = 0; i < patientList.length; i++) {
			
			var tempRow = document.createElement("TR");
			tempTbody.appendChild(tempRow);
			
			for (var c = 0; c < patientList[i].childNodes.length; c++) {
				if (patientList[i].childNodes[c].nodeType == 1) {
					if (patientList[i].childNodes[c].nodeName == 'id')
					tempRow.id = 'item_' + patientList[i].childNodes[c].firstChild.nodeValue;
					var tempElem = document.createElement("TD");
					tempRow.appendChild(tempElem);
					tempElem.appendChild(
						document.createTextNode(patientList[i].childNodes[c].firstChild.nodeValue)
					);
				}
			}
		}
		
		Registry.statusDiv.style.visibility = 'hidden';
	}; // displayBoard
	
}; // Gallery


window.onload = Leaderboard.init;
window.onunload = Leaderboard.cleanup;