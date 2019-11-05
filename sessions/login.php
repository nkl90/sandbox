<?php
    // Если пользователь уже авторизован, то перенаправляем его на защищенную страницу
    if (isset($_COOKIE['login']) && isset($_COOKIE['pass'])) {
        header("Location: /sessions/secure-page.php");
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
            // Хэшируем пароль для хранении в куках
            $pass = hash('sha256', $pass);

            // Получаем данные о пользователе с базы данных
            $data = getUser($login, $pass);

            if ($data == NULL) {
                $message = 'Неправильный логин или пароль!';
            } else {
                // В случае успешного входа инициализируем сессию
                // И добавляем user_id в сессию
                session_start();
                $_SESSION['user_id'] = $data['user_id'];

                // И добавляем в куки логин и пароль пользователя со сроком в 1 день
                setcookie('login', $login, time() + 86400, '/');
                setcookie('pass', $pass, time() + 86400, '/');

                // Перенаправляем к защищенной странице
                header("Location: /sessions/secure-page.php");
                exit;
            }
        }
    }

    // Функция для получения данных о пользователе с базы данных. Возвращает массив данных.
    // Возвращает NULL, если не находит такого пользователя
    function getUser($login, $pass) {
        $db = new PDO('mysql:host=localhost;dbname=sandbox;charset=utf8', 'adilet', '12345');
        $statement = $db->prepare('SELECT user_id, login, pass FROM users WHERE login=:login AND pass=:pass');
        $queryArray = ['login' => $login, 'pass' => $pass];
        $statement->execute($queryArray);

        while($data = $statement->fetch(PDO::FETCH_ASSOC)) {
	    return $data;
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
        <input type="text" name="pass"><br><br>
        <input type="submit" value="Войти">
    </form>
    <p><?=$message ?></p>
</body>
</html>
