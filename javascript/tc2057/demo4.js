// JavaScript Document

var FormApp = new function() {
	this.form = null;
	this.selectField = null;
	this.persBranch = null;
	this.caterBranch = null;
	this.cakeBranch = null;
	
	this.init = function() {
		FormApp.form = document.getElementById("demoform");
		FormApp.selectField = document.getElementById("inquirytype");
		FormApp.persBranch = document.getElementById("personalbranch");
		FormApp.caterBranch = document.getElementById("cateringbranch");
		FormApp.cakeBranch = document.getElementById("cakebranch");
		
		FormApp.selectField.onchange = function() {
			switch(this.value) {
				case 'personal':
					FormApp.persBranch.style.display = 'block';
					FormApp.caterBranch.style.display = 'none';
					FormApp.cakeBranch.style.display = 'none';
				break;
				case 'catering':
					FormApp.persBranch.style.display = 'none';
					FormApp.caterBranch.style.display = 'block';
					FormApp.cakeBranch.style.display = 'none';
				break;
				case 'cakes':
					FormApp.persBranch.style.display = 'none';
					FormApp.caterBranch.style.display = 'none';
					FormApp.cakeBranch.style.display = 'block';
				break;
				default:
					FormApp.persBranch.style.display = 'none';
					FormApp.caterBranch.style.display = 'none';
					FormApp.cakeBranch.style.display = 'none';
				break;
			}
		}; // onchange
		
	}; // init
	
}; // FormApp

window.onload = FormApp.init;
