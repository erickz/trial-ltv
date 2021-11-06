<html>
    <head>
        <title>LTV - @yield('titlePage')</title>
        <link href="{{ asset('assets/css/bootstrap.css') }}" type="text/css" rel="stylesheet" />
        <script src="{{ asset('assets/js/bootstrap.js') }}" type="text/javascript"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                @yield('content')
            </div>
        </div>
    </body>
</html>
