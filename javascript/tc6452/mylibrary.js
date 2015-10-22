/*
	My custom library file.
	This just has all the modular code I've written and makes it reusable.

*/

function getOrdinal(num) {
	
	switch(true) {
		case num % 10 == 1 && num % 100 != 11:
			return 'st';
		break;
		
		case num % 10 == 2 && num % 100 != 12:
			return 'nd';
		break;
		
		case num % 10 == 3 && num % 100 != 13:
			return 'rd';
		break;
		
		default:
			return 'th';
		break;
	}
	
}


