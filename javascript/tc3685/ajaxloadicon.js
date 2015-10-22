var AjaxLoadIcon = new function() {
	var iconDiv = null;
	
	this.init = function(params) {
		// Parameters: imgsrc, height, width
		iconDiv = document.createElement("DIV");
		iconDiv.style.position = 'fixed';
		iconDiv.style.width = params.width + 'px';
		iconDiv.style.height = params.height + 'px';
		iconDiv.style.top = '50%';
		iconDiv.style.left = '50%';
		iconDiv.style.marginLeft = '-' + (params.width / 2) + 'px';
		iconDiv.style.marginTop = '-' + (params.height / 2) + 'px';
		iconDiv.style.zIndex = 9999;
		iconDiv.style.display = 'none';
		iconDiv.id = 'ajaxstatus';
		iconDiv.innerHTML = '<img src="'+ params.imgsrc +'" height="'+ params.height +'" width="'+ params.width +'" />';
		document.body.insertBefore(iconDiv, document.body.firstChild);
	}; // init
	
	this.show = function() {
		iconDiv.style.display = 'block';
	}; // show
	
	this.hide = function() {
		iconDiv.style.display = 'none';
	}; // hide
}; // AjaxLoadIcon

