var carousel = {
	params: {}, 
	
	init: function(params) {
		carousel.params = params; // copy over parameters
		
		$(params.target)
			.append('<div id="carouselwindow"></div>')
			.children('#carouselwindow')
			.css(
			   {
				position: 'relative',
				width: params.slideWidth + 'px',
				height: params.slideHeight + 'px',
				overflow: 'hidden',
				margin: 'auto'
			   }
			 )
			.append('<div id="carouselfilmstrip"></div>')
			.children('#carouselfilmstrip')
			.css(
			   {
				width: (params.slides.length * params.slideWidth) + 'px',
				height: params.slideHeight + 'px',
				overflow: 'hidden',
				margin: 'auto',
				position: 'absolute',
				left: 0
			   }
			 )
			.each(
			   function(i, elem) {
			      var $filmstrip = $(elem);
				  
				  $.each(
				     params.slides,
					 function(index, slide) {
					    $filmstrip.append('<img src="'+ slide +'" />');
					 }
				  ) // $.each
			   }
			 );
		
		if (params.autostart) carousel.start();
		
	}, // init
	
	moveLeft: function() {
		$('#carouselfilmstrip')
			.animate(
			   {
				 left: carousel.params.slideWidth * -1
			   }, 
			   carousel.params.moveDuration, 
			   'swing',
			   function() {
				  $('#carouselfilmstrip img:first-child')
					 .detach()
					 .appendTo('#carouselfilmstrip')
					 .parent()
					 .css( {left: 0} );
			   }
			 );
	}, // moveLeft
	
	start: function() {
		setInterval(carousel.moveLeft, carousel.params.intervalDuration);
	} // start
	
}; // carousel

