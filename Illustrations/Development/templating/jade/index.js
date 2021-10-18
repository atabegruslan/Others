var jade = require('jade');
var html = jade.renderFile('template.jade');
var http = require("http");
http.createServer(function(request, response) {
    response.writeHead(200, {"Content-Type": "text/html;charset=utf-8"});
    response.write(html);
    response.end();
}).listen(8080);
