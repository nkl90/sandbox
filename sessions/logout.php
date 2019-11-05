<?php
    // Если пользователь не авторизован, то перенапрявляем к странице авторизации
    if (!isset($_COOKIE['login']) || !isset($_COOKIE['pass'])) {
        header("Location: /sessions/login.php");
        exit;
    }

    // Выход из учетной записи и перенаправление на страницу авторизации
    if (count($_POST) > 0) {
        setcookie('login', 0, time() - 1, '/');
        setcookie('pass', 0, time() - 1, '/');
        
        $_SESSION = array();

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