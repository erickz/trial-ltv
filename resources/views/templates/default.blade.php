<html>
    <head>
        <title>LTV - @yield('titlePage')</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/fontawesome.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/solid.min.css" />
        <link href="{{ asset('assets/css/bootstrap.css') }}" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <div class="container">
            <div class="row">
                @yield('content')
            </div>
        </div>

        <script src="{{ asset('assets/js/bootstrap.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/js/handlesnsfw.js') }}" type="text/javascript"></script>
    </body>
</html>
