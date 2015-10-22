// mylibrary.js - custom functions I use all the time
var myLib = {
	makeStatusDiv: function(params) {
		var divElem = document.createElement("DIV");
		divElem.id = params.id;
		divElem.style.position = 'fixed';
		divElem.style.height = params.height + 'px';
		divElem.style.width = params.width + 'px';
		divElem.style.zIndex = 1000;
		divElem.style.top = '50%';
		divElem.style.left = '50%';
		divElem.style.marginTop = '-' + (params.height / 2) + 'px';
		divElem.style.marginLeft = '-' + (params.width / 2) + 'px';
		divElem.style.backgroundImage = 'url('+ params.imageurl +')';
		divElem.style.display = 'none';
		document.body.insertBefore(divElem, document.body.firstChild);
	} // makeStatusDiv

}