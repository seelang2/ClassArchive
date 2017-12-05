// JavaScript Document
// create singleton registry object
var Registry = new function() {
	
}; // Registry

// creat main application singleton object
var App = new function() {
	this.init = function() {
		// set up data elements
		Registry.cartItems = []; // sets up empty array
		// get references to elements we use often
		Registry.contentDiv = document.getElementById("content");
		Registry.leftcolDiv = document.getElementById("leftcol");
		Registry.rightcolDiv = document.getElementById("rightcol");
		// build the other elements of the page
		App.buildPage();
		// retrieve product data and store
		App.getProductData();
		// display product listing
		App.displayProducts();
		// draw cart (initially will be empty)
		App.redrawCart();
	}; // init
	
	this.cleanup = function() {
		
	}; // cleanup
	
	this.buildPage = function() {
		// create left column subcontainers
		Registry.lefttopDiv = document.createElement("DIV");
		Registry.lefttopDiv.id = 'lefttop';
		Registry.leftcolDiv.appendChild(Registry.lefttopDiv);
		
		Registry.leftbotDiv = document.createElement("DIV");
		Registry.leftbotDiv.id = 'leftbot';
		Registry.leftcolDiv.appendChild(Registry.leftbotDiv);
		
		// set up event handler for adding items to cart
		Registry.leftbotDiv.ondblclick = function(e) {
			if (!e) e = window.event;
			
			var target = getTargetElem(e);
			// percolate up tree until we arrive at item div level
			while(target.className != 'item')
				target = target.parentNode;
			
			//alert(target.id);
			var itemId = target.id.split('-')[1];
			App.addToCart(itemId);
			
		}; // ondblclick
		
		// create right column components
		Registry.cartDiv = document.createElement("DIV");
		Registry.cartDiv.id = 'cart';
		Registry.rightcolDiv.appendChild(Registry.cartDiv);
		
		Registry.cartTable = document.createElement("TABLE");
		Registry.cartDiv.appendChild(Registry.cartTable);
		Registry.cartTbody = document.createElement("TBODY");
		Registry.cartTable.appendChild(Registry.cartTbody);
		
		Registry.cartSummaryDiv = document.createElement("DIV");
		Registry.cartSummaryDiv.id = 'cartsummary';
		Registry.cartDiv.appendChild(Registry.cartSummaryDiv);
		
	}; // buildPage
	
	this.getProductData = function() {
		Registry.productList = getProductList();
		Registry.productLabels = getProductLabels();
	}; // getProductData
	
	this.displayProducts = function() {
		// loop through product list
		for (var c = 0; c < Registry.productList.length; c++) {
			// create item div
			var divElem = document.createElement("DIV");
			divElem.className = 'item';
			divElem.id = 'item-' + Registry.productList[c]['id'];
			Registry.leftbotDiv.appendChild(divElem);
			
			/*
			
			// create elements for product fields
			var pElem = document.createElement("P");
			divElem.appendChild(pElem);
			pElem.appendChild(document.createTextNode('Name: ' + Registry.productList[c]['name']));
			
			var pElem = document.createElement("P");
			divElem.appendChild(pElem);
			pElem.appendChild(document.createTextNode('SKU: ' + Registry.productList[c]['sku']));
			
			var pElem = document.createElement("P");
			divElem.appendChild(pElem);
			pElem.appendChild(document.createTextNode('Quantity: ' + Registry.productList[c]['qty']));
			
			var pElem = document.createElement("P");
			divElem.appendChild(pElem);
			pElem.appendChild(document.createTextNode('Price: ' + Registry.productList[c]['price']));
			
			*/
			
			// more dynamic method
			
			for(fieldname in Registry.productList[c]) {
				var pElem = document.createElement("P");
				divElem.appendChild(pElem);
				pElem.appendChild(document.createTextNode(Registry.productLabels[fieldname] + ': ' + 
														  Registry.productList[c][fieldname]));
			}
			
			
		} // for
		
	}; // displayProducts
	
	this.addToCart = function(itemId) {
		// check inventory
		if (Registry.productList[itemId]['qty'] < 1) {
			alert('There are not enough of these items in stock.');
			return;
		}
		
		// update cart data
		var index = Registry.cartItems.length;
		Registry.cartItems[index] = new Object();
		Registry.cartItems[index].itemId = itemId;
		Registry.cartItems[index].qty = 1;
		
		this.redrawCart();
	}; // addToCart
	
	this.redrawCart = function() {
		// wipe out cart summary and tbody elements
		Registry.cartTbody.innerHTML = '';
		Registry.cartSummaryDiv.innerHTML = '';
		
		if (Registry.cartItems.length > 0) {
			// there are items in the cart, update cart table
			var total = 0;
			for (var c = 0; c < Registry.cartItems.length; c++) {
				// add subtotal to total
				total = total + (Registry.cartItems[c].qty * Registry.productList[Registry.cartItems[c].itemId]['price']);
				// add new row to tBody
				Registry.cartTbody.innerHTML = Registry.cartTbody.innerHTML +
					'<tr><td>' + Registry.productList[Registry.cartItems[c].itemId]['name'] + '</td>' +
					'<td>' + Registry.cartItems[c].qty + '</td>' + 
					'<td>' + Registry.productList[Registry.cartItems[c].itemId]['price'] + '</td></tr>';
			}
			Registry.cartSummaryDiv.innerHTML = '<p>Total items: ' + Registry.cartItems.length +
				' Cart Total: $' + total + '</p>';
		} else {
			// no items in cart, show empty cart message
			Registry.cartSummaryDiv.innerHTML = '<p>Cart is empty</p>';
		}
	}; // redrawCart
	
}; // App


// set application to start when window has finished loading
window.onload = App.init;
window.onunload = App.cleanup;










