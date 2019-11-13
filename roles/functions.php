<?php
    // Функция для проверки наличия сессии
    function sessionCheck() {
        if (session_status() == 2) {
            return true;
        }
        return false;
    }

    // Функция для получения user_id с БД
    function getUserId($login, $pass) {
        $query = 'SELECT user_id FROM users WHERE login=:login AND pass=:pass';
        $params = ['login' => $login, 'pass' => $pass];

        $id = dbGetData($query, $params);
        return $id[0];
    }

    // Функция для получения списка ролей пользователя
    function getRoles($userId) {
        $query = 'SELECT role_name FROM roles, users, user_roles
                  WHERE user_roles.role_id = roles.role_id AND user_roles.user_id = users.user_id AND users.user_id=:userId';
        $params = ['userId' => $userId];

        return dbGetData($query, $params);
    }

    // Функция для взаимодействия с БД
    function dbGetData($query, $params) {
        $db = new PDO('mysql:host=localhost;dbname=sandbox;charset=utf8', 'adilet', '12345');
        $statement = $db->prepare($query);
        $queryArray = $params;
        $statement->execute($queryArray);
        return $statement->fetchAll(PDO::FETCH_COLUMN);
    }