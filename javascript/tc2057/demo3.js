// JavaScript Document
// singleton registry object
var Registry = new function() {
	
};

// singleton application object
var App = new function() {
	this.init = function() {
		var images = ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16'];
		Lightbox.init(images);
	}; // init
	
	this.cleanup = function() {
		
	}; // cleanup
}; // App


var Lightbox = new function() {
	this.screenDiv = null;
	this.hoverDiv = null;
	this.imageList = new Array();
	
	this.init = function(images) {
		this.imageList = images;
		
		// set up screen div
		this.screenDiv = document.createElement("DIV");
		this.screenDiv.id = 'lightbox-screen';
		document.body.appendChild(this.screenDiv);
		
		// create lightbox hover div
		this.hoverDiv = document.createElement("DIV");
		document.body.appendChild(this.hoverDiv);
		this.hoverDiv.id = 'lightbox-hover';
		
		var tempElem = document.createElement("A");
		this.hoverDiv.appendChild(tempElem);
		tempElem.href = '#';
		tempElem.appendChild(document.createTextNode('Close'));
		
		tempElem.onclick = function() {
			Lightbox.hideLightbox();
			return false;
		};
		
		tempElem = document.createElement("IMG");
		this.hoverDiv.appendChild(tempElem);
		tempElem.src = '#';
		tempElem.width = '300';
		tempElem.height = '300';
		
		this.buildGallery();
	}
	
	this.buildGallery = function() {
		// get reference to container element
		// assumed to have id of 'lightbox'
		var lightboxDiv = document.getElementById("lightbox");
		
		lightboxDiv.onclick = function(e) {
			// test for the event object
			if (!e) e = window.event;
			
			target = getTargetElem(e);
			if (target.nodeName == 'IMG')
				target = target.parentNode;
				
			//alert(target.id);
			
			Lightbox.showLightbox(target.id);
		};
		
		// loop through image array 
		for (var c = 0; c < this.imageList.length; c++) {
			// create item div and image element
			tempElem = document.createElement("DIV");
			lightboxDiv.appendChild(tempElem);
			tempElem.id = 'lightbox-item_' + c;
			tempElem.className = 'lightbox-item';
			
			tempElem2 = document.createElement("IMG");
			tempElem.appendChild(tempElem2);
			tempElem2.src = 'images/TN_' + this.imageList[c] + '.jpg';
			tempElem2.width = '100';
			tempElem2.height = '100';
			tempElem2.alt = 'Image ' + this.imageList[c];
			
		}
		
	}; // buildGallery
	
	this.showLightbox = function(id) {
		// get index number of imageList array from id
		var index = id.split('_')[1];
		
		// update lightbox IMG element
		this.hoverDiv.lastChild.src = 'images/IMG_' + this.imageList[index] + '.jpg';
		
		// center lightbox
		centerElement(this.hoverDiv, 300, 320);
		
		// show screen & hoverdiv
		this.screenDiv.style.display = 'block';
		this.hoverDiv.style.display = 'block';
		
	}; // showLightbox
	
	this.hideLightbox = function() {
		// hide screen & hoverdiv
		this.hoverDiv.style.display = 'none';
		this.screenDiv.style.display = 'none';
	}; // hideLightbox
}; // Lightbox

window.onload = App.init;
window.onunload = App.cleanup;