<html>
    <head>
        <title>LTV - @yield('titlePage')</title>
        <link href="{{ asset('bootstrap.css') }}" type="text/css" rel="stylesheet" />
        <script src="{{ asset('bootstrap.js') }}" type="text/javascript"></script>
    </head>
    <body>
        <div class="content">
            @yield('content')
        </div>
    </body>
</html>
