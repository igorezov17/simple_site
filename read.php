<?php

require_once 'db/db.php';
require_once 'Func/func.php';

//$sql = 'SELECT * FROM comments WHERE id>0 ORDER BY `release` DESC';

$sql1 = 'SELECT users.name AS name, comments.text AS text, `release`, image.img AS image FROM users 
        INNER JOIN comments ON users.id = comments.users_id 
        LEFT JOIN image ON users.id = image.users_id 
        ORDER BY `release` DESC';
$stmt = $pdo->query($sql1);

$comments = [];
$k = 0;
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
    //echo 'Name = ' . $row['name'] . ' Text = ' . $row['text'] . '<br>';
    $comments[$k] = [
        
        "name" => $row['name'],
        'time' => $row['release'],
        "text" => $row['text'],
        'img' => $row['image']
        //"release" => $row['release']
        
    ];
    $k++;
}


