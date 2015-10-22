/*
	modalbox.js - modal div object
*/
var modalBox = {
	createScreen: function(id) {
		modalBox.screenDiv = document.createElement("DIV");
		modalBox.screenDiv.id = id || 'modalscreen';
		modalBox.screenDiv.style.position = 'fixed';
		modalBox.screenDiv.style.height = '100%';
		modalBox.screenDiv.style.width = '100%';
		//modalBox.screenDiv.style.backgroundColor = 'rgba(250, 250, 250, 0.7)';
		modalBox.screenDiv.style.zIndex = 500;
		modalBox.screenDiv.style.top = '0';
		modalBox.screenDiv.style.left = '0';
		modalBox.screenDiv.style.display = 'none';
		document.body.insertBefore(modalBox.screenDiv, document.body.firstChild);
	}, // createscreen

	createModalBox: function(params) {
		modalBox.createScreen(params.screenId);
		modalBox.modalDiv = document.createElement("DIV");
		modalBox.modalDiv.id = params.id;
		modalBox.modalDiv.style.position = 'fixed';
		modalBox.modalDiv.style.height = params.height + 'px';
		modalBox.modalDiv.style.width = params.width + 'px';
		modalBox.modalDiv.style.zIndex = 501;
		modalBox.modalDiv.style.top = '50%';
		modalBox.modalDiv.style.left = '50%';
		modalBox.modalDiv.style.marginTop = '-' + (params.height / 2) + 'px';
		modalBox.modalDiv.style.marginLeft = '-' + (params.width / 2) + 'px';
		modalBox.modalDiv.style.display = 'none';
		
		tmpElem = document.createElement("DIV");
		modalBox.modalDiv.appendChild(tmpElem);
		tmpElem.id = 'modalcontrols';
		tmpElem.innerHTML = '<a id="modalClose" href="#">Close</a>';
		tmpElem.onclick = function() {
			modalBox.closeBox();
			return false; // cancel default action
		}
		modalBox.modalContent = document.createElement("DIV");
		modalBox.modalDiv.appendChild(modalBox.modalContent);
		modalBox.modalContent.innerHTML = params.content;
		
		document.body.insertBefore(modalBox.modalDiv, document.body.firstChild);
		
		modalBox.showBox();
	}, // createModalBox
	
	showBox: function() {
		modalBox.screenDiv.style.display = 'block';
		modalBox.modalDiv.style.display = 'block';
	}, // showBox
	
	closeBox: function() {
		modalBox.modalDiv.style.display = 'none';
		modalBox.screenDiv.style.display = 'none';
		modalBox.removeBox();
	}, // closeBox
	
	removeBox: function() {
		var x = document.body.removeChild(document.body.firstChild);
		x = null;
		var x = document.body.removeChild(document.body.firstChild);
		x = null;
	}
}; // modalBox

