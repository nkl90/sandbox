<?php
    // Инициализируем сессию
    session_start();

    // Если пользователь уже авторизован, то перенаправляем его на защищенную страницу
    if (isset($_SESSION['login']) && isset($_SESSION['pass'])) {
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

	    // Если переменная $data пуста значит такого пользователя нет и выводим сообщение
            if (empty($data)) {
                $message = 'Неправильный логин или пароль!';
            } else {
                // В случае успешного входа добавляем логин и пароль в сессию
                $_SESSION['login'] = $data['login'];
                $_SESSION['pass'] = $data['pass'];

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
        var_dump($db);
        $statement = $db->prepare('SELECT login, pass FROM users WHERE login=:login AND pass=:pass');
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
