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
			return FormApp.validate(this);
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
		    	'<div>' +
                	'<label for="caketype">Type of cake needed:</label>' +
                    '<input type="text" name="caketype" id="caketype" />' +
                '</div>' +
		    	'<div>' +
                	'<label for="numpeople">For how many people:</label>' +
                    '<input type="text" name="numpeople" id="numpeople" />' +
                '</div>';
		
	}; // doCakeFields
	
	this.validate = function(form) {
		var validated = true;
		var errormessage = '';
		//alert(form.elements.length);
		//var fieldInfo = '';
		for (var c = 0; c < form.elements.length; c++) {
			/*
			fieldInfo = fieldInfo + 
			'Node type: ' + form.elements[c].nodeName + 
			' field name: ' + form.elements[c].name +
			"\n";
			*/
			
			/*
			// validation process method 1 - sheer brute force
			switch(form.elements[c].name) {
				case 'firstname':
					if (form.elements[c].value.length == 0) {
						validated = false;
						errormessage += "The first name field cannot be blank.\n";
					}
				break;
				case 'lastname':
					if (form.elements[c].value.length == 0) {
						validated = false;
						errormessage += "The first name field cannot be blank.\n";
					}
				break;
			}
			*/
			
			switch(true) {
				case form.elements[c].className == 'required':
					if (form.elements[c].value.length == 0) {
						validated = false;
						errormessage += "Field "+ form.elements[c].title +" cannot be blank.\n";
					}
				break;
				
				case form.elements[c].className.substr(0,9) == 'minlength':
					var minlength = form.elements[c].className.split('-')[1];
					if (form.elements[c].value.length < minlength) {
						validated = false;
						errormessage += "Field "+ form.elements[c].title + 
										" must be longer than "+ minlength +" characters.\n";
					}
				break;
				
				case form.elements[c].className == 'isemail':
					var emailRegEx = /^[\w\.\-]+@([\w\-]+\.)+[a-zA-Z]+$/;
					if (!emailRegEx.exec(form.elements[c].value)) {
						validated = false;
						errormessage += "Field "+ form.elements[c].title +" is not a valid email address.\n";
					}
				break;
			}
		}
		//alert(fieldInfo);
		if (!validated) alert(errormessage);
		return validated;
	}; // validate
	
}; // FormApp


window.onload = FormApp.init;
