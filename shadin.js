const http = require('http');
const { Server } = require('socket.io');

const PORT = process.argv[2]|| process.env.PORT || 8082


const serrver = http.createServer();

const io = new Server(serrver);


const sessionMap = new Map();

function getRandomInDhaka(){
    // Define the boundaries of Dhaka city as a rectangle
    var minLat = 23.65; // south
    var maxLat = 23.85; // north
    var minLng = 90.30; // west
    var maxLng = 90.50; // east

    // Generate a random latitude and longitude within the rectangle
    var randomLat = Math.random() * (maxLat - minLat) + minLat;
    var randomLng = Math.random() * (maxLng - minLng) + minLng;
    return {lat: randomLat, lng: randomLng}
}

/*
    1. on A client location share connect to server
    2. on B client get location connect ot server
    3. B client request for location share
    4. A client receve request location share and emit locations
    5. B client get emted locations and show in map
*/

io.on('connection', function (client) {
        const id = client.id;
        let timer = null;

        io.emit("USER_ADD", "add new user: "+id);


        client.on("disconnecting", (reason) => {
           console.log("Discunnect: ", reason);
           sessionMap.delete(id)
;
           clearInterval(timer);
        });

        client.on("IDENTITY", (message) => {
            io.emit("CLIENT", message);
            // sessionMap.set(id, {socketId: id, ...message});
            console.log("indentity : ", message.role)
            if(message.role=='receiver'){
                timer = setInterval(()=>{
                    console.log("emit emit emit", getRandomInDhaka())
                    client.emit("LOCATIONS", getRandomInDhaka());
                }, 10000)
            }
        });
});

// Console will print the message
console.log('Server running at http://127.0.0.1:'+PORT);

serrver.listen(PORT, "0.0.0.0");
