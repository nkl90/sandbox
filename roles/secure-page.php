<?php
    include_once 'functions.php';

    // Проверка на наличие сессии
    if (session_status() == 1) {
        session_start();
    }

    // Проверка на авторизацию пользователя
    if (!$_SESSION['isAuth']) {
        header("Location: /roles/login.php");
        exit;
    } else {
        // В этой ветке происходит проверка доступа к странице
        // Доступ имеют пользователи не ниже ROLE_USER
        $roles = getRoles($_SESSION['user_id']);

        if (!in_array("ROLE_USER", $roles)) {
            echo 'Извините, но у вас недостаточно прав для просмотра этой страницы! <br>';
            showRoles();
            exit;
        }
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
    <div>
        <?php showRoles(); ?>
    </div>
</body>
</html>
