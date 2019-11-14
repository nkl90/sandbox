<?php
    include_once 'functions.php';

    // Проверка на наличие сессии
    if (session_status() == 1) {
        session_start();
    }
    
    $content = 'Любая динамическая незащищенная информация, доступная всем!'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Non-secure page</title>
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