/* Javascript sideloaded document */

	var rowHTML = '<div><span class="desc"><input name="desc[]" /></span><span class="cost"><input name="cost[]" /></span><span class="qty"><input name="qty[]" /></span><span class="subtotal"><input name="subtotal[]" value="30" /></span><span class="opts"> </span></div>';

	var calculateTotal = function() {
		// 'this' refers to element the event was bound to
		//console.log($(this).val());
		
		var total = 0; // initial total
			
		$('span.subtotal input')
			.each(function(index, inputElem) {
				// total input field values
				total += parseFloat($(inputElem).val());
			});

		// now update the total field
		$('#summary input').val(total);

		};

	$(rowHTML)
		.appendTo('#lineitems');


	$('.subtotal input')
		.on('change', calculateTotal);


