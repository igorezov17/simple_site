<?php
require_once "db/db.php";
require_once "Func/func.php";

$oldpass = $_POST['current'];
$newpass = $_POST['password'];
$copnewpass = $_POST['password_confirmation'];

if (!empty($oldpass) && !empty($newpass) && !empty($copnewpass)) 
{
    if ($newpass == $copnewpass)
    {
        $sql = 'SELECT password FROM users WHERE name = :name';
        $stmt = $pdo->prepare($sql);
        $prm_fnd = [':name' => $_SESSION['name']];
        $stmt->execute($prm_fnd);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        if (password_verify($oldpass, $res['password']))
        {
            $passhash = password_hash($newpass, PASSWORD_DEFAULT);
            $sqlin = $pdo->prepare("UPDATE users SET password = :newpass WHERE name = :sesname1");
            $paramin = [':newpass' => $passhash, ':sesname1' => $_SESSION['name']];
            if ($sqlin->execute($paramin))
            {
                $_SESSION["psupdok"] = "Пароль успешно обновлен";
                header('Location:profile.php');
            } else {
                $_SESSION['paseror'] = "Упс, что-то пошло не так";
                header('Location:profile.php');
            }
        } else {
            $_SESSION['oldpasnottrue'] = "Вы ввели неправильный пароль";
            header('Location:profile.php'); 
        }
    } else {
        $_SESSION['notcopypass'] = "Введите одинаковые пароли";
        //echo "Введите одинаковые пароли";
        header('Location:profile.php');
    }
} else {
    $_SESSION['eptyform'] = "Заполните все поля";
    //echo "Заполните все поля";
    header('Location:profile.php');
}

//$2y$10$sBOUh7yZcDt8RGcydStgQ.u.V72P3h.ub.wO0UhSS7V4B5psE66QS



/*
[current] => 1r233424
    [password] => 3
    [password_confirmation] => 4
    */
?>

<a href="profile.php">Назад</a>

