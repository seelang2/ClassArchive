/*
	demo1.js - XML Document manipulation

	This program reads in an XML file from the filesystem, parses 
	it into XML, and then traverses and manipulates the content

	1. Download and install nodejs
	2. Create a working folder
	3. Create a new project: npm init
	4. Add XMLDom module: npm install xmldom


	ref:
	https://nodejs.org/api/fs.html
	https://www.npmjs.com/package/xmldom

*/
var fs = require('fs'); // load in filesystem API
var DOMParser = require('xmldom').DOMParser; // load XML DOM module

// first load target file (synchronously)
var file = fs.readFileSync('contacts.xml', 'utf-8');

// next parse XML from text file
var XMLdoc = new DOMParser().parseFromString(file,'text/xml');

// unfortunately, querySelectorAll() isn't part of the DOM standard, so we can't use it
var contact = XMLdoc.getElementsByTagName('contact')[2];

var newFirstName = XMLdoc.createTextNode('Terry');
var newLastName = XMLdoc.createTextNode('Brooks');
var newAge = XMLdoc.createTextNode('26');

var firstNameElem = contact.getElementsByTagName('firstname')[0];
//firstNameElem.replaceChild(newFirstName, firstNameElem.firstChild);
firstNameElem.removeChild(firstNameElem.firstChild);


console.log(firstNameElem);

