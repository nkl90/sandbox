<?php
    include_once 'functions.php';

    // Проверка на наличие сессии
    if (session_status() == 1) {
        session_start();
    }

    // Если пользователь не авторизован, то перенапрявляем к странице авторизации
    if (empty($_SESSION['user_id'])) {
        header("Location: /roles/login.php");
        exit;
    }

    // Выход из учетной записи и перенаправление на страницу авторизации
    if (count($_POST) > 0) {
        session_unset();
        setcookie('PHPSESSID', 0, time() - 1, '/');
        session_destroy();

        header("Location: /roles/login.php");
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
    <div>
        <?php
            showUser();
            showRoles();
        ?>
    </div>
</body>
</html>