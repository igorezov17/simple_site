<?php
session_start();

require_once 'db/db.php';
require_once 'Func/func.php';

if (!empty($_POST['name']) && !empty($_POST['email']) && (strlen($_POST['name'])<21) && (strlen($_POST['name'])<26))
{
    if ($_POST['password'] == $_POST['password_confirmation'])
    {
        $sql = 'INSERT INTO users(name, email, password) VALUES (:name, :email, :password)';
        $stmt = $pdo->prepare($sql);
        $params = [':name' => trim($_POST['name']), ':email' => trim($_POST['email']), 'password' => trim($_POST['password'])];
        if ($row = $stmt->execute($params))
        {
            $_SESSION['reg_good'] = "Вы успешно зарегестрировались";
            header('Location:register.php');
        } else {
            $_SESSION['reg_error'] = "Упс, что-то пошло не так";
            header('Location:register.php');
        }
    } else {
        $_SESSION['reg_conflict_pass'] = "Укажите одинаковые пароли";
        header('Location:register.php');
    }

} else {
    $_SESSION['reg_form_empty'] = "Неправиль заполнены поля";
    header('Location:register.php');
}
?>