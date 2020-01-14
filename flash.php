<?php
session_start();

require_once 'func.php';
require_once 'db.php';



echo ($_SESSION['flash'] = 'Сообщение успешно добавлено');
header('Refresh:3; url=https://www.php.net/manual/ru/function.header.php');