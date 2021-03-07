<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>{{$data['receiver']}}</h1>
<h1>{{$data['sender']}}</h1>
{{--<img src="{{ $data['banner_url']}}"/>--}}
{{--<img src="@php echo  $data['banner_url'] @endphp"/>--}}
<img src="<?php echo $data['banner_url']?>" width="150" height="150"/>
</body>
</html>
