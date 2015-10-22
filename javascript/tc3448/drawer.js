// JavaScript Document

function Drawer(target) {
	// initial parameters
	this.currentHeight = 0; // start out closed
	this.maxHeight = 0; // max height in px
	this.incrementDelay = 1; // interval delay in ms
	this.incrementStep = 1; // step value between intervals
	this.target = target; // reference to container
	var self = this; // avoid 'this' keyword issues
	
	this.slideOpen = function(targetHeight, delay, step) {
		this.currentHeight = 0; // reset height
		this.incrementDelay = delay;
		this.incrementStep = step;
		this.maxHeight = targetHeight;
		this.target.style.height = '0';
		this.target.style.display = 'block';
		this.interval = setInterval(this.slide, this.incrementDelay);
	}; // slideOpen
	
	this.slideClose = function(currentHeight, delay, step) {
		this.currentHeight = currentHeight; // reset height
		this.incrementDelay = delay;
		this.incrementStep = Math.abs(step) * -1; // insure step is negative
		this.interval = setInterval(this.slide, this.incrementDelay);
	}; // slideOpen
	
	
	this.slide = function() {
		self.currentHeight += self.incrementStep;
		
		if (self.incrementStep > 0 && self.currentHeight >= self.maxHeight) {
			self.currentHeight = self.maxHeight; // constrain height to maximum
			clearInterval(self.interval); // cancel interval
		}
		
		if (self.incrementStep < 0 && self.currentHeight < 1) {
			self.currentHeight = 0;
			clearInterval(self.interval); // cancel interval
			self.target.style.display = 'none';
		}
		
		self.target.style.height = self.currentHeight + (self.currentHeight != 0 ? 'px' : '');
		//self.target.style.height = self.currentHeight + 'px';
	}; // slide
}


