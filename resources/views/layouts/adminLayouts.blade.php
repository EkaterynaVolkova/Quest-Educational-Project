<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THE QUEST</title>
    <meta charset="UTF-8">
    {{HTML::style('../bootstrap/bootstrap/css/bootstrap.css')}}
    {{HTML::style('css/AdminGeneral/adminBody.css')}}
    {{HTML::style('css/AdminGeneral/adminNav.css')}}
    {{HTML::style('css/AdminGeneral/tables.css')}}
    @yield('style')
</head>
<body>

<header>
    @include('Admin.nav')
</header>
<div class="row">
    @include('Admin.leftNav')
    @yield('content')
</div>
<footer></footer>

{{HTML::script('../bootstrap/bootstrap/js/bootstrap.js')}}

</body>
</html>
