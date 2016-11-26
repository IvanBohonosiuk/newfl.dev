var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var Redis = require('ioredis');
var redis = new Redis(6379, '127.0.0.1');

redis.psubscribe('project', function(err, count) {

});

redis.on('pmessage', function(subscribed, channel, message) {
    message = JSON.parse(message);
    io.emit(channel + '[' + message.event + ']', message.data);
    io.emit(channel, message.data);

    console.log(channel, message);
});

http.listen(6378, function(){
    console.log('Server runned');
});