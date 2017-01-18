<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    <a href="{{ url('/login') }}">Login</a>
                    <a href="{{ url('/register') }}">Register</a>
                </div>
            @endif

            <div class="content">

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                    <div class="panel-heading">Push message</div>
                    <div class="panel-body">
                            
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/postpush') }}">
                            {{ csrf_field() }}
                            <input type="text" name="message">
                            <input type="submit" name="Push">
                            </form>

                    </div>
                    </div>
                </div>
            </div>

            </div>
        </div>
    </body>
</html>
