<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">

    {{HTML::style('../bootstrap/bootstrap/css/bootstrap.css')}}
    @yield('style')
</head>
<body>
    @yield('content')
    {{HTML::script('../bootstrap/bootstrap/js/bootstrap.js')}}

</body>
</html>
