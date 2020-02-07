<?php
require_once "Func/func.php";
require_once "db/db.php";
require_once "read.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Comments</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="css/app.css" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    Project
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                            <li class="nav-item">
                                <a class="nav-link" href="login.php">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="Profile.php">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="register.php">Register</a>
                            </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header"><h3>Админ панель</h3></div>

                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Аватар</th>
                                            <th>Имя</th>
                                            <th>Дата</th>
                                            <th>Комментарий</th>
                                            <th>Действия</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    <?php foreach ($comments as $com)
                                            { ?>
                                        <tr>
                                            <td>
                                                <?php if (empty($com['img']))
                                                {
                                                    echo '<img src="img/no-user.jpg" alt="" class="img-fluid" width="64" height="64">';
                                                } else {
                                                    echo '<img src="'. 'img/' . $com['img']. '" alt="" class="img-fluid" width="64" height="64">';
                                                }?>
                                                <!--<img src="img/no-user.jpg" alt="" class="img-fluid" width="64" height="64">-->
                                            </td>
                                            <td><?php echo $com['name']; ?></td>
                                            <td><?php echo date("d.m.y",strtotime($com['release'])); ?></td>
                                            <td> <?php echo $com['text']; ?></td>
                                            <td>
                                                    <?php if ($com['com_ban'] == 1) {?>
                                                    <form action="admin_headler.php" method="GET">
                                                        <button type="submite" name="show" value="<?php echo $com['id'] ?>" class="btn btn-success">Разрешить</></button>
                                                    </form>
                                                    <?php } else {?>
                                                    <form action="admin_headler.php" method="GET">
                                                        <button type="submite" value="<?php echo $com['id']; ?>" name="block" class="btn btn-warning">Запретить</button>
                                                    </form>
                                                    <?php } ?>
                                                    <form action="admin_headler.php" method="GET">
                                                        <button onclick="return confirm('are you sure?')" type="submite" value="<?php echo $com['id']?>" name="del" class="btn btn-danger">Удалить</button>
                                                    </form>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
