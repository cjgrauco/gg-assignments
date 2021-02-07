<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Steam login</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito';
            margin: 0;
        }

        .main > .header {
            display: flex;
            align-items: center;
            height: 5rem;
            background-color: #171a21;

        }

        .header > a {
            margin-left: 1rem;
        }

        .main > .placeholder {
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-content: center;
            background: linear-gradient(180deg, #262D33 -3.38%, #1b2838 78.58%)
        }
    </style>

</head>
<body>
<div class="main">
    <div class="header">
        <a href="{{URL::to("login")}}">
            <img src="https://community.cloudflare.steamstatic.com/public/images/signinthroughsteam/sits_01.png"
                 alt="Steam login button">
        </a>
    </div>
    <div class="placeholder"></div>
</div>
</body>
</html>
