<!DOCTYPE html>
<html>
    <head>
        <title>Laravel Weblog - @yield('title')</title>
    </head>
    <body>
        @include('partials.nav')
        @include('partials.errors')
        @yield('content')
    </body>
</html>