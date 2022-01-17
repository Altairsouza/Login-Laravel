<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Private Area</title>
    <link rel="stylesheet" href="{{asset('assets/bootstrap/bootstrap.min.css')}}">
</head>
<body>

    @include('userbar')
    @yield('conteudo')


        <script src="{{asset('assets/bootstrap/jguery.min.js')}}"></script>
        <script src="{{asset('assets/bootstrap/bootstrap.bundle.min.js')}}"></script>

</body>
</html>
