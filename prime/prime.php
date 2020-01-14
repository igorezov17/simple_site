<?php
session_start();
require_once 'func.php';

//require_once 'prime_read.php';

/*foreach ($comments as $com)
{
    debug($com['name']);
    debug($com['text']);
    debug(date("d.m.y" ,strtotime($com['date'])));
    echo "----------------<br>";
}*/



//date(strtotime("d.m.y" ,$row['release']))
?>

<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8">
  <title>Атрибут novalidate</title>
 </head>
 <body>
     <script src="main.js" type="text/javascript"></script>
     <h1>Изучаем JS</h1>
   <form action="test.php" method="POST">
  <p><input name="user" placeholder="Ваше имя" required aria-required="true"></p>
  <input id="email" type="email" name="email" title="В формате @ya.ru и не более 25 символов" placeholder="Ваш email" required aria-required="true">
   <p><input  id="password" type="password"  name="password"  autocomplete="new-password" placeholder="Ваш пароль" required aria-required="true"></p>
   <p><input type="submit" value="Отправить"></p>

  </form>
 </body>
</html>


