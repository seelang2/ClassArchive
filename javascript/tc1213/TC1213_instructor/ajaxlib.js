


function ajaxCreateReq() {
      try {
        req = new XMLHttpRequest();
      }
      catch (e) {
        try {
          req = new ActiveXObject('MSXML2.XMLHTTP');
        }
        catch (e) {
          try {
            req = new ActiveXObject('Microsoft.XMLHTTP');
          }
          catch (e) {
            return false;
          }
        }
      }
    return req;
} // ajaxCreateRequest


function ajaxSendReq(method, url, handlerfunc, postData, respType, async) {

	req = ajaxCreateReq();

	if (!req) {
		alert('Could not create XMLHttpRequest object.');
		return;
	}

	if (respType != 'XML') { respType = 'TEXT'; }

	if (async == null) { async = true; } else { async = false; }

	req.open(method, url, async);

	if (method == 'POST') { 
		req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	}

	req.onreadystatechange = function() {
		if (req.readyState == 4) {
			
			switch(respType) {
				case 'XML' :
					resp = req.responseXML;
				break;

				case 'TEXT' :
					resp = req.responseText;
				break;
			}

			if (req.status > 199 && req.status < 300) {			
				if (!handlerfunc) {
					alert('No response handler defined for this XMLHttpRequest Object!');
					return;
				} else {
					handlerfunc(resp);
				}
			}
		}
	}

	req.send(postData);

} // ajax_sendreq



