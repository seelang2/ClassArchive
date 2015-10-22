// singleton registry object
Registry = new function() {
	this.ajax = null;
	this.statusDiv = null;
	this.topicItems = null;
	this.editModeActive = false;
	this.editControlDiv = null;
	this.currentRow = null;
}; // Registry object

// singleton application object
App = new function() {
	this.init = function() {
		Registry.ajax = new Ajax;
		Registry.statusDiv = document.getElementById("statusbar");
		
		var topicDiv = document.getElementById("topicitems");
		// Registry.topicItems = topicDiv.getElementsByTagName("DIV");
		Registry.topicItems = getElementsByClassName('topicitem', 'DIV', topicDiv);
		
		var menuItems = document.getElementById("menu");
		menuItems = getElementsByClassName('menuitem', 'LI', menuItems);
		
		//alert(menuItems.length);
		for (i in menuItems) {
			menuItems[i].onclick = function() {
				
				var index = this.id.split('_')[1];

				for (var t = 0; t < Registry.topicItems.length; t++) {
					//alert(t);
					if (t == (index - 1)) {
						Registry.topicItems[t].style.display = 'block';
					} else {
						Registry.topicItems[t].style.display = 'none';
					}
				}
				
				App.doTab(index); 
				
			}; // onclick
		}
		
	}; // init
	
	this.cleanup = function() {
		Registry.statusDiv = null;
		Registry.topicItems = null;
	}; // cleanup
	
	this.doTab = function(index) {
		// perform function routing from menu tab click
		//alert('DoTab: ' + index);
		switch(index) {
			case '1':
				App.tab1();
			break;
			case '2':
				App.tab2();
			break;
			case '3':
				App.tab3();
			break;
			case '4':
				App.tab4();
			break;
		} // switch
	}; // doTab
	
	this.tab1 = function() {
		//alert('This is tab 1');
		
		// do xhr request to get data from server
		// workaround for aggressively cacing browsers (IE)
		var x = new Date();
		x = x.getTime();
		Registry.ajax.doGet('page1.html?x=' + x, App.tab1Update, 'text');
		// activate status div
		Registry.statusDiv.style.visibility = 'visible';
		
	}; // tab1
	
	this.tab1Update = function(response) {
		// deactivate status div
		Registry.statusDiv.style.visibility = 'hidden';
		
		Registry.topicItems[0].innerHTML = response;
		
	}; // tab1Update
	
	this.tab2 = function() {
		//alert('This is tab 2');
		// clear out container
		Registry.topicItems[1].innerHTML = '';
		// create holding containers for elements
		Registry.seriesDiv = document.createElement("DIV");
		Registry.topicItems[1].appendChild(Registry.seriesDiv);
		Registry.modelsDiv = document.createElement("DIV");
		Registry.topicItems[1].appendChild(Registry.modelsDiv);
		Registry.itemsDiv = document.createElement("DIV");
		Registry.topicItems[1].appendChild(Registry.itemsDiv);
		
		App.tab2GetSeries();
	}; // tab2
	
	this.tab2GetSeries = function() {
		// workaround for aggressively cacing browsers (IE)
		var x = new Date();
		x = x.getTime();
		Registry.ajax.doGet('seriesdata3.php?mode=series&x=' + x, App.tab2UpdateSeriesDiv, 'text');
		// activate status div
		Registry.statusDiv.style.visibility = 'visible';
		
	}; // tab2GetSeries
	
	this.tab2UpdateSeriesDiv = function(response) {
		// deactivate status div
		Registry.statusDiv.style.visibility = 'hidden';
		
		Registry.seriesDiv.innerHTML = response;
		
		var selectElem = document.getElementById("menu1");
		selectElem.size = 1;
		selectElem.selectedIndex = 0;
		
		selectElem.onchange = function() {
			//alert(this.value);
			App.tab2GetModels(this.value);
			
		}; // onchange
		
	}; // tab2UpdateSeriesDiv
	
	this.tab2GetModels = function(series) {
		series = series || 'ALL';
		
		// workaround for aggressively cacing browsers (IE)
		var x = new Date();
		x = x.getTime();
		Registry.ajax.doGet('seriesdata3.php?mode=model&series='+ series +'&x=' + x, 
							App.tab2UpdateModelsDiv, 'text');
		// activate status div
		Registry.statusDiv.style.visibility = 'visible';
		
	}; // tab2GetSeries
	
	this.tab2UpdateModelsDiv = function(response) {
		// deactivate status div
		Registry.statusDiv.style.visibility = 'hidden';
		
		Registry.modelsDiv.innerHTML = response;
		
		var selectElem = document.getElementById("menu2");
		selectElem.size = 1;
		selectElem.selectedIndex = 0;
		
		selectElem.onchange = function() {
			//alert(this.value);
			App.tab2GetItems(this.value);
			
		}; // onchange
		
	}; // tab2UpdateSeriesDiv
	
	this.tab2GetItems = function(model) {
		model = model || 'ALL';
		
		// workaround for aggressively cacing browsers (IE)
		var x = new Date();
		x = x.getTime();
		Registry.ajax.doGet('seriesdata3.php?mode=data&model='+ model +'&x=' + x, 
							App.tab2UpdateItemsDiv, 'xml');
		// activate status div
		Registry.statusDiv.style.visibility = 'visible';
		
	}; // tab2GetItems
	
	this.tab2UpdateItemsDiv = function(response) {
		// deactivate status div
		Registry.statusDiv.style.visibility = 'hidden';
		
		Registry.itemsDiv.innerHTML = '';
		
		// convert DOM object to js object array
		//var itemList = XMLParse.xml2ObjArray(response, 'mitem');
		// store itemList in registry
		Registry.itemList = XMLParse.xml2ObjArray(response, 'mitem');
		
		tempForm = document.createElement("FORM");
		Registry.itemsDiv.appendChild(tempForm);
		
		tempElem = document.createElement("TABLE");
		tempForm.appendChild(tempElem);
		
		tempTbody = document.createElement("TBODY");
		tempElem.appendChild(tempTbody);
		
		// create header row
		tempRow = document.createElement("TR");
		tempTbody.appendChild(tempRow);
		
		for (fieldName in Registry.itemList[0]) {
			tempElem = document.createElement("TH");
			tempRow.appendChild(tempElem);
			tempElem.appendChild(document.createTextNode(fieldName.toUpperCase()));
		}
		
		for(var c = 0; c < Registry.itemList.length; c++) {
			tempRow = document.createElement("TR");
			tempTbody.appendChild(tempRow);
			
			tempRow.id = 'row_' + c;
			
			if (c % 2 == 0) {
				tempRow.className = 'evenrow';
			} else {
				tempRow.className = 'oddrow';
			}
			
			// create listener for rows
			tempRow.ondblclick = function(e) {
				if (!e) e = window.event;
				targetNode = getTargetElem(e);
				
				//alert(targetNode.nodeName);
				
				while (targetNode.nodeName != 'TR')
					targetNode = targetNode.parentNode;
				
				//alert(targetNode.id);
				App.makeEditable(targetNode);
			}; // ondblclick
		
			for (fieldName in Registry.itemList[0]) {
				tempElem = document.createElement("TD");
				tempRow.appendChild(tempElem);
				tempElem.appendChild(document.createTextNode(Registry.itemList[c][fieldName]));
			}
		}
		// create edit controls
		Registry.editControlDiv = document.createElement("DIV");
		tempForm.appendChild(Registry.editControlDiv);
		Registry.editControlDiv.style.display = 'none';
		tempElem = document.createElement("INPUT");
		Registry.editControlDiv.appendChild(tempElem);
		tempElem.type = 'button';
		tempElem.value = 'Save';
		tempElem.onclick = function() {
			// our button is inside the form, so bubble up the dom to the form parent
			var target = this;
			while(target.nodeName != 'FORM')
				target = target.parentNode;
			
			App.saveForm(target);
		};
		
		tempElem = document.createElement("INPUT");
		Registry.editControlDiv.appendChild(tempElem);
		tempElem.type = 'button';
		tempElem.value = 'Cancel';
		tempElem.onclick = function() {
			App.cancelEdit(); 
		};
		
		
	}; // tab2UpdateItemsDiv
	
	this.makeEditable = function(target) {
		// don't enter edit mode if already in edit mode on another row
		if (Registry.editModeActive == true) return;
		
		var index = target.id.split('_')[1];
		// clear out contents of TR
		target.innerHTML = '';
		
		for (fieldName in Registry.itemList[index]) {
			tempElem = document.createElement("TD");
			target.appendChild(tempElem);
			tempInput = document.createElement("INPUT");
			tempElem.appendChild(tempInput);
			tempInput.name = fieldName;
			tempInput.value = Registry.itemList[index][fieldName];
		}
		// set current editing row in registry
		Registry.currentRow = target;
		// turn on edit mode on flag
		Registry.editModeActive = true;
		// show edit controls
		Registry.editControlDiv.style.display = 'block';

	}; // makeEditable
	
	this.cancelEdit = function() {
		
		var index = Registry.currentRow.id.split('_')[1];
		// clear out contents of TR
		Registry.currentRow.innerHTML = '';
		
		for (fieldName in Registry.itemList[index]) {
			tempElem = document.createElement("TD");
			Registry.currentRow.appendChild(tempElem);
			tempElem.appendChild(document.createTextNode(Registry.itemList[index][fieldName]));
		}
		// remove current row from registry
		Registry.currentRow = null;
		// turn off edit mode on flag
		Registry.editModeActive = false;
		// hide edit controls
		Registry.editControlDiv.style.display = 'none';
	}; // cancelEdit
	
	this.saveForm = function(targetform) {
		// need the item ID to save the record.
		for (var c = 0; c < targetform.elements.length; c++) {
			if (targetform.elements[c].name == 'id') var itemid = targetform.elements[c].value;
		}
		
		// encode data from form fields
		var formData = formData2QueryString(targetform);
		
		// workaround for aggressively cacing browsers (IE)
		var x = new Date();
		x = x.getTime();
		
		Registry.ajax.doPost('seriesdata3.php?mode=edit&item=' + itemid + '&x=' + x, 
							 formData, App.checkSave, 'text');
		
		// activate status div
		Registry.statusDiv.style.visibility = 'visible';
	}; // saveForm
	
	this.checkSave = function(response) {
		// deactivate status div
		Registry.statusDiv.style.visibility = 'hidden';
		
		if (response.substr(0,4) == 'Fail') {
			// failed save
			alert('An error was encountered saving the row:' + "\n" + response);
		} else {
			// successful save
			alert('The row was saved successfully.');
		}
		// revert row to read only AND save the current contents of the input fields
		// loop through row's children
		for (var c = 0; c < Registry.currentRow.childNodes.length; c++) {
			if (Registry.currentRow.childNodes[c].nodeName == 'TD') {
				// get value of input field
				var content = Registry.currentRow.childNodes[c].childNodes[0].value;
				// append new textnode to child
				var tempElem = document.createTextNode(content);
				Registry.currentRow.childNodes[c].appendChild(tempElem);
				// remove input field node
				Registry.currentRow.childNodes[c].removeChild(Registry.currentRow.childNodes[c].childNodes[0])
			}
		}
		// remove current row from registry
		Registry.currentRow = null;
		// turn off edit mode on flag
		Registry.editModeActive = false;
		// hide edit controls
		Registry.editControlDiv.style.display = 'none';
		
	}; // checkSave
	
	this.tab3 = function() {
		alert('This is tab 3');
	}; // tab3
	
	this.tab4 = function() {
		alert('This is tab 4');
	}; // tab4
	
}; // App object

window.onload = App.init;
window.onunload = App.cleanup;
