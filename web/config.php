<?php

// Чтоб PSR не ругался, переделал но закоментил первоначальное

// Задаем константы:
define('DS', DIRECTORY_SEPARATOR); // разделитель для путей к файлам
//$sitePath = realpath(dirname(__FILE__) . DS) . DS;
//$sitePath = str_replace('web', 'src', $sitePath);
//define('SITE_PATH', $sitePath); // путь к корневой папке сайта
//$siteTemp = str_replace('/src/', '', $sitePath);
//define('SITE_TEMP', $siteTemp);
define('SITE_PATH', str_replace('web', 'src', realpath(dirname(__FILE__) . DS) . DS)); // путь к корневой папке сайта
define('SITE_TEMP', str_replace('/src/', '', str_replace('web', 'src', realpath(dirname(__FILE__) . DS) . DS)));



// для подключения к бд
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_HOST', 'mysql:3306');
define('DB_NAME', 'php-first-mySQL');
