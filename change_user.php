<?php
require_once "Func/func.php";
require_once "db/db.php";

$temp_name = $_FILES['image']['tmp_name'];  //где хранится картинка
$nameimage = $_FILES['image']['name'];      //исходное имя

$oldname = htmlentities(trim(($_SESSION['name'])));
$oldemail = htmlentities(trim(($_SESSION['email'])));
$newname = htmlentities(trim($_POST['name']));
$newemail = htmlentities(trim($_POST['email']));

$stmt = $pdo->prepare('SELECT id, name, email FROM users WHERE name = :name AND email = :email');
$params = [':name' => $oldname, ':email' => $oldemail];
$stmt->execute($params);
$rez = $stmt->fetch(PDO::FETCH_ASSOC);

// изменение имени и email
if (!empty($_POST['name']) && !empty($_POST['email']))
{
    $copyemail = $pdo->prepare('SELECT email FROM users WHERE email = :newemail');
    $copemlprm = [':newemail' => $newemail];
    $copyemail->execute($copemlprm);
    $rescopyeml = $copyemail->fetch(PDO::FETCH_ASSOC);

    if (!isset($rescopyeml['email']))
    {
        $chanuser = $pdo->prepare('UPDATE users SET name = :newname, email = :newemail WHERE id = :id');
        $newparams = [':newname' => $newname, ':newemail' => $newemail, ':id' => $rez['id']];
        if ($newrez = $chanuser->execute($newparams))
        {
            $_SESSION['okchangprof'] = 'Поля имя и email успешно обновлены';
            header('Location:profile.php');
        } else {
            $_SESSION['notchanprof'] = 'Ошибка загрузки имени и email';
            header('Location: profile.php');
        }
    } else {
        $_SESSION['error_chang_prof'] = 'Данный email адрес уже используется';
        header('Location: profile.php');
    }
} else {
    $_SESSION['emptyfrom'] = 'Заполните все поля';
    header('Location: profile.php');
}

//загрузка картинки
if (!empty($_FILES['image']['name']))
{
    $copimg = $pdo->prepare('SELECT id, img FROM image WHERE users_id = :id');
    $copimgparam = [':id' => $rez['id']];
    $copimg->execute($copimgparam);
    $row = $copimg->fetch(PDO::FETCH_ASSOC);
    if (empty($row['img']) && empty($row['id']))
    {
        $newimg = $pdo->prepare('INSERT INTO image(img, users_id) VALUES (:nameimage, :rezid)');
        $imgparam = [':nameimage' => $nameimage, ':rezid' => $rez['id']];     
                   
        if ($newimg->execute($imgparam) )
        {
            move_uploaded_file($temp_name, "img/".$nameimage);
            $_SESSION['image'] = "$nameimage";
            $_SESSION['addimage'] = "Изображение обновлено";
            header('Location:profile.php');
        } else {
            $_SESSION['not_image'] = 'Упс, изображение не добавлено';
            header('Location:profile.php');
        }
    } else {
        $updatimg = $pdo->prepare('UPDATE image SET img = :newimg, users_id = :id WHERE users_id = :id');
        $updateparam = [':newimg' => $nameimage, ':id' => $rez['id']];
        if ($res = $updatimg->execute($updateparam))
        {
           $_SESSION['updimg'] = "Картинка успешно обновлена";
            header('Location:profile.php');
        } else {
            //картинка не обновлена
            $_SESSION['notupdateimg'] = 'Картинка не была была обновлена';
            header('Location:profile.php');
        }
    }
} else {
    //нет картинки
    header('Location:profile.php');
}
?>

<a href="profile.php">Назад</a>