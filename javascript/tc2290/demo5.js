// JavaScript Document
var Tabs = new function() {
	this.links = null;
	this.contentDiv = null;
	this.ajax = null;
	this.pollTimer = null;
	this.status = 'ALL';
	
	this.init = function() {
		Tabs.links = getElementsByClassName("tablink", "LI", document.getElementById("tabcontainer"));
		Tabs.contentDiv = document.getElementById("content");
		Tabs.ajax = new Ajax();
		
		for(var c = 0; c < Tabs.links.length; c++) {
			Tabs.links[c].onclick = function() {
				// clear away any existing interval timers
				clearInterval(Tabs.pollTimer);
				Tabs.pollTimer = null; // clearInterval doesn't set variable to null
				// abort any requests in progress
				Tabs.ajax.abort();
				
				Tabs.status = this.id.split('-')[1];
				Tabs.getUpdate();
				//document.body.style.cursor = 'wait';
			};
		}
		
	}; // init;
	
	this.getUpdate = function() {
		
		// abort any current request to avoid collision errors
		Tabs.ajax.abort();
		
		// set up caching workaround
		var x = new Date();
		x = x.getTime();
		Tabs.ajax.doGet('demo3.php?action=show&output=xml&status='+ Tabs.status +'&x=' + x, 
						Tabs.displayBoard, 
						'xml');
	}; // getUpdate

	this.displayBoard = function(response) {
		if (response == null) {
			alert ('There was an error encountered.' + "\n" + Tabs.ajax.responseText);
			return;
		}
		
		purge(Tabs.contentDiv);
		
		// clear tree using DOM method
		while (Tabs.contentDiv.hasChildNodes())
			Tabs.contentDiv.removeChild(Tabs.contentDiv.firstChild);
		
		// clear tree - innerHTML method
		//Registry.leaderboardDiv.innerHTML = '';
		
		patientList = response.getElementsByTagName("patient");
		
		var tempElem = document.createElement("TABLE");
		Tabs.contentDiv.appendChild(tempElem);
		
		var tempTbody = document.createElement("TBODY");
		tempElem.appendChild(tempTbody);

		for(var i = 0; i < patientList.length; i++) {
			
			var tempRow = document.createElement("TR");
			tempTbody.appendChild(tempRow);
			
			for (var c = 0; c < patientList[i].childNodes.length; c++) {
				if (patientList[i].childNodes[c].nodeType == 1) {
					if (patientList[i].childNodes[c].nodeName == 'id')
						tempRow.id = 'item_' + patientList[i].childNodes[c].firstChild.nodeValue;
					
					if (patientList[i].childNodes[c].nodeName == 'status') {
						switch(patientList[i].childNodes[c].firstChild.nodeValue) {
							case '1': break;
							case '2': tempRow.className = 'followup'; break;
							case '3': tempRow.className = 'attention'; break;
						} // switch
					}
					
					var tempElem = document.createElement("TD");
					tempRow.appendChild(tempElem);
					tempElem.appendChild(
						document.createTextNode(patientList[i].childNodes[c].firstChild.nodeValue)
					);
				}
			}
		}
		
		//document.body.style.cursor = 'default';
		
		if (Tabs.pollTimer == null) Tabs.pollTimer = setInterval(Tabs.getUpdate, 1000);
		
	}; // displayBoard

}; // tabs

window.onload = Tabs.init;
window.onunload = Tabs.cleanup;