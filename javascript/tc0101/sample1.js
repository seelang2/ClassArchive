
var app = new function() {
	this.makediv = null;
	this.modeldiv = null;
	this.botinner = null;
	this.ajax = new Ajax();
	this.mode = null;

	this.getdata = function(params) {
	    var self = app;
		start = new Date();
		start = start.getTime();
		self.ajax.doGet('backend1.php?' + params + '&start=' + start, self.processresp);
	};
	
	this.updatemake = function() {
	    var self = app;
		self.mode = "make";
//		var temp = document.getElementById('selectmake');
		self.getdata("tbl=make");
	};

	this.updatemodel = function() {
	    var self = app;
		self.mode = "model";
		var temp = document.getElementById('selectmake');
		self.getdata("tbl=model&make=" + temp.value);
		
	};

	this.updateitems = function() {
	    var self = app;
		self.mode = "items";
		var temp = document.getElementById('selectmodel');
		self.getdata("tbl=item&model=" + temp.value);
		
	};

	this.dotext = function(str) {
	    var self = app;
		self.mode = "text";
		self.getdata("tbl=text&text=" + str);
		
	};

	this.processresp = function(str) {
	    var self = app;
		switch(self.mode) {
			case "make":
//				self.clearnode(this.makediv);
				self.makediv.innerHTML = str;
			break;
			case "model":
//				self.clearnode(this.modeldiv);
				self.modeldiv.innerHTML = str;
			break;
			case "items":
				self.botinner.innerHTML = str;
			break;
			case "text":
				self.botinner.innerHTML = str;
			break;
		}		
	};
	
	this.clearnode = function(node) {
	    var self = app;
		while (node.firstChild) {
		  node.removeChild(node.firstChild);
		}
	};
	
	this.init = function() {
		var self = app;
		self.makediv = document.getElementById('makediv');
		self.modeldiv = document.getElementById('modeldiv');
		self.botinner = document.getElementById('botinner');
	};
	
	this.cleanup = function() {
		var self = app;
		self.makediv = null;
		self.modeldiv = null;
		self.botinner = null;
	};

};

window.onload = app.init;
window.onunload = app.cleanup;