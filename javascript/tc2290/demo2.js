// JavaScript Document
var Registry = new function() {
	this.galleryDiv = null;
	this.galleryItems = null;
}; // Registry

var Gallery = new function() {
	this.init = function() {
		Registry.galleryDiv = document.getElementById("gallery");
		
		Registry.galleryItems = ['img1','img2','img3','img4','img5','img6'];
		
		Gallery.displayGallery();
		
	}; // init
	
	this.cleanup = function() {
		
	}; // cleanup
	
	this.displayGallery = function() {
		
		for(var i = 0; i < Registry.galleryItems.length; i++) {
			
			var itemDiv = document.createElement("DIV");
			Registry.galleryDiv.appendChild(itemDiv);
			itemDiv.id = 'item_' + i;
			itemDiv.className = 'item';
			
			var tempElem = document.createElement("P");
			itemDiv.appendChild(tempElem);
			tempElem.appendChild(document.createTextNode(Registry.galleryItems[i]));
			
		}
		
		
	}; // displayGallery
	
}; // Gallery


window.onload = Gallery.init;
window.onunload = Gallery.cleanup;