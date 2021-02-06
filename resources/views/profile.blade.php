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
        }

        .main {
            display: flex;
            flex-direction: row;
            justify-content: center;
            width: 100%;
            height: 500px;
        }

        .main > .user-info {
            background-color: #9099a1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        h4{
            text-align: center;
        }
    </style>
</head>

<body>
<div class="main">
    <div class="user-info">
        <a href="{{URL::to("logout")}}">logout</a>

        @if(isset($decodedUserData["personaName"]))
            <img src="{{$decodedUserData["avatarUrl"]}}" alt="user avatar" width="250px" height="250px"/>
            <h4>{{ $decodedUserData["personaName"] }}</h4>
        @endif
    </div>
</div>
</body>


