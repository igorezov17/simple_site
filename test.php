<?php
require_once 'db/db.php';
require_once 'Func/func.php';
require_once 'test_db.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <!--<form method="GET" action="">
        <input type="text" name="text" placeholder="Введите текст"><br>
        <input type="submit" name="кнопка">
    </form>-->
</body>
</html>
<?php


$driver = 'mysql';
$host = '127.0.0.1';
$dbname = 'blog';
$dbuser = 'admin';
$pass = '123';
$charset = 'utf8';
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

/*$dsn = "$driver:host=$host;dbname=$dbname;charset=$charset";

$pdo = new PDO($dsn, $dbuser, $pass, $options);*/

try {
    $dsn = "$driver:host=$host;dbname=$dbname;charset=$charset";

    $pdo = new PDO($dsn, $dbuser, $pass, $options);
    
    $stmt = $pdo->prepare(SQL_UPDATE_nomencl);
    /*$text = htmlentities(trim($_GET['text']));;
    debug($text);
    $stmt->bindParam(':text', $text);*/
    $name = "Книга";
    $id = 1;
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':id', $id);
   /*$res = $stmt->execute();
    if ($res)
    {
        echo "Все ок, результат = " . $res . "<br>";
    } else {
        echo "Что-то пошло не так";
    }*/


} catch (PDOException $e) {
    exit ($e->getMessage());
}


$email = htmlentities(trim($_POST['email']));



?>
<a href="index.php">Вернуться к авторизации</a>