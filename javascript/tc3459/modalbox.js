// JavaScript Document

var ModalBox = new function() {
	
	this.overlayNode = null;
	this.modalNode = null;
	this.modalNodeInner = null;
	this.params = {};
	
	this.init = function(params) {
		// params: overlayid
		ModalBox.params = params;
		document.body.style.margin = '0';
		document.body.style.padding = '0';
		ModalBox.createOverlay();
	}; // init
	
	this.createOverlay = function() {
		ModalBox.overlayNode = document.createElement("DIV");
		ModalBox.overlayNode.id = ModalBox.params.overlayid;
		ModalBox.overlayNode.style.position = 'fixed';
		ModalBox.overlayNode.style.height = '100%';
		ModalBox.overlayNode.style.width = '100%';
		ModalBox.overlayNode.style.zIndex = '5000';
		ModalBox.overlayNode.style.display = 'none';
		//ModalBox.overlayNode.style.backgroundColor = '#333';
		document.body.insertBefore(ModalBox.overlayNode, document.body.firstChild);
	}; // createOverlay
	
	this.createBox = function(params) {
		// params: width, height, boxid, innerid
		ModalBox.modalNode = document.createElement("DIV");
		ModalBox.modalNode.style.width = params.width + 'px';
		ModalBox.modalNode.style.height = params.height + 'px';
		ModalBox.modalNode.style.zIndex = '5100';
		ModalBox.modalNode.style.position = 'fixed';
		ModalBox.modalNode.style.display = 'none';
		ModalBox.modalNode.id = params.boxid;
		// create interior shell for items
		ModalBox.modalNodeInner = document.createElement("DIV");
		ModalBox.modalNodeInner.id = params.innerid;
		ModalBox.modalNode.appendChild(ModalBox.modalNodeInner);
		document.body.insertBefore(ModalBox.modalNode, document.body.firstChild);
	}; // createBox
	
	this.addBoxContent = function(content) {
		// clear innerbox contents
		while (ModalBox.modalNodeInner.hasChildNodes())
			ModalBox.modalNodeInner.removeChild(ModalBox.modalNodeInner.firstChild);
		// append content to innerbox
		ModalBox.modalNodeInner.appendChild(content);
	}; // addBoxContent
	
	this.displayBox = function() {
		ModalBox.overlayNode.style.display = 'block'; // display screen
		ModalBox.modalNode.style.display = 'block'; // display box
	}; //displayBox
	
	this.clearBox = function() {
		ModalBox.modalNode.style.display = 'none'; // hide box
		ModalBox.overlayNode.style.display = 'none'; // hide screen
	}; // clearBox
	
}; // ModalBox


