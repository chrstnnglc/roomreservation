<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Document</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        
        <!--<link rel="stylesheet" href="{{ elixir('css/app.css') }}">-->

        @yield('header')
    </head>
    <body>
        <div class="container">
            @yield('content')
        </div>

        @yield('footer')
    </body>
</html>
