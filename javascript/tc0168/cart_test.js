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



  this.mouseDownHandler = function(e) {
    var self = Cart;
    var id = '';
    var pat = null;
    if (self.proc) { return false; }
    e = e || window.event;
    id = self.getSrcElemId(e);
    pat = /^(white|black)_/;
    if (pat.test(id)) {
      self.selectPiece = self.pieceList[id];
      self.dragPiece = new Draggable(id);
    }
  };
  this.mouseMoveHandler = function(e) {
    var self = Cart;
    xPos = e ? e.pageX : window.event.x;
    yPos = e ? e.pageY : (window.event.y + document.body.scrollTop);
    if (self.dragPiece) {
      self.dragPiece.move();
    }
  };
  this.mouseUpHandler = function(e) {
    var self = Cart;
    var id = '';
    if (self.dragPiece) {
      self.dragPiece.drop();
      self.dragPiece = null;
    }
  };
  this.getSrcElemId = function(e) {
    var ret = null;
    if (e.srcElement) { ret = e.srcElement; }
    else if (e.target) { ret = e.target; }
    if (ret.nodeType == 3) {
      ret = ret.parentNode;
    }
    return ret.id
  };
  this.getWinHeight = function() {
    if (document.all) {
      return document.body.clientHeight;
    }
    else {
      return window.innerHeight;
    }
  };
  this.getWinWidth = function() {
    if (document.all) {
      return document.body.clientWidth;
    }
    else {
      return window.innerWidth;
    }
  };
  this.toBoardX = function(xPos) {
    return xPos - Chess.leftPos;
  };
  this.toBoardY = function(yPos) {
    return yPos - Chess.topPos;
  };
  this.calcPosFromCol = function(col) {
    var self = Chess;
    return (col * self.squareSize) + (self.pieceOffset - 1);
  };
  this.calcColFromPos = function(pos) {
    var self = Chess;
    return parseInt(pos / self.squareSize)
  };


}; // Cart


function Draggable(divId) {
  this.div = document.getElementById(divId);
  this.clickOffsetX = (Cart.toBoardX(xPos) - this.div.offsetLeft);
  this.clickOffsetY = (Cart.toBoardY(yPos) - this.div.offsetTop);
  this.div.style.zIndex = 10;
  
  this.move = function() {
    var calcX = 0;
    var calcY = 0;
    var xMin = 0;
    var xMax = 0;
    var yMin = 0;
    var yMax = 0;
    calcX = xPos - this.clickOffsetX;
    calcY = yPos - this.clickOffsetY;
    xMin = Cart.leftPos - 1;
    xMax = Cart.leftPos + Cart.boardSize - Cart.pieceSize - 1;
    yMin = Cart.topPos - 1;
    yMax = Cart.topPos + Cart.boardSize - Cart.pieceSize - 1;
    calcX = calcX < xMin ? xMin : calcX;
    calcX = calcX > xMax ? xMax : calcX;
    calcY = calcY < yMin ? yMin : calcY;
    calcY = calcY > yMax ? yMax : calcY;
    this.div.style.left = parseInt(Cart.toBoardX(calcX)) + 'px';
    this.div.style.top = parseInt(Cart.toBoardY(calcY)) + 'px';
  };
  this.drop = function() {
    var calcX = 0;
    var calcY = 0;
    var deltaX = 0;
    var deltaY = 0;
    var colX = 0;
    var colY = 0;
    calcX = this.div.offsetLeft;
    calcY = this.div.offsetTop;
    deltaX = calcX % Cart.squareSize;
    deltaY = calcY % Cart.squareSize;
    calcX = this.getSnap(deltaX, calcX);
    calcY = this.getSnap(deltaY, calcY);
    calcX = calcX + Cart.pieceOffset - 1;
    calcY = calcY + Cart.pieceOffset - 1;
    this.div.style.left = calcX + 'px';
    this.div.style.top = calcY + 'px';
    colX = Cart.calcColFromPos(calcX);
    colY = Cart.calcColFromPos(calcY);
    if (Cart.selectPiece.wasMoved(colX, colY)) {
      Cart.doMove(colX, colY);
    }
    else {
      this.div.style.zIndex = 5;
    }
    this.div = null;
  };
  this.getSnap = function(delta, pos) {
    if (delta > (Cart.squareSize / 2)) {
      pos += (Cart.squareSize - delta);
    }
    else {
      pos -= delta;
    }
    return pos;
  };
} // draggable


document.onmousemove = Cart.mouseMoveHandler;
document.onmousedown = Cart.mouseDownHandler;
document.onmouseup = Cart.mouseUpHandler;
document.ondrag = function () { return false; };
document.onselectstart = function () { return false; };

//window.onload = Cart.init();
//window.onunload = Cart.cleanup();