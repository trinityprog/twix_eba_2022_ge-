<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        html,body{
            font-family: 'Arial', sans-serif !important;
            font-size: 14px;
        }
    </style>
</head>
<body>
<h1 style="font-size: 18px; color: #3c1400;">{{ url('/') }}</h1>

<h3 style="">Ваш вопрос: {{ $requestData['message'] }}</h3>
<h3 style="">Ответ:</h3>
<div class="content" style="display: block;width: 80%; padding: 30px; background: #dedede">
    {{ $requestData['answer'] }}
</div>
<br><h3 style="font-size: 12px;">Не отвечайте на это сообщение.</h3>

</body>
</html>
