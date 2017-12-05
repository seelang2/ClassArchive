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
	
	this.init = function() {
		
	};
	
	this.initContactCard = function() {
		
	};
	
	this.initContactTable = function() {
		
	};
	
};

window.onload = function() {
	pageData.init();
	contactApp.init();
};

window.onunload = pageData.cleanup();
