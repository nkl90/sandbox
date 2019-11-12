<?php
    // Инициализируем сессию
    session_start();

    // Если пользователь не авторизован, то перенапрявляем к странице авторизации
    if (empty($_SESSION['login']) || empty($_SESSION['pass'])) {
        header("Location: /sessions/login.php");
        exit;
    }

    $content = 'Информация защищенная от анонимных пользователей!'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Secure page</title>
</head>
<body>
    <div class="content">
        <?=$content ?>
    </div>
</body>
</html>