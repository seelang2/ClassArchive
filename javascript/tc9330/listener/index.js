var ws = require("nodejs-websocket")

// Scream server example: "hi" -> "HI!!!"
var server = ws.createServer(function (conn) {
	console.log("New connection");
	
	conn.on("text", function (str) {
		console.log("Received "+str);
		//conn.sendText(str.toUpperCase()+"!!!");
		data = JSON.parse(str);
		data.timestamp = new Date().getTime();
		conn.sendText(JSON.stringify(data));
	});
	
	conn.on("close", function (code, reason) {
		console.log("Connection closed");
	});

	
}).listen(8001);
