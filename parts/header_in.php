<?php
require_once '/db/db.php';
require_once '/Func/func.php';

$findadm = $pdo->prepare('SELECT is_admin AS admin FROM users WHERE name = :name');
$param = [':name' => $_SESSION['name']];
$findadm->execute($param);
$res = $findadm->fetch(PDO::FETCH_ASSOC);

?>
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
                                <a class="nav-link" href="profile.php">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php">Logout</a>
                            </li>
                            <?php
                            if ($res['admin'] == 1 )
                            {?>
                                <li class="nav-item">
                                <a class="nav-link" href="admin.php">Admin</a>
                            </li>
                            <?php }?>
                    </ul>
                </div>
            </div>
        </nav>