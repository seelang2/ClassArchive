// JavaScript Document
var pageData = new function() {
	this.leftDiv = null;
	this.rightDiv = null;
	this.bottomDiv = null;
	this.ajax = null;
	
	var self = this;
	this.init = function() {
		self.leftDiv = document.getElementById("leftside");
		self.rightDiv = document.getElementById("rightside");
		self.bottomDiv = document.getElementById("bottom");
		self.ajax = new Ajax();
		
		document.getElementById("serieslink").onclick = getSeries;
		
	};
	
	this.cleanup = function() {
		self.leftDiv = null;
		self.rightDiv = null;
		self.bottomDiv = null;
		self.ajax = null;
	};

};

function getSeries() {
	x = new Date();
	x = x.getTime();
	pageData.ajax.doGet('seriesdata.php?x=' + x, displaySeries, 'text');
	return false;
}

function displaySeries(response) {
	pageData.leftDiv.innerHTML = response;
	
	temp = document.getElementById("menu1");
	temp.onchange = function() {
		getModels(this.value);
	}
}

function getModels(data) {
	x = new Date();
	x = x.getTime();
	pageData.ajax.doGet('seriesdata.php?mode=model&series=' + data + '&x=' + x, displayModels, 'text');
}

function displayModels(response) {
	pageData.rightDiv.innerHTML = response;	

	temp = document.getElementById("menu2");
	temp.onchange = function() {
		getItems(this.value);
	}
}

function getItems(data) {
	x = new Date();
	x = x.getTime();
	pageData.ajax.doGet('seriesdata.php?mode=data&model=' + data + '&x=' + x, displayItems, 'text');
}

function displayItems(response) {

	temp = document.createElement("TABLE");
	pageData.bottomDiv.appendChild(temp);
	
	tbody = document.createElement("TBODY");
	temp.appendChild(tbody);
	
	temp = document.createElement("TR");
	tbody.appendChild(temp);
	
	temp2 = document.createElement("TD");
	temp.appendChild(temp2);
	temp2.appendChild(document.createTextNode('Name'));

	temp2 = document.createElement("TD");
	temp.appendChild(temp2);
	temp2.appendChild(document.createTextNode('Email'));


}

window.onload = pageData.init;
window.onunload = pageData.cleanup;