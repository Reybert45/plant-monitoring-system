<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MIFS:: @yield('title')</title>

    <link rel="shortcut icon" href="{{ asset('assets/images/mifs_logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/error.css') }}">
</head>

<body>
    <script src="assets/static/js/initTheme.js"></script>
    <div id="error">
        <div class="error-page container">
            <div class="col-md-8 col-12 offset-md-2">
                <div class="text-center">
                    @yield('contents')
                </div>
            </div>
        </div>
    </div>
</body>

</html>