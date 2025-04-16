<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email Verifikasi</title>
</head>
<body>
    <p>
        Ini adalah link verifikasi akun {{ env('APP_NAME') }} <a href="{{ route('email.verification', ['token' => $token]) }}">{{ route('email.verification', ['token' => $token]) }}</a>
    </p>
</body>
</html>