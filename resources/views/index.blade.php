<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script
        src="https://code.jquery.com/jquery-2.2.4.js"
        integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
        crossorigin="anonymous"></script>
    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .selectedImg{
            background: rgba(107, 129, 162,0.2);
            border-radius: 10px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            <b>Galery</b>
        </div>
        <div>
            <h3><a href="{{ route('creations.index') }}"><b>HISTORIQUE DES CREATIONS</b></a></h3>
            <a href="{{ route("sendmail") }}"><button class="btn btn-lg btn-primary">Send Mail</button></a>
        </div>
        <div class="container">
            <form action="{{ route('resultFusion') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <h1><b>Galery Shirts</b></h1>
                @foreach($shirts as $shirt)
                    <label><input value="{{ $shirt->id }}" type="radio" name="shirt" style="visibility: hidden"><img class="img" src="{{ asset("imgs/shirts/".$shirt->id.".png")}}" style="width: 200px"></label>
                @endforeach
                <h1><b>Galery Logos</b></h1>
                @foreach($logos as $logo)
                    <label><input value="{{ $logo->id }}" type="radio" name="logo" style="visibility: hidden"><img class="logo" src="{{ asset("imgs/logos/".$logo->id.".png")}}" style="width: 200px"></label>
                @endforeach
                <br><br><br><br><br><br>
                <a href="{{route("addImage")}}"><input type="button" class="btn btn-success" value="Upload your Image"></a>
                <br><input class="btn btn-lg btn-primary" type="submit">
            </form>
            <br><br><br><br><br><br>
        </div>
        <div class="links">
            <a href="/images">Accueil</a>
        </div>
    </div>
</div>
</body>
<script>
    $('.img').click(function () {
        $('.img').removeClass("selectedImg");
        $(this).addClass("selectedImg");
    })
    $('.logo').click(function () {
        $('.logo').removeClass("selectedImg");
        $(this).addClass("selectedImg");
    })
</script>
</html>
