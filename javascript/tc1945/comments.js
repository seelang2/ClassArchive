// JavaScript Document
var Registry = new function() {
	this.token = null;
	this.loginDiv = null;
	this.commentEntryDiv = null;
	this.commentsDiv = null;
	this.ajax = null;
	this.poll = null;
}; // registry

var Comment = new function() {
	this.init = function() {
		Registry.ajax = new Ajax();
		Registry.commentsDiv = document.getElementById("comments");
		Registry.loginDiv = document.getElementById("login");
		Registry.commentEntryDiv = document.getElementById("comment-entry");
		
		// hijack forms
		var loginform = document.getElementById("loginform");
		
		loginform.onsubmit = function() {
			Comment.doLogin(this);
			return false; // don't want form to do new request
		}; // onsubmit

		var commentform = document.getElementById("commentform");
		//alert(commentform.nodeName);
		commentform.onsubmit = function() {
			Comment.postComment(this);
			return false;
		}; // onsubmit
		
	}; // init
	
	this.doLogin = function(form) {
		
		var formData = formData2QueryString(form);
		
		Registry.ajax.doPost('comment_svc.php?action=login', formData, this.getToken, 'text');
		
	}; // dologin
	
	this.getToken = function(response) {
		if (response.substr(0,5) == 'Error') {
			alert('Error attempting to log in.');
			return;
		}
		// store token
		Registry.token = response;
		// hide login div and display comment entry div
		Registry.loginDiv.style.display = 'none';
		Registry.commentEntryDiv.style.display = 'block';

		// start polling interval
		Registry.poll = setInterval(Comment.getComments, 3000);

	}; // gettoken
	
	this.postComment = function(form) {
		
		var formData = formData2QueryString(form);
		
		Registry.ajax.doPost('comment_svc.php?action=addcomment&token=' + Registry.token, 
							 formData, Comment.updateComments, 'text');
		//alert('post-xhr');
	}; // postComment
	
	this.getComments = function() {
		Registry.ajax.doGet('comment_svc.php?action=getcomments&token=' + Registry.token, 
							 Comment.updateComments, 'text');
		
	}; // getcomments
	
	this.updateComments = function(response) {
		if (response.substr(0,5) == 'Error') {
			// alert('Error encountered.'); // no need to send alert if no messages
			return;
		}
		
		var comments = JSON.parse(response);
		//alert(comments.length);
		
		// loop through comments array and insert at front of comments subtree
		for (var i = 0; i < comments.length; i++) {
			var tempDiv = document.createElement("DIV");
			if (Registry.commentsDiv.hasChildNodes())
				Registry.commentsDiv.insertBefore(tempDiv,Registry.commentsDiv.firstChild);
			else
				Registry.commentsDiv.appendChild(tempDiv);
			
			var tempElem = document.createElement("P");
			tempDiv.appendChild(tempElem);
			tempElem.appendChild(document.createTextNode('From: ' + comments[i].username));
			var tempElem2 = document.createElement("BR");
			tempElem.appendChild(tempElem2);
			tempElem.appendChild(document.createTextNode(comments[i].comment));
			
		}
		
	}; // updatecomments
	
	this.cleanup = function() {
		// wipe out interval timer
		clearInterval(Registry.poll);
		
	}; // cleanup
}; // comment

window.onload = Comment.init;
window.onunload = Comment.cleanup;