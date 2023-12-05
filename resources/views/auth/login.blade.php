<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <link id="rtl-link" rel="stylesheet" type="text/css" href="{{ asset('frontend/css/vendors/bootstrap.css') }}">
</head>
<body>
    <div class="d-flex align-items-center justify-content-center w-100" style="min-height: 100vh;">
        <div>
            <div class="text-center">
                <img src="{{ asset('frontend/images/logo/1.png') }}" class="mb-5" width="200"/>
            </div>
            <h3 class="mb-2">Selamat datang di<br>Aplikasi Point of Sales</h3>
            <small>Silahkan masukkan email dan<br>password untuk melanjutkan</small>
            <form method="post" action="{{ route('login.auth') }}" class="mt-4">
                @csrf
                <input class="form-control mb-3" type="email" name="email" id="email" required>
                <input class="form-control mb-3" type="password" name="password" id="password" required>
                <button class="btn btn-success" type="submit">Login</button>

                @if (session()->get('message'))
                <p>{{ session()->get('message') }}</p>
                @endif
            </form>
        </div>
    </div>


</body>
</html>
