<?php
    // Инициализируем сессию
    session_start();

    // Если пользователь не авторизован, то перенапрявляем к странице авторизации
    if (empty($_SESSION['login']) || empty($_SESSION['pass'])) {
        header("Location: /sessions/login.php");
        exit;
    }

    // Выход из учетной записи и перенаправление на страницу авторизации
    if (count($_POST) > 0) {
        session_unset();

        header("Location: /sessions/login.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="logout.php" method="post">
        <input type="submit" value="Выйти" name="logout">
    </form>
</body>
</html>