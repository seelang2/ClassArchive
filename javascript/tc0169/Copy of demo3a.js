
currentPage = "p1";

function clickLink(linkid) {

	currentPage = linkid;
	ajaxSendReq("GET", 'http://localhost/demo3_' + linkid + '.html', handleResp, null, 'TEXT');

}

function handleResp(response) {
	contentDiv = document.getElementById('content');

	contentDiv.innerHTML = response;	

	menuTab = document.getElementById(currentPage);
	menuTab.style.borderBottom = "none";
}

function init() {

/*
	tmpval = document.getElementById('wrapper');
	alert(tmpval);
*/

for (c=1; c<5; c++) {
	idval = 'p'+c;
	tmpval = document.getElementById(idval);
	alert(idval + ' = ' + tmpval);
	tmpval.onclick = function() {
		clickLink(idval);
		return false;
	}
}

}


window.onload = init;