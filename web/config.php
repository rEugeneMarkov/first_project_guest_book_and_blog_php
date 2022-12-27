<?php

// Задаем константы:
define('DS', DIRECTORY_SEPARATOR); // разделитель для путей к файлам
$sitePath = realpath(dirname(__FILE__) . DS) . DS;
$sitePath = str_replace('web', 'src', $sitePath);
define('SITE_PATH', $sitePath); // путь к корневой папке сайта
$siteTemp = str_replace('/src/', '', $sitePath);
define('SITE_TEMP', $siteTemp);

// для подключения к бд
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_HOST', 'mysql:3306');
define('DB_NAME', 'php-first-mySQL');
