
// get reference to DOM target location
var targetElem = document.getElementById('content');

// create new node
var pElem = document.createElement("P");

// attach node to DOM
targetElem.appendChild(pElem);

// create new (text) node
var text = document.createTextNode('This space for rent.');

// attach (text) node to DOM
pElem.appendChild(text);

