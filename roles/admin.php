<?php
    include_once 'functions.php';

    // Проверка на наличие сессии
    if (session_status() == 1) {
        session_start();
    }

    // Проверка на авторизацию пользователя
    if (empty($_SESSION['user_id'])) {
        header("Location: /roles/login.php");
        exit;
    } else {
        // В этой ветке происходит проверка доступа к странице
        // Доступ имеют пользователи не ниже ROLE_ADMIN
        $roles = getRoles($_SESSION['user_id']);

        if (!in_array('ROLE_ADMIN', $roles)) {
            echo 'Для доступа к этой странице нужно обладать правами администратора! <br>';
            showUser();
            showRoles();
            exit;
        }
    }

    $content = 'Информация для администратора!';
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
        <?php
            showUser();
            showRoles();
        ?>
    </div>
</body>
</html>
