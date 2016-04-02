(function($) {
	
	var screenElem = null;
	var boxElem = null;
	
	var createScreen = function() {
		screenElem =
		$('<div></div>')
			.attr('id','modalscreen')
			.css(
				{
					position: 'fixed',
					width: '100%',
					height: '100%',
					zIndex: 1000
				}
			 );
	}; // createScreen
	
	var showScreen = function() {
		screenElem.prependTo(document.body);
	}; // showScreen
	
	var hideScreen = function() {
		screenElem.detach();
	}; // hideScreen
	
	var createBox = function(params) {
		boxElem =
		$('<div></div>')
			.attr('id','modalbox')
			.css(
				{
					position:	'fixed',
					width: 		params.width,
					height: 	params.height,
					zIndex: 	1001,
					top: 		'50%',
					left: 		'50%',
					marginTop:	'-'+ (parseInt(params.height) / 2) +'px',
					marginLeft:	'-'+ (parseInt(params.width) / 2) +'px'
				}
			 )
			.append('<div></div>')
			.children('div')
			.attr('id','modalboxcontrol')
			.append('<span><a href="#">[X]</a></span>')
			.on(
				'click',
				function(e) {
					e.preventDefault();
					hideScreen();
					boxElem.remove();
					boxElem = null;
				}
			 )
			.end()
			.append('<div></div>')
			.children('div:last-child')
			.attr('id','modalboxcontent')
			.end();
	};
	
	createScreen();
	
	$.fn.makeModal = function(params) {
		createBox(params);
		boxElem.find('#modalboxcontent').append(this);
		showScreen();
		boxElem.prependTo(document.body);
		return this;
	};

})(jQuery);

