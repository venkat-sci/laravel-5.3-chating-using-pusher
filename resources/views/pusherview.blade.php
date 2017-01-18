<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <script
        src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>

        <script src="//js.pusher.com/3.0/pusher.min.js"></script>

        <script type="text/javascript">
        $(document).ready(function(){
        
            var pusher = new Pusher("{{env("PUSHER_KEY")}}")
            var channel = pusher.subscribe('narayana');

            channel.bind('local', function(data) {

                $('ul#dataappend').append('<li>' +data.message+ '</li>');
                
            });

        });

        </script>

    </head>
    <body>
        <div class="flex-center position-ref full-height">
            
            @if (Route::has('login'))
                <div class="top-right links">
                    <a href="{{ url('/login') }}">Login</a>
                    <a href="{{ url('/register') }}">Register</a>
                </div>
            @endif
            <ul id="dataappend">

            </ul>
            </div>
        </div>
    </body>
</html>
