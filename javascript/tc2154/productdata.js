// JavaScript Document
function getProductList() {
		
	var products = [{ "id":"0","name":"Widgets","sku":"P001","price":125.00,"qty":25 },
					{ "id":"1","name":"Doodads","sku":"P002","price":16.95,"qty":11 },
					{ "id":"2","name":"Whatsits","sku":"P003","price":27.99,"qty":42 },
					{ "id":"3","name":"Whatchamacalits","sku":"P004","price":75.00,"qty":0 },
					{ "id":"4","name":"Things","sku":"P005","price":99.99,"qty":122 },
					{ "id":"5","name":"Thingie","sku":"P006","price":19.95,"qty":2507 }];
	
	return products;
	
}

function getProductLabels() {
	var productLabels = { "id":"ID","name":"Name","sku":"SKU","price":"Price","qty":"Quantity" };
	
	return productLabels;
}