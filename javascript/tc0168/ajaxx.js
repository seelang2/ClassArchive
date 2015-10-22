function Ajaxx() {

  this.req = null;
  this.method = null;
  this.respType = null;
  this.url = null;
  this.dataPayload = null;
  this.responseText = null;
  this.responseXML = null;
  this.handleResp = null;
  this.async = true;

  this.init = function() {
    if (!this.req) {
      try {
        this.req = new XMLHttpRequest();
      }
      catch (e) {
        try {
          this.req = new ActiveXObject('MSXML2.XMLHTTP');
        }
        catch (e) {
          try {
            this.req = new ActiveXObject('Microsoft.XMLHTTP');
          }
          catch (e) {
            return false;
          }
        }
      }
    }
    return this.req;
  }; // this.init


  this.sendreq = function(method, url, handlerfunc, postData, respType, async) {
    var self = this;

    this.method = method;
    this.url = url;
    this.handleResp = handlerfunc;
    this.respType = respType;
    this.dataPayload = postData;
    this.async = async || true;

    if (!this.init()) {
      alert('Could not create XMLHttpRequest object.');
      return;
    }

    req = this.req;
    var self = this;

    req.open(this.method, this.url, this.async);

    if (this.method == "POST") {
      this.req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    }
    if (this.method == 'POST') {
      req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    }

    req.onreadystatechange = function() {

      self.readyState = req.readyState;
      if (req.readyState == 4) {

        self.responseText = req.responseText;
        self.responseXML = req.responseXML;

        switch (self.respType) {
          case 'xml' :
		resp = req.responseXML;
          break;
          default:
            resp = req.responseText;
          break;
        }

        if (req.status > 199 && req.status < 300) {
          if (!self.handleResp) {
            alert('No response handler defined ' +
              'for this XMLHttpRequest object.');
            return;
          }
          else {
            self.handleResp(resp);
          }

        } // req.status

      } // req.readystate
    } // onreadystatechange

    this.req.send(this.dataPayload);



  }; // this.sendreq



} // function Ajaxx