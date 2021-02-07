<!DOCTYPE html>
<?php $decodedUserData = json_decode(request()->cookie("userData"), true); ?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Profile</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito';
            margin: 0;
        }

        .main {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            width: 100%;
            height: 100vh;
            background: linear-gradient(180deg, #262D33 -3.38%, #1b2838 78.58%)
        }

        .main > .user-info-wrapper {
            display: flex;
            justify-content: center;
        }

        .user-info > h3 {
            text-align: center;
        }

        .main > .header {
            display: flex;
            align-items: center;
            height: 5rem;
            background-color: #171a21;
        }

        .header > a {
            color: white;
            margin-left: 1rem;
            text-decoration: none;
        }

        .user-info-wrapper > .user-info {
            border: 1px #89898B solid;
            background: linear-gradient(90deg, rgba(115, 173, 184, 0.247) 0%, rgba(43, 45, 68, 0.93) 90%);
            margin-top: 3rem;
            width: 250px;
            display: flex;
            flex-direction: column;
            align-content: center;
            color: white;
        }

        .user-info > img {

            border-bottom: 1px #89898B solid;
        }
    </style>
</head>

<body>
<div class="main">
    <div class="header">
        <a href="{{URL::to("logout")}}">logout</a>
    </div>
    <div class="user-info-wrapper">

        @if(isset($decodedUserData["personaName"]))
            <div class="user-info">
                <img src="{{$decodedUserData["avatarUrl"]}}" alt="user avatar" width="250px" height="250px"/>
                <h3>{{ $decodedUserData["personaName"] }}</h3>
            </div>
        @endif
    </div>
</div>
</body>


