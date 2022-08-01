<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{env('APP_NAME')}}</title>
    </head>
    <body class="antialiased">
    <form action="{{route('register')}}" method="POST">
        @csrf
        <input type="text" name="login" placeholder="Login"/>
        <input type="password" name="password"/>
        <button type="submit">Register</button>
    </form>
    </body>
</html>
