// JavaScript Document

function dumpdata(o) {
	var s = "";
		for (var item in o) {
			s += item + ", ";
		}
		alert(s);
}


// create singleton data registry object
AppData = new function() {
	this.ajax = null;
	this.topDiv=null;
	this.bottomDiv = null;
	this.statusDiv=null;
	this.items = null;
	this.offset = 0;
	this.range = 7;
	this.hoverDiv = null;
	this.hoverData = null;
	this.detail = null;
	this.processing = false; // sync check
	this.hoverTimer = null; // async check
	this.hoverScreen = null;
	
}; // AppData

DemoApp = new function() {
	var self = this;

	this.createHover = function() {
		hoverscreen = document.createElement("div");
		hoverscreen.id="hoverscreen";
		AppData.hoverScreen=hoverscreen;
		
		// another apprach is to use opacity
		
		// create hover div
		div = document.createElement("div");
		div.id="hoverdiv";
		//div.style.visibility="hidden";
		//div.style.display="none";
		
		datadiv = document.createElement("div");
		datadiv.id = "datadiv";
		

		div.appendChild(datadiv);
		
		navdiv = document.createElement("div");
		
		a = document.createElement("a");
		a.id = "hovercontrol";
		a.href="#";
		a.appendChild(document.createTextNode("Close"));
		a.onclick=function() {
			AppData.hoverDiv.style.display="none";
			AppData.hoverScreen.style.display="none";

			return false;
		};
		
		navdiv.appendChild(a);
		div.appendChild(navdiv);
		
		document.getElementById("header").appendChild(div);
		document.getElementById("header").appendChild(hoverscreen);
		
		
		
		AppData.hoverDiv = div;
		
		AppData.hoverData = datadiv;
	};
	
	this.init = function() {
		AppData.ajax = new Ajax();
		AppData.topDiv = document.getElementById("top");
		AppData.bottomDiv = document.getElementById("bottom");
		AppData.statusDiv = document.getElementById("statusdiv");
		AppData.processing = false;
		
		// perform ajax call
		AppData.statusDiv.style.visibility = "visible";
		
		var url = "http://localhost/tc1525/seriesdata3.php?mode=data&x=" + new Date().getTime();
		AppData.ajax.doGet(url, DemoApp.showRecord, 'xml');
		AppData.processing = true;
		
		
			
	}; // init
	
	this.cleanup = function() {
			purge(AppData.topDiv);
			purge(AppData.bottomDiv);
			purge(AppData.statusDiv);
			
			AppData.topDiv = null;
			AppData.bottomDiv = null;
			AppData.statusdiv=null;
			self.hoverDiv = null;
			self.hoverData = null;
			self.detail = null;
			self.hoverScreen = null;
	};
		
	this.showRecord = function(data) {
		AppData.processing = false;
		AppData.statusDiv.style.visibility = "hidden";
		
		//var nodeList = data.childNodes;
		AppData.items = data.getElementsByTagName("mitem");
		self.buildTable(AppData.offset, AppData.range);
	}; // showRecord
	
	
	this.showDetail = function(data) {
		AppData.processing = false;
		
		//var nodeList = data.childNodes;
		AppData.detail = data.getElementsByTagName("mitem");

		datadiv = document.getElementById("datadiv");
		while (datadiv.hasChildNodes()) {
			purge(datadiv.firstChild);
			datadiv.removeChild(datadiv.firstChild);
		}
		
		var fieldlist = AppData.detail;
		
		var field = fieldlist[0];
		for (var i = 0; i < field.childNodes.length; i++) {
			if (field.childNodes[i].nodeType == 1) {
				p = document.createElement("p");
				var nodeValue = field.childNodes[i].nodeName.toUpperCase();
				p.appendChild(document.createTextNode(nodeValue + ":" + field.childNodes[i].firstChild.nodeValue));
				datadiv.appendChild(p);
			}
		}

		// center not fully debugged
		//centerElement(AppData.hoverDiv);
		
		AppData.hoverDiv.style.display = "block";
		AppData.hoverScreen.style.display="block";

	}; // showDetail

	
	this.buildTable = function(offset, range) {
		if (!AppData.hoverData)
			self.createHover();
			
		
		while (AppData.bottomDiv.hasChildNodes()) {
			purge(AppData.bottomDiv.firstChild);
			AppData.bottomDiv.removeChild(AppData.bottomDiv.firstChild);
		}
		
		pageTot = Math.round((AppData.items.length / AppData.range) + 0.5);
		pageNum = (AppData.offset /AppData.range) + 1;
		
		div = document.createElement("div");
		div.id="navbar";
		
		if (pageNum > 1) {
			a = document.createElement("a");
			a.href = "#";
			var off = 0;
			/*off = offset - range;
			if (off < 0)
				off = 0;
			a.rel  = off + "," + range;	
			*/
			
			a.appendChild(document.createTextNode("Previous"));
			a.onclick = function() {
				off = offset - range;
				if (off < 0)
					off = 0;
				AppData.offset = off;
	
				self.buildTable(AppData.offset, range);
				return false;
			};
	
			div.appendChild(a);
		}
		
		//div.appendChild(document.createTextNode("\u00A0"));
		div.appendChild(document.createTextNode(' Page ' + pageNum + ' of ' + pageTot + ' '));

		if (pageNum < pageTot) {
			a = document.createElement("a");
			a.href = "#";
			/*
			off = offset + range;
			if (off > AppData.items.length)
				off = offset;
			a.rel  = off + "," + range;	
			*/
	
			a.appendChild(document.createTextNode("Next"));
			a.onclick = function() {
				off = offset + range;
				if (off >= AppData.items.length) {
					off = offset;
				}
				AppData.offset = off;
				
				self.buildTable(AppData.offset, range);
				return false; // so do not bubble events up
			};
	
			div.appendChild(a);
		}
		
		AppData.bottomDiv.appendChild(div);
	
		table = document.createElement("table");
		table.setAttribute("border", "1");
		tbody = document.createElement("tbody");
		table.appendChild(tbody);
		tr = document.createElement("tr");
		
		//for (var i = 0; i < fieldlist[0].childNodes.length; i++)
		//	alert(fieldlist[0].childNodes[i].nodeType + ":" + fieldlist[0].childNodes[i].nodeName);
		
		//for (var i = 0; i < fieldlist[0].childNodes.length; i++)
			//alert(fieldlist[0].childNodes[i].nodeType + ":" + fieldlist[0].childNodes[i].nodeName);
		//	if (fieldlist[0].childNodes[i].nodeType == 1)
		//		alert(fieldlist[0].childNodes[i].firstChild.nodeValue);
		
		var fieldlist = AppData.items;
		
		var field = fieldlist[0];
		for (var i = 0; i < field.childNodes.length; i++) {
			if (field.childNodes[i].nodeType == 1) {
				th = document.createElement("th");
				th.appendChild(document.createTextNode(field.childNodes[i].nodeName.toUpperCase()));
				tr.appendChild(th);
			}
		}
		
		tbody.appendChild(tr);
		
		var limit = offset + range;
		if (limit > AppData.items.length)
			limit = AppData.items.length;
		for (var i = offset; i < limit; i++) {
			field = fieldlist[i];
			
			tr = document.createElement("tr");
			//var id = field.getElementsByTagName("id")[0];
			//dumpdata(id);
			
			// set tr id
			if (i % 2 == 0) 
				tr.className = "evenrow";
			else
				tr.className = "oddrow";
			
			var id = "";
			var nodeValue = "";
			for (var j = 0; j < field.childNodes.length; j++) {
				if (field.childNodes[j].nodeType == 1) {
					td = document.createElement("td");
					nodeValue = field.childNodes[j].firstChild.nodeValue;
					txt = document.createTextNode(nodeValue);
					if (field.childNodes[j].nodeName == "id")
						id = 'row_'+ nodeValue;
					td.appendChild(txt);
				
					tr.appendChild(td);
					tr.id=id;
				}
			
			}
			
			tbody.appendChild(tr);
		}
		
		//AppData.rightDiv.innerHTML = "";
		
		table.onmouseover = function(e) {
			// implementation 1 to handle fast onmouseover
			// this makes it synchronous
			//if (AppData.processing)
			//	return false;
				
			if (!e) e = window.event;
			row = getTargetElem(e);
			
			// row != null test to avoid error for first time entry
			while (row != null && row.nodeName != 'TR')
				row = row.parentNode;

			var doAjax = function() {
				if (row != null) {
					id = row.id.substr(4);
					//self.getNode(id);	
					var url = "http://localhost/tc1525/seriesdata3.php?mode=data&item=" + id + "&x=" + new Date().getTime();
					AppData.ajax.doGet(url, DemoApp.showDetail, 'xml');
					AppData.processing = true;
					
				}
			};
			AppData.hoverTimer = setTimeout(doAjax , 500);

		}; 
		
		table.onmouseout = function() {
			clearTimeout(AppData.hoverTimer);
		};

		AppData.bottomDiv.appendChild(table);
		
		
	}; // showRecord
	
	
	this.getNode = function(id) {
			// search node in nodelist
			for (var i = 0; i < AppData.items.length; i++) {
				field = AppData.items[i];
				field.getElementsByTagName("id")[0]

			}

		
		
	}; // getNode
	
	this.handleNav = function(e) {
		//dumpdata(e);
		//dumpdata(item);
		//var item = getTargetElem(e);
		//var rel = item.rel;
		
	};
	
		
}; // DemoApp

window.onload = DemoApp.init;
window.unload = DemoApp.cleanup;