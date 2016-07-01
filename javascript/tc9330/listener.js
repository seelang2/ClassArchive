var net = require('net');

// HOST isn't necessary as if omitted, the server will listen on all host interfaces
//var HOST = '10.3.13.111';
var PORT = 856;

// ref: http://stackoverflow.com/questions/10750303/how-can-i-get-the-local-ip-address-in-node-js
// ref: http://nodejs.org/api/os.html#os_os_networkinterfaces
// ref: https://nodejs.org/api/net.html#net_server_listen_port_hostname_backlog_callback
/*
var os = require('os');
var interfaces = os.networkInterfaces();
var addresses = [];
for (var k in interfaces) {
    for (var k2 in interfaces[k]) {
        var address = interfaces[k][k2];
        if (address.family === 'IPv4' && !address.internal) {
            addresses.push(address.address);
        }
    }
}
console.log(addresses);
*/

// Create a server instance, and chain the listen function to it
// The function passed to net.createServer() becomes the event handler for the 'connection' event
// The sock object the callback function receives UNIQUE for each connection
net.createServer(function(sock) {
    
    // We have a connection - a socket object is assigned to the connection automatically
    console.log('CONNECTED: ' + sock.remoteAddress +':'+ sock.remotePort);
    
    // Add a 'data' event handler to this instance of socket
    sock.on('data', function(data) {
        // testing revealed ctrl-c code as 65533(?)
        if (data.toString().charCodeAt(0) === 65533) { // ref: http://stackoverflow.com/a/30575667/4709995
            sock.destroy();
            return;
        }
        
        console.log('DATA ' + sock.remoteAddress + ': ' + data);
        // Write the data back to the socket, the client will receive it as data from the server
        sock.write('You said "' + data + '"');
        
    });
    
    // Add a 'close' event handler to this instance of socket
    sock.on('close', function(data) {
        console.log('CLOSED: ' + sock.remoteAddress +' '+ sock.remotePort);
    });
    
}).listen(PORT);
//}).listen(PORT, HOST);

//console.log('Server listening on ' + HOST +':'+ PORT);