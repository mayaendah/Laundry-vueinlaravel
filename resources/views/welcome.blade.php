<!DOCTYPE html>
<html >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="apple-touch-icon" sizes="76x76" href=" {{ asset('assets/img/apple-icon.png') }}">

        <link rel="icon" type="image/png" href=" {{ asset('assets/img/favicon.png') }}">


        <title>Laravel</title>

        <link rel="stylesheet" href=" {{ asset('assets/css/black-dashboard.min.css') }}">
        <link rel="stylesheet" href=" {{ asset('assets/css/nucleo-icons.css') }}">
        <link href="{{ asset('assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet') }}" />

        @vite('resources/css/app.css')
    </head>
    <body>
        <div id="app"></div>

        @vite('resources/js/app.js')

        <script src="{{ asset('assets/js/core/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
        <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

        <script src="{{ asset('assets/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>

        <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/bootstrap-notify.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/black-dashboard.min.js?v=1.0.0') }}"></script>


    </body>
</html>
