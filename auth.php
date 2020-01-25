<?php
require_once 'db/db.php';
require_once 'Func/func.php';

$email = htmlentities(trim($_POST['email']));
$password = htmlentities(trim($_POST['password']));

if (!empty($email) && !empty($password))
{
    $fincopeml = $pdo->prepare('SELECT name, email, password FROM users WHERE email = :email');
    $copemlprm = [':email' => $email];
    $fincopeml->execute($copemlprm);
    $rez = $fincopeml->fetch(PDO::FETCH_ASSOC);
    if ($rez['email'] == $email)
    {
        if ($trupass = password_verify($password, $rez['password']))
        {
            $_SESSION['name'] = $rez['name'];
            $_SESSION['email'] = $rez['email'];
            $_SESSION['authok'] = "Поздравляю вы успешно авторизовались";
            if ($_POST['remember'] == 1)
                {
                    setcookie('email', $email, time() + (86400 * 5));
                    setcookie('password', $user->password, time() + (86400 * 5));
                    header('Location:index.php');
                } else {
                    setcookie("password", $user->password, time()-3600);
                    setcookie("email", $email, time()-3600);
                    header('Location:index.php');
                }
        } else {
            $_SESSION['errpass'] = "Вы указали неверный email или пароль";
            header('Location:login.php');
            //echo "Вы указали неверный email или пароль";
        }
    } else {
        $_SESSION['not_user'] = 'Пользователя с такимb данными не существует';
        header('Location:login.php');
        //echo "Пользователя с таким паролем не существует";
    }
} else {
    $_SESSION['empty_auth_form'] = "Заполните форму полностью";
    header('Location:login.php');
}