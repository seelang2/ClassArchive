// JavaScript Document

var modal = {
	
	params: null,
	
	createScreen: function() {
		// set up screen
		$(document.body)
			.css('margin', 0)
			.prepend('<div id="modalscreen"></div>')
			.find('#modalscreen')
			.css(
			   {
				 position: 'fixed',
				 height: '100%',
				 width: '100%',
				 //backgroundColor: '#efefef',
				 zIndex: 1000
			   }
			 )
			.fadeTo(0, 0.7);
		
	}, // init
	
	createBox: function(params) {
		
		modal.createScreen();
		
		// create a modal box and display onscreen
		// params: height, width, content
		$(document.body)
			.prepend(
				'<div id="modalbox">' +
					'<div id="modalboxcontrol">' +
						'<span><a href="#">close</a></span>' +
					'</div>' +
					'<div id="modalboxcontent"></div>' +
				'</div>'
			 )
			.find('#modalbox')
			.css(
			   {
				 position: 'fixed',
				 height: params.height + 'px',
				 width: params.width + 'px',
				 zIndex: 1001,
			   }
			 )
			.find('#modalboxcontrol')
			.click(
				function(evt) {
					evt.preventDefault();			// stop default action
					modal.destroyBox();				// destroy modal box
				} // function
			 )
			.end()
			.find('#modalboxcontent')
			.html(params.content);
		
		modal.center(params);	
	}, // createBox
	
	destroyBox: function() {
		$('#modalscreen').remove();		// destroy screen
		$('#modalbox').remove(); 		// destroy modalbox
		
	}, // destroyBox
	
	center: function(params) {
		$('#modalbox')
			.css(
			   {
				 top: '50%',
				 left: '50%',
				 marginTop: '-' + (params.height / 2) + 'px',
				 marginLeft: '-' + (params.width / 2) + 'px'
			   }
			 )
	}
	
} // modal


