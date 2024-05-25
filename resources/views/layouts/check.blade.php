<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Team Registration</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code&family=Montserrat&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('public/css/core.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/socialSettings.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/generalSettings.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/command-module.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type='text/javascript' src="{{ asset('public/js/jquery-ui/jquery-ui.min.js') }}"></script>

</head>
<body class="darkmode">
    <canvas></canvas>
    <div class="interface-outer">
        <div class="interface-inner">

            <div class="lower-area-outer">
                <div class="lower-area-inner">

                    <div class="content-outer">
                        <div class="content-inner">
                            @if(session()->has('alert'))
                                <div class="alert alert-{{ session('alert_type', 'info') }}">
                                    {{ session('alert') }}
                                </div>
                            @endif
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include scripts -->
    <script type='text/javascript' src="{{asset('public/js/quantum2.js')}}"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
            // Your JavaScript code here
        });
    </script>
    @yield('scripts')
</body>
</html>
