<?php

require_once 'db/db.php';
require_once 'Func/func.php';


//$sql = 'SELECT * FROM comments ';
$sql = 'SELECT * FROM comments WHERE id>0 ORDER BY `release` DESC';
$stmt = $pdo->query($sql);

$comments = [];
$k = 0;
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
    //echo 'Name = ' . $row['name'] . ' Text = ' . $row['text'] . '<br>';
    $comments[$k] = [
        
        "name" => $row['name'],
        'time' => $row['release'],
        "text" => $row['text']
        //"release" => $row['release']
        
    ];
    $k++;
}


