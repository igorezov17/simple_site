<?php 

require_once 'db/db.php';
require_once 'Func/func.php';

$_SESSION['email'] = [];
$_SESSION['name'] = [];
setcookie("password", $user->password, time()-3600);
setcookie("email", $email, time()-3600);
header('Location:index.php');

