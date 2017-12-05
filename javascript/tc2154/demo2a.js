// JavaScript Document

document.write('<p>This is a semi-dynamic line from an included source.</p>');

var contentDiv = document.getElementById("content");

var pElem = document.createElement("P");

contentDiv.appendChild(pElem);

var tempElem = document.createTextNode('New content.');

pElem.appendChild(tempElem);

//alert(contentDiv.childNodes[0].nodeName);

//contentDiv.removeChild(contentDiv.firstChild);

pTags = contentDiv.getElementsByTagName("P");


pElem = document.createElement("P");
pElem.appendChild(document.createTextNode('Some new text here'));

//contentDiv.removeChild(pTags[0]);
//contentDiv.insertBefore(pElem, contentDiv.firstChild);

contentDiv.replaceChild(pElem, pTags[0]);

pElem.className = 'someclassname';
pElem.style.color = '#f00';
pElem.style.fontWeight = 'bold';










