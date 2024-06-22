const express = require('express');
const http = require('http');
const socketIo = require('socket.io');

const app = express();
const server = http.createServer(app);
const io = socketIo(server, {
    cors: {
        origin: "http://app.quantumsocial.local", // Adjust to your client app's URL
        methods: ["GET", "POST"]
    }
});

let clients = {};

io.on('connection', (socket) => {
    console.log('A user connected', socket.id);

    socket.on('register', (userId) => {
        clients[userId] = socket.id;
        console.log(`User registered: ${userId} with socket ID: ${socket.id}`);
        console.log('Current clients:', clients);
    });

    socket.on('disconnect', () => {
        console.log('User disconnected:', socket.id);
        for (const [userId, socketId] of Object.entries(clients)) {
            if (socketId === socket.id) {
                delete clients[userId];
                console.log(`User unregistered: ${userId}`);
                console.log('Current clients:', clients);
                break;
            }
        }
    });

    socket.on('buttonClicked', (targetUserId) => {
        console.log('buttonClicked event received:',targetUserId);


            io.to(targetUserId).emit('updateClients');

    });
});

const PORT = process.env.PORT || 3000;
server.listen(PORT, () => {
    console.log(`Server running on port ${PORT}`);
});
