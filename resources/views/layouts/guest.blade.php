<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }} - Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>

<body class="bg-light d-flex align-items-center justify-content-center min-vh-100">

<div class="bg-white p-4 rounded shadow" style="width:100%;max-width:420px">
    @yield('content')
</div>

</body>
</html>
