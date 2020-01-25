<?php
    require_once "db/db.php";
    require_once "Func/func.php";
    //require_once "change_user.php";
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
        <?php require_once 'parts/header_guest.php'; ?>

        <main class="py-4">
          <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header"><h3>Профиль пользователя</h3></div>

                        <div class="card-body">

                        <?php if (isset($_SESSION['okchangprof'])) {?>
                          <div class="alert alert-success" role="alert">
                            <?php echo $_SESSION['okchangprof']; ?>
                          </div>
                            <?php unset($_SESSION['okchangprof']); } 
                          else if (isset($_SESSION['error_chang_prof'])) {?>
                          <div class="alert alert-success" role="alert">
                            <?php echo $_SESSION['error_chang_prof']; ?>
                          </div>
                            <?php unset($_SESSION['error_chang_prof']);} 
                            else if (isset($_SESSION['notchanprof'])) {?>
                            <div class="alert alert-success" role="alert">
                            <?php echo $_SESSION['notchanprof']; ?>
                          </div>
                          <?php unset($_SESSION['notchanprof']); }
                          else if (isset($_SESSION['emptyfrom'])) {?>
                            <div class="alert alert-success" role="alert">
                            <?php echo $_SESSION['emptyfrom']; ?>
                          </div>
                          <?php unset($_SESSION['emptyfrom']); }?>

                          <!--<div class="alert alert-success" role="alert">
                             Профиль успешно обновлен 
                          </div>-->
                            <div class="card-body"> 
                                    <?php if (isset($_SESSION['addimage'])) {?>
                                <div class="alert alert-success" role="alert">
                                    <?php echo $_SESSION['addimage']; ?>
                                </div>
                                <?php unset($_SESSION['addimage']); }
                                else if (isset($_SESSION['not_image'])) { ?>
                                    <div class="alert alert-success" role="alert">
                                    <?php echo $_SESSION['not_image']; ?>
                                </div>
                                <?php unset ($_SESSION['not_image']); } 
                                else if (isset($_SESSION['updimg'])) { ?>
                                    <div class="alert alert-success" role="alert">
                                    <?php echo $_SESSION['updimg']; ?>
                                </div>
                                <?php unset ($_SESSION['updimg']); }
                                else if (isset($_SESSION['notupdateimg'])) { ?>
                                    <div class="alert alert-success" role="alert">
                                    <?php echo $_SESSION['notupdateimg']; ?>
                                </div>
                                <?php unset ($_SESSION['notupdateimg']); } ?>

                            <form action="change_user.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Name</label>
                                            <input type="text" class="form-control" name="name" id="exampleFormControlInput1" value="<?php echo $_SESSION['name'] ?>" >
                                           
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Email</label>
                                            <input type="email" class="form-control is-invalid" name="email" id="exampleFormControlInput1" value="<?php echo $_SESSION['email'] ?>">
                                            <!--<span class="text text-danger">
                                                Ошибка валидации
                                            </span>-->
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Аватар</label>
                                            <input type="file" class="form-control" name="image" id="exampleFormControlInput1">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                    
                                        <?php if (empty($_SESSION['image']))
                                        {
                                            echo '<img src="img/no-user.jpg" alt="" class="img-fluid">';
                                        } else
                                        {
                                            echo '<img src="'. 'img/' . $_SESSION['image']. '" alt="" class="img-fluid">';
                                        }?>
                                        <!--<img src="img/no-user.jpg" alt="" class="img-fluid">-->
                                    </div>

                                    <div class="col-md-12">
                                        <button class="btn btn-warning">Редактировать</button>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12" style="margin-top: 20px;">
                    <div class="card">
                        <div class="card-header"><h3>Безопасность</h3></div>

                        <div class="card-body">
                            <div class="alert alert-success" role="alert">
                                Пароль успешно обновлен
                            </div>

                            <form action="/profile/password" method="post">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Current password</label>
                                            <input type="password" name="current" class="form-control" id="exampleFormControlInput1">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">New password</label>
                                            <input type="password" name="password" class="form-control" id="exampleFormControlInput1">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Password confirmation</label>
                                            <input type="password" name="password_confirmation" class="form-control" id="exampleFormControlInput1">
                                        </div>

                                        <button class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </main>
    </div>
</body>
</html>
