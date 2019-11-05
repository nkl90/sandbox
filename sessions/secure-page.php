<?php
    // Аутентификация пользователя для доступа к этой странце
    // При неудаче переброс на страницу авторизации
    if (!isset($_COOKIE['login']) || !isset($_COOKIE['pass'])) {
        header("Location: /sessions/login.php");
        exit;
    }

    $content = 'Защищенная информация от анонимных пользователей!'
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