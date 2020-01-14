<?php
session_start();
require_once 'db/db.php';
require_once 'Func/func.php';

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);
$password_confirmation = trim($_POST['password_confirmation']);

debug($name);
debug($email);
debug($password);

debug($_POST);

if (!empty($name) && !empty($email) && !empty($password) && ($password == $password_confirmation))
{
    $sql = 'INSERT INTO users(name, email, password) VALUES  (:name, :email, :password)';
    $params = [':name' => $name, ':email' => $email, ':password' => $password];
    $stmt = $pdo->prepare($sql);
    if ($row = $stmt->execute($params))
    {
        echo "Все ок";
    } else {
        echo "не работает";
    }
    /*if ($row = $stmt->execute($params))
    {
        $_SESSION['reg_good'] = "Вы успешно зарегистрировались";
    }
    header('Location:register.php');*/
} else {
    $_SESSION['reg_error'] = "Упс, что-то пошло не так";
    header('Location:register.php');
    echo "Заполните все поля";
}

?>