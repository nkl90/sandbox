### Задание №1. Настройка рабочего окружения

1. ~~Скачать и установить virtualbox~~
2. ~~Сконфигурировать виртуальную машину с показателями:~~
    > ОЗУ 1024 Mb, HDD 10 Gb
    
3. ~~Установить последнюю версию ubuntu server~~
4. ~~Настроить сетевые интерфесы VM, таким образом, что бы у VM был доступ в интернет~~
5. ~~Обновить библиотеки:~~
    ```bash
    user@vm $ sudo apt update
    user@vm $ sudo apt upgrade
    ```
6. ~~Установить связку LNMP (Linux, Nginx, MySql, Php).~~
7. ~~Установить Git~~
8. ~~Склонировать этот репозиторий в домашний каталог обычного пользователя VM (например в `/home/adil/projects`)~~
9. ~~С помощью команды `touch` создть файл в корне проекта с именем `phpinfo.php`, содержащей только лишь один 
вызов команды phpinfo() (смотри man pages `man touch` и `man nano` для получения информации об этих командах);~~
10. Настроить vhost web-серва nginx на эту папку, что бы в браузере хостовой системы можно было открыть 
url-адрес http://sandbox.vm/phpinfo.php и увидеть вывод функции `phpinfo()`
11. ~~Зафиксировать и отправить изменения в репозиторий на github:~~
    ```bash
    user@vm $ cd [your-project-root]
    user@vm $ git add phpinfo.php
    user@vm $ git commit -m "[your-commit-message]"
    user@vm $ git push origin master
    ```
