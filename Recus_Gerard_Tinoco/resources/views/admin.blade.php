<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script id="functions" user-id="{{ $user_id }}" src="{{ asset('js/functions.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
    <body>
        <form action="{{url('send/')}}" method="POST">
        <input type="text" name="n1" class="n1"><br>
        <button type="submit" class="btn">Enviar</button>
        </form>
    </body>
</html>