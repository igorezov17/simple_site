<?php
session_start();
require_once 'Func/func.php';
require_once 'db/db.php';

$comment = htmlentities(trim($_POST['text']));

if (!empty($_POST['name']) && !empty($comment))
{
    $stmt = $pdo->prepare('INSERT INTO comments(name, text) VALUES (:name, :text)');
    $params = [':name' =>  trim($_POST['name']), ':text' => $comment];

    //$stmt->execute($params);
    if ($stmt->execute($params))
    {
        $_SESSION['flash_ok'] = "Комментарий успешно добавлен";
    } else {
        $_SESSION['flash_error'] = "Упс, что-то пошло не так";
    }
    
    //echo "Данные успешно отправлены в базу <br>";
    header('Location:index.php');
} else {
    $_SESSION['empty_form'] = "Чтобы оставлять комментарии, необходимо авторизоваться ";;
    header('Location: index.php');
}


?>
<a href="index.php"> Вернуться на главную страницу</a>