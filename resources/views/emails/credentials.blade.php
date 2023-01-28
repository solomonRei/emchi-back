<!DOCTYPE html>
<html lang="ru">
<head>
    <style>
        .title {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
        }
        .greetings {
            font-size: 18px;
            margin-bottom: 20px;
        }
        .credentials-container {
            font-size: 16px;
            margin-top: 20px;
        }
        .credentials-container > p {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="title">ЭМЧИ</div>
<div class="credentials-container">
    <p>Ваши данные для входа:</p>
    <p>Логин: {{ $login }}</p>
    <p>Пароль: {{ $password }}</p>
</div>
</body>
</html>
