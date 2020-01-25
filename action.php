<?php
session_start();
require_once 'Func/func.php';
require_once 'db/db.php';

if (!empty($_SESSION['email']) && !empty($_POST['text']) && !empty($_SESSION['name']))
{
    $comment = htmlentities(trim($_POST['text']));
    $email = htmlentities(trim($_SESSION['email']));
    $name = htmlentities(trim($_SESSION['name']));

    $stid = $pdo->prepare('SELECT `id` FROM users WHERE email = :email');
    $param = [':email' => $email];
    $stid->execute($param);
    $rez = $stid->fetch(PDO::FETCH_ASSOC);
    $users_id = $rez['id'];

    $stmt = $pdo->prepare('INSERT INTO comments(name, text, users_id) VALUES (:name, :text, :users_id)');
    $params = [':name' =>  $name, ':text' => $comment, 'users_id' => $users_id];

    if ($stmt->execute($params))
    {
        $_SESSION['flash_ok'] = "Комментарий успешно добавлен";
    } else {
        $_SESSION['flash_error'] = "Упс, что-то пошло не так";
    }
    
    header('Location:index.php');
} else {
    $_SESSION['empty_form'] = "Чтобы оставлять комментарии, необходимо авторизоваться ";;
    header('Location: index.php');
}


?>
<a href="index.php"> Вернуться на главную страницу</a>