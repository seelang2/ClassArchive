// JavaScript Document

var pageData = new function() {
	this.resultsDiv = null;
	this.calendarDiv = null;
	this.categoriesDiv = null;
}

function init() {
	pageData.resultsDiv = document.getElementById("results");	
	pageData.calendarDiv = document.getElementById("calendar");	
	pageData.categoriesDiv = document.getElementById("categories");	
	
	getResults('getresults', displayResults, '', '', 'XML');
	getResults('getcats', displayCats, '', '', 'TEXT');
}

function cleanup() {
	pageData.resultsDiv = null;
	pageData.calendarDiv = null;
	pageData.categoriesDiv = null;
}

function getResults(mode, callback, catid, prodid, respType) {

	x = new Date();
	x = x.getTime();

	ajaxSendReq("GET", "/backend.php?mode=" + mode + "&catid=" + catid  + "&prodid=" + prodid + "&x=" + x, callback, null, respType, true);

}

function displayResults (results) {
	
	pageData.resultsDiv.innerHTML = '';
	
	productList = XMLParse.xml2ObjArray(results, 'product');

	for (d=0; d < productList.length; d++) {

		tempDiv = document.createElement("DIV");
		pageData.resultsDiv.appendChild(tempDiv);
	
		tempDiv.setAttribute("CLASS","productdiv");
		tempDiv.setAttribute("ID","product" + d);
	
		temp1 = document.createElement("IMG");
		temp1.setAttribute("src", "Molecule300.jpg");
		temp1.setAttribute("width","75");
		temp1.setAttribute("height","75");
		tempDiv.appendChild(temp1);

		temp1 = document.createElement("P");
		temp1.appendChild(document.createTextNode(productList[d].name));
		tempDiv.appendChild(temp1);

		temp1 = document.createElement("BR");
		tempDiv.appendChild(temp1);

		temp1 = document.createElement("P");
		temp1.appendChild(document.createTextNode(productList[d].price));
		tempDiv.appendChild(temp1);
	}

	tempDiv = document.createElement("DIV");
	pageData.resultsDiv.appendChild(tempDiv);
	tempDiv.setAttribute("CLASS","clearing");


}

function displayCats(results) {
	pageData.categoriesDiv.innerHTML = results;	
	selectCat = document.getElementById("catlist");
	
	selectCat.onchange = function() {
		getResults('getresults', displayResults, selectCat.options[selectCat.selectedIndex].value, '', 'XML');	
	}
}

window.onload = init;
window.onunload = cleanup;