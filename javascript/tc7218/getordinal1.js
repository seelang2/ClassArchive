
function getOrdinal(num) {
	
	var a = num % 10; // get last digit of num
	var b = num % 100; // get last 2 digits of num
	
	switch (true) {
		
		case a == 0:
			var ordinal = '';
		break;
		
		case a == 1 && b != 11:
			var ordinal = 'st';
		break;
		
		case a == 2 && b != 12:
			var ordinal = 'nd';
		break;
		
		case a == 3 && b != 13:
			var ordinal = 'rd';
		break;
		
		default:
			var ordinal = 'th';
		break;
		
	} // switch
	
	return ordinal;
	
} // getordinal



