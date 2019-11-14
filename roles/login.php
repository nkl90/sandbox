<?php
    include_once 'functions.php';

    // Проверка на наличие сессии
    if (session_status() == 1) {
        session_start();
    }

    // Если пользователь уже авторизован, то перенаправляем его на общую страницу
    if ($_SESSION['isAuth']) {
        header("Location: /roles/non-secure-page.php");
        exit;
    }

    // Переменная для хранения сообщения пользователю
    $message = '';

    // Проверка на то, что пользователь нажал кнопку "Войти"
    if (count($_POST) > 0) {
        // Редактируем логин и пароль, убирая лишние пробелы с обеих концов строки
        $login = trim($_POST['login']);
        $pass = trim($_POST['pass']);

        // Проверка на то, что все поля заполнены, иначе выводится сообщение
        if ($login == '' || $pass == '') {
            $message = 'Заполните все поля!';
        } else {
            // Хэшируем пароль для сравнения с паролем в БД
            $pass = hash('sha256', $pass);

            // Получаем user_id пользователя с базы данных
            $userId = getUserId($login, $pass);

	        // Если переменная $userId пуста значит такого пользователя нет и выводим сообщение
            if (empty($userId)) {
                $message = 'Неправильный логин или пароль!';
            } else {
                // В случае успешного входа записываем в сессию
                // isAuth = true и его user_id
                $_SESSION['isAuth'] = true;
                $_SESSION['user_id'] = $userId;

                // Перенаправляем к общей странице
                header("Location: /roles/non-secure-page.php");
                exit;
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <form action="login.php" method="post">
        <p>Логин</p>
        <input type="text" name="login">
        <p>Пароль</p>
        <input type="password" name="pass"><br><br>
        <input type="submit" value="Войти">
    </form>
    <p><?=$message ?></p>
    <div>
        <?php showRoles(); ?>
    </div>
</body>
</html>
