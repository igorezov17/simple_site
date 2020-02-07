<?php

require_once "db/db.php";
require_once "Func/func.php";

if (isset($_GET['show']))
{
    $id_shw = htmlentities(trim($_GET['show']));
    $stm_shw = $pdo->prepare('UPDATE comments SET com_ban = 0 WHERE id = :id');
    $prm_shw = [':id' => $id_shw];
    $stm_shw->execute($prm_shw);
    header('Location:admin.php');
}

if (isset($_GET['block']))
{
    $id_blk = htmlentities(trim($_GET['block']));
    $stm_blk = $pdo->prepare('UPDATE comments SET com_ban = 1 WHERE id = :id');
    $prm_blk = [':id' => $id_blk];
    $stm_blk->execute($prm_blk);
    header('Location:admin.php');
}

if (isset($_GET['delete']))
{
    $id_del = htmlentities(trim($_GET['delete']));
    $sql_del = 'DELETE FROM comments WHERE id = :id';
    $stm_del = $pdo->prepare($sql_del);
    $params = ['$id' => $id_del];
    $stm_del->execute($params);
    header ('Location:admin.php');
}

?>