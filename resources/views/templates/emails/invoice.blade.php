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

<p>Hi {{$data['receiver']}},</p>
<p>A new invoice has been created on your account. You may find a PDF of your invoice attached.</p>
<p>Thank you for your business!</p>
<p>With Regards, </p>
<p>{{$data['sender']}}</p>

</body>
</html>
