// JavaScript Document

// create singleton global data 'registry' object
var pageData = new function() {
	this.fieldListDiv = null;
	this.fieldSelect = null;
	this.contactTableDiv = null;
	this.contactCardDiv = null;
	this.ajax = new Ajax1();
	
	// page initialization
	this.init = function() {
		pageData.fieldListDiv = document.getElementById("fieldlist");
		pageData.fieldSelect = document.getElementById("fieldselect");
		pageData.contactTableDiv = document.getElementById("contacttable");
		pageData.contactCardDiv = document.getElementById("contactcard");
		statusDisplay.init(document.getElementById("statusbox"));
	};
	
	// to clean up and avoid memory leaks
	this.cleanup = function() {
		pageData.fieldListDiv = null;
		pageData.fieldSelect = null;
		pageData.contactTableDiv = null;
		pageData.contactCardDiv = null;
	};
};


// our contact application object
var contactApp = new function() {
	this.resultSet = [];
	this.l = 0;
	this.r = 5;
	this.currentRecordId = 0;
	this.tempRecord = null;
	
	this.init = function() {
		contactApp.initContactCard();
		contactApp.getResultSet();
		document.getElementById("contactform").onsubmit = function() { return false; };
	};
	
	this.initContactCard = function() {
		// hijack behaviors
/*
		document.getElementById("cc_close").onclick = function() {
			pageData.contactCardDiv.style.display = 'none';
			return false;
		};
*/
		document.getElementById("cc_close").onclick = function() {
			new Effect.SwitchOff(pageData.contactCardDiv);
		};
		
		document.getElementById("cc_save").onclick = contactApp.ccSaveRec;

		spanList = document.getElementById("contactform").getElementsByTagName("SPAN");
		spanCount = spanList.length;
		for (c = 0; c < spanCount; c++) {
			//alert(spanList[c].id);
			spanList[c].ondblclick = function() {
				//alert(this.id);
				contactApp.ccEditField(this);
			}
			
		}
		
		// make contact card draggable
		new Draggable("contactcard", {revert:false})
		
		
/*
		document.getElementById("test").onclick = function() {
			alert('clicked the test elem');
			return false;
		};
*/
	};
	
	this.initContactTable = function() {
		
	};
	
	this.displayContactCard = function(id) {
//		alert(id + "\n" + contactApp.resultSet[id].firstname + "\n" + contactApp.resultSet[id].lastname + "\n" + contactApp.resultSet[id].email);
		contactApp.currentRecordId = id;
		contactApp.tempRecord = contactApp.resultSet[id];

		temp = document.getElementById("firstname");
		temp.innerHTML = '';
		temp.appendChild(document.createTextNode(contactApp.resultSet[id].firstname));
		
		temp = document.getElementById("lastname");
		temp.innerHTML = '';
		temp.appendChild(document.createTextNode(contactApp.resultSet[id].lastname));
		
		temp = document.getElementById("addr1");
		temp.innerHTML = '';
		temp.appendChild(document.createTextNode(contactApp.resultSet[id].addr1));
		
		temp = document.getElementById("addr2");
		temp.innerHTML = '';
		temp.appendChild(document.createTextNode(contactApp.resultSet[id].addr2));
		
		temp = document.getElementById("city");
		temp.innerHTML = '';
		temp.appendChild(document.createTextNode(contactApp.resultSet[id].city));
		
		temp = document.getElementById("st");
		temp.innerHTML = '';
		temp.appendChild(document.createTextNode(contactApp.resultSet[id].st));
		
		temp = document.getElementById("zip");
		temp.innerHTML = '';
		temp.appendChild(document.createTextNode(contactApp.resultSet[id].zip));
		
		temp = document.getElementById("phone1");
		temp.innerHTML = '';
		temp.appendChild(document.createTextNode(contactApp.resultSet[id].phone1));
		
		temp = document.getElementById("phone2");
		temp.innerHTML = '';
		temp.appendChild(document.createTextNode(contactApp.resultSet[id].phone2));
		
		temp = document.getElementById("email");
		temp.innerHTML = '';
		temp.appendChild(document.createTextNode(contactApp.resultSet[id].email));
		
		temp = document.getElementById("url");
		temp.innerHTML = '';
		temp.appendChild(document.createTextNode(contactApp.resultSet[id].url));
		
/*
		spanList = document.getElementsByTagName("SPAN");
		spanCount = spanList.length;
		for (c = 0; c < spanCount; c++) {
			temp2 = spanList[c].id;
			temp = document.getElementById("url");
			temp.innerHTML = '';
			temp.appendChild(document.createTextNode(contactApp.resultSet[id][temp2]));
		}
*/		
		
		document.getElementById("ccSave").disabled = true;
		
		//now center element onscreen (horizontally, at least)
		pageData.contactCardDiv.style.top = (getViewportHeight() / 2) - 100 + 'px';
		pageData.contactCardDiv.style.left = (getViewportWidth() / 2) - 150 + 'px';
		
		pageData.contactCardDiv.style.display = 'block';
	};
	
	this.ccEditField = function(field) {
		//contactApp.tempRecord[field.id] = field.innerHTML;
		//alert(contactApp.tempRecord[field.id]);
		
		//defaultText = field.innerHTML;
		
		field.innerHTML = '';
		
		temp = document.createElement("INPUT");
		field.appendChild(temp);
		temp.value = contactApp.tempRecord[field.id];
		temp.name = field.id;
		temp.onkeyup = contactApp.keyUp;
		temp.focus();
		
	};
	
	this.keyUp = function(e) {
		if (!e) e = window.event;
		//alert(e.keyCode); // easy way to check key codes
		// note that Enter is 13 and Esc is 27
		target = getTargetElem(e); // find out who fired the event
		
		switch(e.keyCode) {
			case 27:
				//alert('cancel field');
				contactApp.ccReadOnlyField(target);
			break;
			case 13:
				//alert('save field');
				contactApp.tempRecord[target.name] = target.value;
				document.getElementById("ccSave").disabled = false;
				contactApp.ccReadOnlyField(target);
			break;
		}
		
	};
	
	this.ccReadOnlyField = function(field) {
		// takes the input field and switches to readonly mode
		//defaultText = field.value;
		parentElem = field.parentNode; // get parent node
		parentElem.innerHTML = ''; // quick wipe of contents
		parentElem.appendChild(document.createTextNode(contactApp.tempRecord[field.name]));
	};
	
	this.ccSaveRec = function() {
		contactApp.resultSet[contactApp.currentRecordId] = contactApp.tempRecord;
		
		postData = '';
		postData = postData + 'firstname=' + escape(contactApp.tempRecord.firstname) + '&';
		postData = postData + 'lastname=' + escape(contactApp.tempRecord.lastname) + '&';
		postData = postData + 'addr1=' + escape(contactApp.tempRecord.addr1) + '&';
		postData = postData + 'addr2=' + escape(contactApp.tempRecord.addr2) + '&';
		postData = postData + 'city=' + escape(contactApp.tempRecord.city) + '&';
		postData = postData + 'st=' + escape(contactApp.tempRecord.st) + '&';
		postData = postData + 'zip=' + escape(contactApp.tempRecord.zip) + '&';
		postData = postData + 'phone1=' + escape(contactApp.tempRecord.phone1) + '&';
		postData = postData + 'phone2=' + escape(contactApp.tempRecord.phone2) + '&';
		postData = postData + 'email=' + escape(contactApp.tempRecord.email) + '&';
		postData = postData + 'url=' + escape(contactApp.tempRecord.url);
		
		pageData.ajax.doPost('contactsvc.php?mode=put&id=' + contactApp.tempRecord.id, postData, contactApp.ccSaveResponse, 'text');
		statusDisplay.displayStatus();
	};
	
	this.ccSaveResponse = function(response) {
		statusDisplay.hideStatus();
		if (response == 'Success') {
			alert('Your Changes have been saved.');
		} else {
			alert('Something went horribly, horribly wrong: ' + "\n" + response);
		}
	};
	
	this.getResultSet = function() {
		
		pageData.ajax.doGet('contactsvc.php?mode=get', contactApp.processResults, 'xml');
		statusDisplay.displayStatus();
	};
	
	this.processResults = function(response) {
		statusDisplay.hideStatus();
		contactApp.resultSet = XMLParse.xml2ObjArray(response, 'contact');
		
		contactApp.displayContactCard(0);
	};
	
};

var statusDisplay = new function() {
	this.statusDiv = null;
	
	this.init = function(elem) {
		statusDisplay.statusDiv = elem;
	};
	
	this.displayStatus = function() {
		statusDisplay.statusDiv.style.display = 'block';
	};
	
	this.hideStatus = function() {
		statusDisplay.statusDiv.style.display = 'none';
	};
	
	
};

window.onload = function() {
	pageData.init();
	contactApp.init();
};

window.onunload = function() {
	pageData.cleanup();
}

//document.onkeyup = contactApp.keyUp;
