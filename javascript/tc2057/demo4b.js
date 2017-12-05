// JavaScript Document

var FormApp = new function() {
	this.form = null;
	this.selectField = null;
	this.dynamicContent = null;
	
	this.init = function() {
		FormApp.form = document.getElementById("demoform");
		FormApp.selectField = document.getElementById("inquirytype");
		FormApp.dynamicContent = document.getElementById("dynamicform");
		
		FormApp.selectField.onchange = function() {
			switch(this.value) {
				case 'personal':
					FormApp.doPersonalFields();
				break;
				case 'catering':
					FormApp.doCateringFields();
				break;
				case 'cakes':
					FormApp.doCakeFields();
				break;
				default:
					FormApp.removeFields();
				break;
			}
		}; // onchange
		
		FormApp.form.onsubmit = function() {
			// clear out any existing error divs
			var errorDivs = getElementsByClassName('error', 'DIV');
			for (var c = 0; c < errorDivs.length; c++) {
				errorDivs[c].parentNode.removeChild(errorDivs[c].parentNode.firstChild);
			}
			
			var errors = FormApp.validate(this);
			
			if (errors.length > 0) {
				// errors present
				for (var c = 0; c < errors.length; c++) {
					//alert(errors[c][1]);
					var errDiv = document.createElement("DIV");
					errDiv.className = 'error';
					var divElem = document.getElementById('field-'+errors[c][0]);
					divElem.insertBefore(errDiv, divElem.firstChild);
					errDiv.appendChild(document.createTextNode(errors[c][1]));
				}
			}
			
			return false;
		}
	}; // init
	
	this.removeFields = function() {
		// method 1 using innerHTML
		//this.dynamicContent.innerHTML = '';
		
		// method 2 using DOM
		while(this.dynamicContent.hasChildNodes()) {
			this.dynamicContent.removeChild(this.dynamicContent.firstChild);
		}
		
	}; // removeFields
	
	this.doPersonalFields = function() {
		this.removeFields();
		
		var tempDiv = document.createElement("DIV");
		this.dynamicContent.appendChild(tempDiv);
		tempDiv.id = 'field-daysneeded';
		
		var tempElem = document.createElement("LABEL");
		tempDiv.appendChild(tempElem);
		tempElem.htmlFor = 'daysneeded';
		tempElem.appendChild(document.createTextNode('Number of days needed per week:'));
		
		tempElem = document.createElement("INPUT");
		tempDiv.appendChild(tempElem);
		tempElem.type = 'text';
		tempElem.name = 'daysneeded';
		tempElem.id = 'daysneeded';
		
		var tempDiv = document.createElement("DIV");
		this.dynamicContent.appendChild(tempDiv);
		tempDiv.id = 'field-numfamily';

		var tempElem = document.createElement("LABEL");
		tempDiv.appendChild(tempElem);
		tempElem.htmlFor = 'numfamily';
		tempElem.appendChild(document.createTextNode('How many people in your family?'));
		
		tempElem = document.createElement("INPUT");
		tempDiv.appendChild(tempElem);
		tempElem.type = 'text';
		tempElem.name = 'numfamily';
		tempElem.id = 'numfamily';
		
		
	}; // doPersonalFields
	
	this.doCateringFields = function() {
		this.removeFields();
		
		var tempDiv = document.createElement("DIV");
		this.dynamicContent.appendChild(tempDiv);
		tempDiv.id = 'field-eventtype';
		
		var tempElem = document.createElement("LABEL");
		tempDiv.appendChild(tempElem);
		tempElem.htmlFor = 'eventtype';
		tempElem.appendChild(document.createTextNode('Event type:'));
		
		tempElem = document.createElement("INPUT");
		tempDiv.appendChild(tempElem);
		tempElem.type = 'text';
		tempElem.name = 'eventtype';
		tempElem.id = 'eventtype';
		
		var tempDiv = document.createElement("DIV");
		this.dynamicContent.appendChild(tempDiv);
		tempDiv.id = 'field-numguests';
		
		var tempElem = document.createElement("LABEL");
		tempDiv.appendChild(tempElem);
		tempElem.htmlFor = 'numguests';
		tempElem.appendChild(document.createTextNode('Number of guests:'));
		
		tempElem = document.createElement("INPUT");
		tempDiv.appendChild(tempElem);
		tempElem.type = 'text';
		tempElem.name = 'numguests';
		tempElem.id = 'numguests';
		
	}; // doCateringFields
	
	this.doCakeFields = function() {
		this.dynamicContent.innerHTML = 
		    	'<div id="field-caketype">' +
                	'<label for="caketype">Type of cake needed:</label>' +
                    '<input type="text" name="caketype" id="caketype" />' +
                '</div>' +
		    	'<div id="field-numpeople>' +
                	'<label for="numpeople">For how many people:</label>' +
                    '<input type="text" name="numpeople" id="numpeople" />' +
                '</div>';
		
	}; // doCakeFields
	
	this.validate = function(form) {
		var validated = true;
		var errors = new Array();
		var e = 0;
		for (var c = 0; c < form.elements.length; c++) {
			
			switch(true) {
				case form.elements[c].className == 'required':
					if (form.elements[c].value.length == 0) {
						validated = false;
						errmsg = "Field "+ form.elements[c].title + 
														" cannot be blank.\n";
						errors[e] = [form.elements[c].name, errmsg];
						e++;
					}
				break;
				
				case form.elements[c].className.substr(0,9) == 'minlength':
					var minlength = form.elements[c].className.split('-')[1];
					if (form.elements[c].value.length < minlength) {
						validated = false;
						errmsg =  "Field "+ form.elements[c].title + 
														 " must be longer than "+ minlength +" characters.\n";
						errors[e] = [form.elements[c].name, errmsg];
						e++;
					}
				break;
				
				case form.elements[c].className == 'isemail':
					var emailRegEx = /^[\w\.\-]+@([\w\-]+\.)+[a-zA-Z]+$/;
					if (!emailRegEx.exec(form.elements[c].value)) {
						validated = false;
						errmsg = "Field "+ form.elements[c].title + 
														" is not a valid email address.\n";
						errors[e] = [form.elements[c].name, errmsg];
						e++;
					}
				break;
			}
		}

		return errors;
	}; // validate
	
}; // FormApp


window.onload = FormApp.init;
