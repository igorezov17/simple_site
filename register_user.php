<?php
session_start();
require_once 'db/db.php';
require_once 'Func/func.php';

$name = htmlentities(trim($_POST['name']));
$email = htmlentities(trim($_POST['email']));
$password = htmlentities(trim($_POST['password']));
$password_confirmation = htmlentities(trim($_POST['password_confirmation']));

$pwd = password_hash($password, PASSWORD_DEFAULT);

if (!empty($name) && !empty($email) && (strlen($name)<26))
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        //Проверка на уникальность email
        $sql = 'SELECT EXISTS(SELECT email FROM users WHERE email = :email)';
        $stmt_chack = $pdo->prepare($sql);
        $stmt_chack->execute([':email' => $email]);
        if (!$stmt_chack->fetchColumn())
        {
            if ($password == $password_confirmation && (strlen($password)>=6) && (strlen($password)<30))
            {
                $sql = 'INSERT INTO users(name, email, password) VALUES (:name, :email, :password)';
                $stmt = $pdo->prepare($sql);
                $params = [':name' => $name, ':email' => $email, ':password' => $pwd];
                if ($row = $stmt->execute($params))
                {
                    $_SESSION['reg_good'] = "Вы успешно зарегистрировали";
                    header('Location:register.php');
                } else {
                    $_SESSION['reg_error'] = "Упс, что-то пошло не так";
                    header('Location:register.php');
                }
            } else {
                $_SESSION['reg_conflict_email'] = "Введите одинаковые пароли";
                header('Location:register.php');
            }
        } else {
            $_SESSION['identical'] = "Данный email уже существует, попробуйте еще раз";
            header('Location:register.php');
        } 
    } else {
        $_SESSION['error_email'] = "Вы ввели некоректный email";
        header('Location:register.php');
    }
} else {
    $_SESSION['reg_form_empty'] = "Заполните все поля";
    header('Location:register.php');
}