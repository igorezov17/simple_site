<?php

require_once 'db.php';
require_once 'func.php';

$sql = 'SELECT * FROM comments WHERE id>18';

$stmt = $pdo->query($sql);
$comments = [];
//$row = $stmt->fetch(PDO::FETCH_ASSOC);
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
    //echo "Name = " . $row['name'] . " Text = " . $row['text'] . "<br>"; 
    $comments[$k] = [
        'name' => $row['name'],
        'text' => $row['text'],
        'date' => $row['release']
    ];
    $k++;
}

?>

<form>
    <input type="text" name="name" placeholder="Введите имя"><br>
    <input type="text" name="text" placeholder="Введите текст"><br>
    <button type="submite" name="button" class="btn btn-success">Отправить</button>
</form>