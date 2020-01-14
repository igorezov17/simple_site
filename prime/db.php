<?php

$driver = 'mysql';
$host = '127.0.0.1';
$dbname = 'blog';
$dbuser = 'admin';
$pass = '123';
$charset = 'utf8';
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

$dsn = "$driver:host=$host;dbname=$dbname;charset=$charset";

$pdo = new PDO($dsn, $dbuser, $pass);