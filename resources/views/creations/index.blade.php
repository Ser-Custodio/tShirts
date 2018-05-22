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
        .imageCreation{
            max-height: 300px;
            margin : 20px 20px 20px 20px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            <b>HISTORIQUE DES CREATIONS</b>
        </div>
        <div class="container">
            @foreach($creations as $creation)
                <a href="{{route("afficherCreation", $creation)}}" target="_blank"><img src="{{route("afficherCreation", $creation)}}" class="imageCreation" title="Cliquez pour agrandir"></a>
            @endforeach
            <br><br> <br><br><br><br><br>
            <a href="{{route('images.index')}}"><button class="btn btn-success btnNewCreation">Nouvelle création</button></a>

        </div>
        <div class="links">
            <a href="/images">Accueil</a>
            <a href="{{ route("generatePDF") }}"><button class="btn btn-lg btn-primary">Download PDF</button></a>
        </div>
    </div>
</div>
</body>

</html>
