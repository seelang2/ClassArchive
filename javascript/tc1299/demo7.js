// JavaScript Document

PageData = new function() {
	this.inputField = null;
	this.autoTable = null;
	this.ajaxreq = null;
	this.inputText = '';
	this.rowCounter = -1;
}; 

DemoApp = new function() {

	this.init = function() {
		PageData.inputField = document.getElementById("input");
		PageData.autoTable = document.getElementById("autocomplete");
		PageData.ajaxreq = new Ajax();
		PageData.ajaxreq.async = true;
		
		PageData.inputField.onkeyup = DemoApp.handleKeyPress; // fix for ie not recognizing window.onkeyup
		PageData.inputField.focus();
	};
	
	this.cleanup = function() {
		PageData.inputField = null;
		PageData.autoTable = null;
		PageData.inputText = null;
	};
	
	this.handleKeyPress = function(e) {
		
		if (!e) e = window.event;
		
		if (e.keyCode != 13 && e.keyCode != 27 && e.keyCode != 38 && e.keyCode != 40) {
			if (PageData.inputField.value.length < 1) {
				PageData.autoTable.style.visibility = 'hidden';
			}
			
			if (Math.abs(PageData.inputField.value.length - PageData.inputText.length) > 0 ) { 
				PageData.inputText = PageData.inputField.value;
				
				// do ajax call
				if (PageData.inputText.length > 0) {
					
					DemoApp.doAjaxRequest();
				}
			}
			
		} else {
			// special key was pressed
			switch (e.keyCode)
			{
				case 27: // esc 
					PageData.inputText = '';
					PageData.inputField.value = '';
					PageData.autoTable.style.visibility = 'hidden';
					PageData.rowCounter = -1;
				break;
				case 13: // enter
					// submit query to server
					PageData.rowCounter = -1;
					DemoApp.doSubmit();
				break;
				case 38: // up arrow
					oldrow = PageData.rowCounter;
					PageData.rowCounter--;
					if (PageData.rowCounter < -1) {
						PageData.rowCounter = -1;
						// move oldrow to previous old row to get out of the way
						oldrow = PageData.rowCounter + 1;
					}
					DemoApp.doRow(oldrow);
				break;
				case 40: // down arrow
					oldrow = PageData.rowCounter;
					PageData.rowCounter++;
					if (PageData.rowCounter > 7) {
						PageData.rowCounter = 7;
						// move oldrow to previous old row to get out of the way
						oldrow = PageData.rowCounter - 1;
					}
					DemoApp.doRow(oldrow);
				break;
			}
		}
	};
	
	this.doAjaxRequest = function() {
		//alert('ajax call for ' + PageData.inputText);
		
		x = new Date();
		x = x.getTime();
		
		PageData.ajaxreq.abort();
		PageData.ajaxreq.doGet('names.php?name=' + PageData.inputText + '&x=' + x, DemoApp.updateTable, 'text');
	};
	
	this.doSubmit = function() {
		alert('Submitting search term ' + PageData.inputText);
		PageData.autoTable.style.visibility = 'hidden';
	};
	
	this.doRow = function(oldrow) {
		if (PageData.autoTable.style.visibility == 'visible') {
			// collect the rows in the table into an array
			rows = PageData.autoTable.getElementsByTagName("TR");
			//alert(rows.length);
			//alert(PageData.rowCounter + ',' + oldrow);

			if (PageData.rowCounter > -1) {
				rows[PageData.rowCounter].style.backgroundColor = '#0000ff';
				rows[PageData.rowCounter].style.color = '#ffffff';
			}
			
			// revert old row
			if (oldrow > -1) {
				rows[oldrow].style.backgroundColor = '#ffffff';
				rows[oldrow].style.color = '#000000';
			}
			
			// update field value
			if (PageData.rowCounter > -1) {
				DemoApp.updateField(rows[PageData.rowCounter].firstChild);
			}

		}
	};
	
	this.updateTable = function(data) {
		
		if (data.substr(0,5) == 'Error') {
			PageData.autoTable.style.visibility = 'hidden';
			return;
		}
		
		PageData.autoTable.innerHTML = data;

		PageData.autoTable.style.visibility = 'visible';
		
		PageData.autoTable.onclick = function(e) {
			target = getTargetElement(e);
			
			//alert(target.firstChild.nodeValue);
			DemoApp.updateField(target);
		};
		
		PageData.autoTable.ondblclick = function(e) {
			target = getTargetElement(e);
			
			DemoApp.updateField(target);
			DemoApp.doSubmit();
		};
		
		PageData.autoTable.onmouseover = function(e) {
			target = getTargetElement(e);
			target.style.backgroundColor = '#0000ff';
			target.style.color = '#ffffff';
		};
		
		PageData.autoTable.onmouseout = function(e) {
			target = getTargetElement(e);
			target.style.backgroundColor = '#ffffff';
			target.style.color = '#000000';
		};
		
	};
	
	this.updateField = function(target) {
		PageData.inputText = target.firstChild.nodeValue;
		PageData.inputField.value = target.firstChild.nodeValue;
	};
	
}; // DemoApp

function getTargetElement(e) {
	var target;
	if (!e) var e = window.event;
	if (e.target) target = e.target;
	else if (e.srcElement) target = e.srcElement;
	if (target.nodeType == 3) // defeat Safari bug
		target = target.parentNode;
	return target;
}


//window.onkeyup = DemoApp.handleKeyPress; // doesn't work in IE

window.onload = DemoApp.init;
window.onunload = DemoApp.cleanup;
