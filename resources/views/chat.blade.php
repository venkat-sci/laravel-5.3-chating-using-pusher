<!DOCTYPE html>
<html>
<head>
    <title>Real-Time Laravel with Pusher</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    
    <link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,200italic,300italic" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://d3dhju7igb20wy.cloudfront.net/assets/0-4-0/all-the-things.css" />

    <style>

        .container{
            padding-top:30px;
        }

        #messages {
            height: 300px;
            overflow: auto;
            padding-top: 5px;
        }
        .darkest-grey, .chat-app .message .text-display .message-body{
            color: #FFFFFF;
            font-family: "Source Sans Pro"
            font-weight: 300;
        }

        .message-body
        {
            background-color: #1f7ce2;
            display: inline-block;
            min-width: 300px;
            border-radius: 10px;
            padding: 10px 10px;

        }
        .messageright{
            text-align: right !important;
        }

    </style>

    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://cdn.rawgit.com/samsonjs/strftime/master/strftime-min.js"></script>
    <script src="//js.pusher.com/3.0/pusher.min.js"></script>

    <script>

        // Ensure CSRF token is sent with AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Added Pusher logging
        Pusher.log = function(msg) {
            console.log(msg);
        };

    </script>
</head>
<body class="blue-gradient-background">

<section>
    
    <div class="container">
                <div class="row light-grey-blue-background">
                    <div class="col-xs-12">
                        <input type="text" name="name" id="username" placeholder="Enter your name ">
                    </div>
                </div>
        <div class="row light-grey-blue-background chat-app">
            
            <div id="messages">
                <div class="time-divide">
                    <span class="date">Today</span>
                </div>
            </div>

            <div class="action-bar">
                <textarea class="input-message col-xs-11" placeholder="Your message"></textarea>

                <div class="option col-xs-1 green-background send-message">
                    <span class="white light fa fa-paper-plane-o"></span>
                </div>

            </div>

        </div>
    </div>
</section>

<script id="chat_message_template" type="text/template">
    <div class="message">

        <div class="text-display">
            <div class="message-data">
                <span class="author"></span>
                <span class="timestamp"></span>
                <span class="seen"></span>
            </div>
            <div class="message-body"></div>
        </div>

    </div>
</script>

<script>
    function init() {
        
        if(!$("#username").val()){
            $(".chat-app").hide();
        }

        $("#username").focus(function(){
            $(".chat-app").show();
        });

        $("#username").focusout(function(){
            if(!$("#username").val()){
                $(".chat-app").hide();
            }
        });

        // send button click handling
        $('.send-message').click(sendMessage);
        $('.input-message').keypress(checkSend);
    }

    // Send on enter/return key
    function checkSend(e) {
        if (e.keyCode === 13) {
            return sendMessage();
        }
    }

    // Handle the send button being clicked
    function sendMessage() {
        var messageText = $('.input-message').val();
        var author = $("#username").val();
        if(messageText.length < 3) {
            return false;
        }

        // Build POST data and make AJAX request
        var data = {chat_text: messageText,author:author};

        $.post('/chat/message', data).success(sendMessageSuccess);

        // Ensure the normal browser event doesn't take place
        return false;
    }

    // Handle the success callback
    function sendMessageSuccess() {
        $('.input-message').val('')
        console.log('message sent successfully');
    }

    // Build the UI for a new message and add to the DOM
    function addMessage(data) {
        // Create element from template and set values
        var el = createMessageEl();
        el.find('.message-body').html(data.text);
    
        el.find('.author').text(data.author);    
        // Utility to build nicely formatted time
        el.find('.timestamp').text(strftime('%H:%M:%S %P', new Date(data.timestamp)));
            
          //  alert(data.author+"---"+$("#username").val());

        if(data.author == $("#username").val()){
            console.log(el.addClass("messageright"));
        }

        var messages = $('#messages');
        messages.append(el)
        
        // Make sure the incoming message is shown
        messages.scrollTop(messages[0].scrollHeight);
    }

    // Creates an activity element from the template
    function createMessageEl() {
        var text = $('#chat_message_template').text();
        var el = $(text);
        return el;
    }

    $(init);

    /***********************************************/

    var pusher = new Pusher('{{env("PUSHER_KEY")}}');

    var channel = pusher.subscribe('{{$chatChannel}}');
    channel.bind('new-message', addMessage);

</script>

</body>
</html>