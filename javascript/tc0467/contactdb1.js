// JavaScript Document

// create singleton global data 'registry' object
var pageData = new function() {
	this.fieldListDiv = null;
	this.fieldSelect = null;
	this.contactTableDiv = null;
	this.contactCardDiv = null;
	this.ajax = new Ajax();
	
	// page initialization
	this.init = function() {
		pageData.fieldListDiv = document.getElementById("fieldlist");
		pageData.fieldSelect = document.getElementById("fieldselect");
		pageData.contactTableDiv = document.getElementById("contacttable");
		pageData.contactCardDiv = document.getElementById("contactcard");
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
	
	this.init = function() {
		contactApp.initContactCard();
		contactApp.getResultSet();
	};
	
	this.initContactCard = function() {
		// hijack behaviors
		document.getElementById("cc_close").onclick = function() {
			pageData.contactCardDiv.style.display = 'none';
			return false;
		};
		
		spanList = document.getElementsByTagName("SPAN");
		spanCount = spanList.length;
		for (c = 0; c < spanCount; c++) {
			//alert(spanList[c].id);
			spanList[c].ondblclick = function() {
				//alert(this.id);
				contactApp.ccEditField(this);
			}
			
		}
		
		
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
		
		
		pageData.contactCardDiv.style.display = 'block';
	};
	
	this.ccEditField = function(field) {
		//alert(field.innerHTML);
		defaultText = field.innerHTML;
		
		field.innerHTML = '';
		
		temp = document.createElement("INPUT");
		field.appendChild(temp);
		temp.value = defaultText;
		
	}
	
	
	
	this.getResultSet = function() {
		
		pageData.ajax.doGet('contactsvc.php?mode=get', contactApp.processResults, 'xml');
		
	};
	
	this.processResults = function(response) {
		contactApp.resultSet = XMLParse.xml2ObjArray(response, 'contact');
		
		contactApp.displayContactCard(0);
	};
	
};

window.onload = function() {
	pageData.init();
	contactApp.init();
};

window.onunload = function() {
	pageData.cleanup();
}
