// JavaScript Document
var Registry = new function() {
	this.leaderboardDiv = null;
	this.ajax = null;
	/*
	this.tempData = "id=1,name='John Doe',status=1;" + 
					"id=2,name='Jane Smith',status=1;" + 
					"id=3,name='Foo Bar',status=1";
	*/
}; // Registry

var Leaderboard = new function() {
	this.init = function() {
		Registry.leaderboardDiv = document.getElementById("leaderboard");
		Registry.ajax = new Ajax();
		
		Registry.ajax.doGet('demo3.php?action=show', Leaderboard.displayBoard, 'text');
		//Leaderboard.displayBoard();
		
	}; // init
	
	this.cleanup = function() {
		
	}; // cleanup
	
	this.displayBoard = function(response) {
		if (response.substr(0, 5) == 'Error') {
			alert ('There was an error encountered.' + "\n" + response);
			return;
		}
		//response = Registry.tempData;
		
		//parse records in response string
		var records = response.split(';');

		var tempElem = document.createElement("TABLE");
		Registry.leaderboardDiv.appendChild(tempElem);
		
		var tempTbody = document.createElement("TBODY");
		tempElem.appendChild(tempTbody);

		for(var i = 0; i < records.length; i++) {
			
			// parse records into columns and values
			var columns = records[i].split(',');
						
			var tempRow = document.createElement("TR");
			tempTbody.appendChild(tempRow);
			tempRow.id = 'item_' + columns[0].split('=')[1];
			
			for (var c = 0; c < columns.length; c++) {
				
				var tempElem = document.createElement("TD");
				tempRow.appendChild(tempElem);
				tempElem.appendChild(document.createTextNode(columns[c].split('=')[1]));
				
			}
			
		}
		
		
	}; // displayGallery
	
}; // Gallery


window.onload = Leaderboard.init;
window.onunload = Leaderboard.cleanup;