/***********************
 *	Filename: carousel.js
 *	Version: 1.1 2013/03/26
 *	Auth: Chris Langtiw chris@sitebabble.com http://www.sitebabble.com
 *	License: Creative Commons Attribution 3.0 Unported License
 *	License URL: http://creativecommons.org/licenses/by/3.0/deed.en_US
 *	
 *	Description: Simple Carousel plugin for jQuery
 *	This version of the carousel takes a jQuery collection containing the nodes that will
 *	be used for the filmstrip slide contents. This allows more flexibility in what markup
 *	the slides contain and how they are loaded. See carousel5.html and carousel6.html
 *	for examples.
 *
 *
 *	Example (from carousel5.html):
 *
 *	$('#carousel')
 *		.insertCarousel({
 *			direction: 'left',	// Accepted values: 'left' or 'right'
 *			height: '300px',
 *			width:	'400px',
 *			duration: 750,		// transition between slides in ms
 *			delay: 2000,		// how long each slide is displayed in ms
 *			slides: $slides 	// jQuery object containing document fragments
 *		});
 *
 *
 ***/

/*
// jQuery plugins use an IIFE that passes in the jQuery object to extend it
(function($) {
	// your encapsulated code goes here
})(jQuery);
*/


// jQuery plugins use an IIFE that passes in the jQuery object to extend it
(function($) {
	
	// these variables are private within the IIFE and don't clutter up the global namespace
	// because they're referenced outside the IIFE they are persistent (closure)
	var
		data = {},
		
		moveLeft = function() {
			data.filmstrip
				.delay(data.params.delay)			// pause animation queue
				.animate(
					{
						left: '+=' + parseInt(data.params.width)	// use relative/delta ending position
					},
					{
						duration: data.params.duration,
						complete: function() {
							data.filmstrip
								.children(':last-child')
								.prependTo(data.filmstrip)
								.parent()
								.css('left','-' + data.params.width);
							
							moveLeft();
						}
					}
				 );
			
		}, // moveleft
		
		moveRight = function() {
			data.filmstrip
				.delay(data.params.delay)			// pause animation queue
				.animate(
					{
						left: '-=' + parseInt(data.params.width)	// use relative/delta ending position
					},
					{
						duration: data.params.duration,
						complete: function() {
							data.filmstrip
								.children(':first-child')
								.appendTo(data.filmstrip)
								.parent()
								.css('left','-' + data.params.width);
							
							moveRight();
						}
					}
				 );
			
		}
	
	/***
	 * Takes a target and replaces its internal HTML with a carousel
	 * Usage: $(<target>).insertCarousel(options);
	 */
	$.fn.insertCarousel = function(params) {
		data.numSlides = params.slides.length;
		data.params = params;
		params.direction = params.direction || 'right';
		
		return this.each(function(i, target) {
			data.target = $(target);
			data.target.empty();
			
			data.filmstrip = 
			$('<div />') // create window div
				.css({
					position: 'relative',
					width: params.width,
					height: params.height,
					overflow: 'hidden',
					padding: 0,
					margin: 0
				 }) // set window functional CSS
				.appendTo(target)
				.append('<div />') // create slideshow div and append to window
				.children() // select slideshow div
				.css({
					position: 'absolute',
					width: (parseInt(params.width) * params.slides.length) + 'px',
					height: params.height,
					left: '-' + params.width
				 }) // set filmstrip functional CSS
				.append(params.slides); // add slide objects to filmstrip
				
			// the following sets slide 1 to be the second child of the filmstrip
			// because people expect that the slideshow begins with the first slide
			data.filmstrip.children(':last-child').prependTo(data.filmstrip);
			
			switch(params.direction.toLowerCase()) {
				case 'left':
					moveLeft();
				break;
				default:
				case 'right':
					moveRight();
				break;
			}
		}); // this.each
	} // $.fn.insertCarousel
	
})(jQuery);


