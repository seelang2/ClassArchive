// JavaScript Document
var Registry = new function() {
	this.leaderboardDiv = null;
	this.statusDiv = null;
	this.itemDiv = null;
	this.ajaxPoll = null;
	this.ajaxRecord = null;
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
		Registry.itemDiv = document.getElementById("itemdata");
		Registry.ajaxPoll = new Ajax();
		Registry.ajaxRecord = new Ajax();
		
		//Leaderboard.displayBoard();
		// set up polling timer event
		Registry.poll = setInterval(Leaderboard.getUpdate, 1000);
	}; // init
	
	this.cleanup = function() {
		
	}; // cleanup
	
	this.getUpdate = function() {
		// abort any current request to avoid collision errors
		Registry.ajaxPoll.abort();
		
		// set up caching workaround
		var x = new Date();
		x = x.getTime();
		Registry.ajaxPoll.doGet('demo3.php?action=show&output=xml&x=' + x, Leaderboard.displayBoard, 'xml');
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
		
		var tempElem = document.createElement("TABLE");
		Registry.leaderboardDiv.appendChild(tempElem);
		
		tempElem.onclick = function(e) {
			if(!e) var e = window.event;
			
			target = getTargetElem(e);
			while(target.nodeName != "TR")
				target = target.parentNode;
			
			//alert(target.nodeName);
			Leaderboard.getItemData(target.id.split('_')[1])
		};
		
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
		
		Registry.statusDiv.style.visibility = 'hidden';
	}; // displayBoard
	
	this.getItemData = function(id) {
		// abort any current request to avoid potential collisions
		Registry.ajaxRecord.abort();
		
		// set up caching workaround
		var x = new Date();
		x = x.getTime();
		Registry.ajaxRecord.doGet('demo3.php?action=show&id='+id+'&x='+x, Leaderboard.displayItem, 'text');
	}; // getItemData
	
	this.displayItem = function(response) {
		if (response.substr(0, 5) == 'Error') {
			alert ('There was an error encountered.' + "\n" + response);
			return;
		}
		
		Registry.itemDiv.innerHTML = '';
		
		// parse records into columns and values
		var columns = response.split(',');
		
		var formDiv = document.createElement("FORM");
		Registry.itemDiv.appendChild(formDiv);
		formDiv.action = '#';
		formDiv.method = 'post';
		formDiv.onsubmit = function() {
			
			// abort any current request to avoid potential collisions
			Registry.ajaxRecord.abort();
			
			formData = formData2QueryString(this);
			//text = this.id.split('_')[1];
			//alert(this.id.value);
			//return false;
			
			// set up caching workaround
			var x = new Date();
			x = x.getTime();
			Registry.ajaxRecord.doPost('demo3.php?action=update&id='+this.id.value+'&x='+x, 
									   formData,
									   Leaderboard.updateReturn, 
									   'text');
				
			return false;
		}; 
		
		//tempDiv.id = 'item_' + columns[0].split('=')[1];
		
		for (var c = 0; c < columns.length; c++) {

			var field = columns[c].split('=');
			
			var tempDiv = document.createElement("DIV");
			formDiv.appendChild(tempDiv);

			switch (field[0]) {
				case 'status':
					//alert(field[1]);
					
					var tempElem = document.createElement("INPUT");
					tempElem.name = field[0];
					tempElem.type = 'radio';
					tempDiv.appendChild(tempElem);
					tempElem.value = '1'; //field[1]
					if (field[1] == '1') tempElem.checked = 'checked';
					tempDiv.appendChild(document.createTextNode('Ok'));
					var tempElem = document.createElement("BR");
					tempDiv.appendChild(tempElem);
			
					var tempElem = document.createElement("INPUT");
					tempElem.name = field[0];
					tempElem.type = 'radio';
					tempDiv.appendChild(tempElem);
					tempElem.value = '2'; //field[1]
					if (field[1] == '2') tempElem.checked = 'checked';
					tempDiv.appendChild(document.createTextNode('Followup'));
					var tempElem = document.createElement("BR");
					tempDiv.appendChild(tempElem);
			
					var tempElem = document.createElement("INPUT");
					tempElem.name = field[0];
					tempElem.type = 'radio';
					tempDiv.appendChild(tempElem);
					tempElem.value = '3'; //field[1]
					if (field[1] == '3') tempElem.checked = 'checked';
					tempDiv.appendChild(document.createTextNode('Need Attention'));
					var tempElem = document.createElement("BR");
					tempDiv.appendChild(tempElem);
					
				break;
				default:
					if (field[0] == 'id') formDiv.id = 'record_' + field[1];
					
					var tempElem = document.createElement("LABEL");
					tempDiv.appendChild(tempElem);
					tempElem.appendChild(document.createTextNode(field[0].toUpperCase()));
					
					var tempElem = document.createElement("INPUT");
					tempDiv.appendChild(tempElem);
					
					tempElem.value = field[1];
					tempElem.name = field[0];
					tempElem.id = field[0];
					tempElem.readOnly = 'readOnly';
				break;
			}
		}
		var tempDiv = document.createElement("DIV");
		formDiv.appendChild(tempDiv);

		var tempElem = document.createElement("INPUT");
		tempElem.type = 'submit';
		tempElem.value = 'Update';
		// note that IE requires that you set the type before appending to tree
		tempDiv.appendChild(tempElem); 

	}; // displayItem
	
	this.updateReturn = function(response) {
		if (response == 'Ok')
			alert('Record successfully updated.');
		else
			alert('Error encountered saving record.');
	}; // updateReturn
}; // Leaderboard


window.onload = Leaderboard.init;
window.onunload = Leaderboard.cleanup;