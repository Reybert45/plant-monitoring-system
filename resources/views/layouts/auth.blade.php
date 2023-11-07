<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MIFS :: @yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/mifs_logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extensions/dripicons/dripicons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extensions/fontawesome/all.min.css') }}">
</head>

<body>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left"><br><br><br><br>
                    @yield('content')
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">
                    <div class="row justify-content-center text-center">
                        <div class="col-md-6"><br><br><br>
                            <img src="{{ asset('assets/images/mifs_logo.png') }}" class="logo-bg" alt="MIFS Logo" width="100%">

                            <h1 class="text-white mt-4">GROWING GREEN</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/static/js/initTheme.js') }}"></script>
    @yield('script')
</body>
</html>