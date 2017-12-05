var Cart = new function() {
	this.ajax = null;
	this.productdiv = null;
	this.cartdiv = null;
	this.products = [];

	this.init = function() {
		var self = Cart;
		self.ajax = new Ajax();
		self.productdiv = document.getElementById('products');
		self.cartdiv = document.getElementById('cart');
		self.getProducts();
//		self.showCart();
//		self.doPoll();
	};
	
	this.cleanup = function() {
		var self = Cart;
		self.productdiv = null;
		self.cartdiv = null;	
	};
	
	this.getProducts = function() {
		var self = Cart;
		self.ajax.doGet('products.xml', Cart.updateProducts, 'xml');
	};
	
	this.updateProducts = function(xmlresp) {
		var self = Cart;
		self.products = XMLParse.xml2ObjArray(xmlresp, 'product');
		
		for (var c=0; c < self.products.length; c++) {
			var itemdiv = document.createElement('DIV');
			itemdiv.appendChild(document.createTextNode(self.products[c].name));
			itemdiv.appendChild(document.createElement('BR'));
			itemdiv.appendChild(document.createTextNode(self.products[c].price));
			itemdiv.appendChild(document.createElement('BR'));
			itemdiv.appendChild(document.createTextNode(self.products[c].color));
			itemdiv.appendChild(document.createElement('BR'));
			itemdiv.appendChild(document.createTextNode(self.products[c].size));
			itemdiv.appendChild(document.createElement('BR'));
			itemdiv.setAttribute('CLASS','item');
			itemdiv.setAttribute('ID','item_' + c);
			Cart.productdiv.appendChild(itemdiv);
		}
	};



window.onload = Cart.init;
window.onunload = Cart.cleanup;