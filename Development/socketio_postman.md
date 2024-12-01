# Basic NodeJS Socket.io & Postman Setup


```
const http = require('http');
const port = 3000;

const requestHandler = (request, response) => {
  console.log(request.url);
  response.end('Hello Node.js Server!');
}

const server = http.createServer(requestHandler);

const socketIo = require("socket.io")(server, {
  cors: {
      origin: "*",
  }
});

socketIo.on("connection", (socket) => {
  console.log(`New client connected ${socket.id}`);
  socketIo.emit('hello', { message: 'Hello from server!' });

  socket.on('disconnect', () => {
    console.log('User disconnected');
  });

  socket.on('message', (data) => {
    console.log('Received message:', data);
    socketIo.emit('message', data); // Broadcast message to all connected clients
  });
});

server.listen(port, () => {
    console.log(`Server running on port ${port}`);
});
```

![](/Illustrations/Development/socketio_postman_1.png)

![](/Illustrations/Development/socketio_postman_2.png)

- https://www.youtube.com/watch?v=RWrNL-I3j7k
- https://stackoverflow.com/a/78318866
