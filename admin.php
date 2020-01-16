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
<?php

//$current_state = 'view';
$action = $_GET['action'];
$com_id = $_GET['com_id'];
$err = NULL;
if (!is_numeric($com_id)) {
    // err
    $err = "$com_id not int";
}

?>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                Project
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                            <?php
                            if ($err) { ?>
                                <div class="alert alert-success" role="alert">
                                    <?php echo $err; ?>
                                </div>
                            <?php }
                            ?>

                            <?php

                            if (!$err) {
                                if (isset($action)) {
                                    switch ($action) {
                                        case "delete":
                                            if (is_numeric($com_id)) {
                                                // delete

                                            } else {
                                                // err
                                            }
                                            break;
                                        case "enable":
                                            break;
                                        case "disable":
                                            break;
                                        default:
                                            // err
                                            break;
                                    }
                                }
                            }

                            ?>

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

                                <?php
                                foreach ($comments as $com): ?>

                                    <tr>
                                        <td>
                                            <img src="img/no-user.jpg" alt="" class="img-fluid" width="64" height="64">
                                        </td>
                                        <td><?php echo $com['name']; ?></td>
                                        <td><?php echo $com['release']; ?></td>
                                        <td><?php echo $com['text']; ?></td>
                                        <td>
                                            <a href="admin.php?action=enable&com_id=<?php echo $com['id']; ?>"
                                               class="btn btn-success">Разрешить</a>

                                            <a href="admin.php?action=disable&com_id=<?php echo $com['id']; ?>"
                                               class="btn btn-warning">Запретить</a>

                                            <a href="admin.php?action=delete&com_id=<?php echo $com['id']; ?>"
                                               onclick="return confirm('are you sure?')"
                                               class="btn btn-danger">Удалить</a>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>
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
