<?php
session_start();

require_once 'db.php';
require_once 'func.php';

$name = htmlentities(trim($_POST['user']));
$email = htmlentities(trim($_POST['email']));
$password = htmlentities(trim($_POST['password']));

debug($name);
debug($email);
debug($password);
//$example = filter_var()
$t = filter_var($email, FILTER_VALIDATE_EMAIL);
if (filter_var($email, FILTER_VALIDATE_EMAIL))
{
    echo "Все ок = " . $t;
} else {
    echo " Валидация не прошла";
}
?>