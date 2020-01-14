<?php
require_once 'db/db.php';
require_once 'Func/func.php';

$email = htmlentities(trim($_POST['email']));
$password = htmlentities(trim($_POST['password']));

if (!empty($email) && !empty($password))
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $sql1 = 'SELECT name, email, password FROM users WHERE email = :email';
        $stmt_find = $pdo->prepare($sql1);
        $stmt_find->execute([':email' => $email]);
        $user = $stmt_find->fetch(PDO::FETCH_OBJ);
        if ($user) 
        {
            if (password_verify($password, $user->password))
            $sql = 'SELECT EXISTS(SELECT email FROM users WHERE email = :email)';
            $stmt_check = $pdo->prepare($sql);
            $stmt_check->execute([':email' => $email]);
            $_SESSION['name'] = $user->name;
            if ($stmt_check->fetchColumn())
            {
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
                $_SESSION['Вы ввели некоректный пароль'];
                header('Location:auth.php');
            }
        } else {
            $_SESSION['not_user'] = 'В базе нет такого пользователя';
            header('Location:login.php');
        }
    } else {
        $_SESSION['error_auth_email'] = "Вы ввели неправильные email";
        header('Location:login.php');
    }
} else {
    $_SESSION['empty_auth_form'] = "Заполните форму полностью";
    header('Location:login.php');
}



