// utility function custom library

function getOrdinal(num) {

	switch (true) {
		case num % 10 == 1 && num % 100 != 11:
			var ordinal = 'st';
		break;
		case num % 10 == 2 && num % 100 != 12:
			var ordinal = 'nd';
		break;
		case num % 10 == 3 && num % 100 != 13:
			var ordinal = 'rd';
		break;
		default:
			var ordinal = 'th';
		break;
	} // switch
	
	return ordinal;

} // getOrdinal
