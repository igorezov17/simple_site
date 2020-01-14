<?php

require_once 'test_db.php';

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
    //$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 


} catch (PDOException $e) {
    exit ($e->getMessage());
}

session_start();

if (isset($_COOKIE['page_visit']))
{
    setcookie('page_visit', ++$_COOKIE['page_visit'], time()+5);
} else {
    setcookie('page_visit', 1, time()+5);
    $_COOKIE['page_visit'] = 1;
}