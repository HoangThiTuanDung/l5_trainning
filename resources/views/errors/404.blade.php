<!DOCTYPE html>
<html>
    <head>
        <title>404 Error</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ URL::to('src/css/404.css') }}">
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">{{ isset($message) ? $message : 'Request not found'}}</div>
            </div>
        </div>
    </body>
</html>
