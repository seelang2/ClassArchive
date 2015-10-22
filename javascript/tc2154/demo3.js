// JavaScript Document

var menuDiv = document.getElementById("menu");

var topicDivs = getElementsByClassName('topic');

//alert(topicDivs.length);

var menuLinks = menuDiv.getElementsByTagName("A");

for (var c = 0; c < menuLinks.length; c++) {
	// We could have
	//menuLinks[c].id = 'item-' + c;
	// We can also simply assign a custom property to our object.
	menuLinks[c].topicIndex = c;
	menuLinks[c].onclick = function() {
		//alert(this.id);
		//var itemid = this.id.split('-')[1];
		//alert(this.topicIndex);
		for (t = 0; t < topicDivs.length; t++) {
			if (t == this.topicIndex) {
				topicDivs[t].style.display = 'block';
			} else {
				topicDivs[t].style.display = 'none';
			}
		}
		return false;
	};
	
}

