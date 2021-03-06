<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">

            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/">Главная</a>
            </li>            
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="/types">Типы</a>
            </li>
            @foreach ($types as $type)
                <li class="nav-item">
                <a class="nav-link" aria-current="page" href="/?type={{$type->id}}">{{$type->name}}</a>
            </li>
            @endforeach
            @auth
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="/flowers/create">Добавить цветок</a>
            </li>
            @endauth
            @auth
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="/logout">Выйти</a>
            </li>
            @endauth
            @guest
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="/login">Войти</a>
            </li>
            @endguest
        </ul>
        </div>
</nav>
     <div class="container">
         @yield('content')
     </div>
</body>
</html>
