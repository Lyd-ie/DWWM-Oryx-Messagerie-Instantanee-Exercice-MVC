// détermination de la couleur de l'utilisateur pour la session courante
const colors = ['#007AFF', '#FF7000', '#FF7000', '#15E25F', '#CFC700', '#CFC700', '#CF1100', '#CF00BE', '#F00'];
const color_pick = Math.floor(Math.random() * colors.length);
const color = colors[color_pick];

// split de l'url afin de déterminer le numéro de la chatbox courante
var url = window.location.href;
const urlExploded = url.split('/');
const room = urlExploded[urlExploded.length - 1];

//create a new WebSocket object.
var msgBox = $('#message-box');
var wsUri = "ws://localhost:9000/server.php";

websocket = new WebSocket(wsUri);

websocket.onopen = function(ev) { // connection is open 
    msgBox.append('<div class="system_msg" style="color:#bbbbbb">Welcome to my "Demo WebSocket Chat box"!</div>'); //notify user
    scrollToBottom();
}
// Message received from server
websocket.onmessage = function(ev) {
    var response = JSON.parse(ev.data); //PHP sends Json data

    var res_type = response.type; //message type
    var user_message = response.message; //message text
    var user_name = response.name; //user name
    var user_color = response.color; //color
    var user_room = response.room; //message room

    switch (res_type) {
        case 'usermsg':
            // n'envoie le message que dans la room dont le numéro est le même que celle d'où écrit l'utilisateur
            if (user_room === room) {
            msgBox.append('<div><span class="user_name" style="color:' + user_color + '">' + user_name + '</span> : <span class="user_message">' + user_message + '</span></div>');
            }
            break;
        case 'system':
            msgBox.append('<div style="color:#bbbbbb">' + user_message + '</div>');
            break;
    }
    msgBox[0].scrollTop = msgBox[0].scrollHeight; //scroll message 

};

websocket.onerror = function(ev) {
    msgBox.append('<div class="system_error">Error Occurred - ' + ev.data + '</div>');
};
websocket.onclose = function(ev) {
    msgBox.append('<div class="system_msg">Connection Closed</div>');
    scrollToBottom();
};

//Message send button
$('#send-message').click(function() {
    send_message();
});

//User hits enter key 
$("#message").on("keydown", function(event) {
    if (event.which == 13) {
        send_message();
    }
});

//Send message
function send_message() {

    var message_input = $('#message'); //user message text
    var name_input = $('#name'); //user name

    if (message_input.val() == "") { //empty name?
        alert("Enter your Name please!");
        return;
    }
    if (message_input.val() == "") { //emtpy message?
        alert("Enter Some message Please!");
        return;
    }

    //prepare json data
    var msg = {
        message: message_input.val(),
        name: name_input.val(),
        color: color,
        room: room
    };

    // déclenche la fonction store_data() avec en paramètre les informations composant le message
    store_message(msg);

    //convert and send data to server
    websocket.send(JSON.stringify(msg));
    message_input.val(''); //reset message input
}

// Envoie le message à chatController()->chatIndex() dans un $_POST
function store_message(msg) {

    var message = msg.message;
    var user = msg.name;
    var color = msg.color;
    var room = msg.room;
    
    $.ajax({
        method: "POST",
        url: window.location.href, // Correspond à chatController()->chatIndex()
        data: { message: message, 
                user: user,
                color: color,
                room: room },
    });
}

// Vérifie que les deux mots de passe saisis par l'utilisateur sont identiques
// Affiche le résultat dans un span.
function valid() {
    let password = document.querySelector("input[name='password']");
    let checkPassword = document.querySelector("input[name='pswdconfirm']");
    let submitButton = document.querySelector("button");
    let pswdMsg = document.getElementById("pswdCheck");

    if (password.value == checkPassword.value && password.value !=="" && checkPassword.value !=="") {
            submitButton.disabled = false;
            pswdMsg.innerHTML = "✔";
            pswdMsg.style.color = "green";
            checkPassword.style.marginLeft = "3.5%";
    } else {
            submitButton.disabled = true;
            pswdMsg.innerHTML = "✖";
            pswdMsg.style.color = "red";
            checkPassword.style.marginLeft = "3.5%";
    }
}

// Scroll en bas des messages enregistrés lors du chargement de la page
window.onload = ()=> {
    const messageBox = document.querySelector("#message-box");
    messageBox.scrollTop = messageBox.scrollHeight;
};

// Scroll en bas des messages enregistrés lors de la connexion à la chatbox
function scrollToBottom() {
    const messageBox = document.querySelector("#message-box");
    messageBox.scrollTop = messageBox.scrollHeight;
};