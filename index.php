<?php
    require_once 'db/db.php';
    require_once 'Func/func.php';
    require_once 'read.php';


?>
<!DOCTYPE html>

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
    
<?php 
if (empty($_SESSION['email']) && !empty($_COOKIE['email']) && !empty($_COOKIE['password']))
{
    $email = $_COOKIE['email'];
    $password = $_COOKIE['password'];
    $sql = 'SELECT id, email, password FROM users WHERE email = ?';
    $srmt = $pdo->prepare($sql);
    $srmt->execute([$email]);
    $user = $srmt->fetch(PDO::FETCH_ASSOC);
        if ($user)
        {
            $_SESSION['email'] = $user['email'];
                if (!empty($_SESSION['email']) && $password == $user['password']) 
                {
                    require_once 'parts/header_in.php';
                } else {
                    require_once 'parts/header_guest.php';
                }
        } else {
            echo " ";
        }
} else if(!empty($_SESSION['name'])) 
    {
        require_once 'parts/header_in.php';
    }
    else
    {
        require_once 'parts/header_guest.php';
    }
 ?>

        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header"><h3>Комментарии</h3></div>

                            <div class="card-body">
                                <?php 

                                if ($_SESSION['flash_ok']) { ?>
                              <div class="alert alert-success" role="alert">
                            
                                <?php echo $_SESSION['flash_ok']; ?>
                               
                              </div>
                                    <?php
                                    unset ($_SESSION['flash_ok']);              
                                } else if ($_SESSION['flash_error']) { ?>
                                <div class="alert alert-success" role="alert">
                            
                                <?php echo $_SESSION['flash_error']; ?>
                           
                                </div>
                                <?php unset ($_SESSION['flash_error']);}
                                else if ($_SESSION['empty_form']) {?>

                                <div class="alert alert-success" role="alert">
                            
                                <?php echo $_SESSION['empty_form']; ?>
                           
                                </div>
                                <?php unset ($_SESSION['empty_form']);} 

                                else if ($_SESSION['login_ok']) {?>

                            <div class="alert alert-success" role="alert">

                            <?php echo $_SESSION['login_ok']; ?>

                            </div>
                            <?php unset($_SESSION['login_ok']); } 
                            else if (isset($_SESSION['authok'])) { ?>
                            <div class="alert alert-success" role="alert">
                            <?php echo $_SESSION['authok']; ?>
                            </div>
                            <?php unset($_SESSION['authok']); } ?>
                                
                                <!--<div class="media">
                                  <img src="img/no-user.jpg" class="mr-3" alt="..." width="64" height="64">
                                  <div class="media-body">
                                    <h5 class="mt-0">John Doe</h5> 
                                    <span><small>12/10/2025</small></span>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe aspernatur, ullam doloremque deleniti, sequi obcaecati.
                                    </p>
                                  </div>
                                </div>-->

                               <?php 
                               foreach ($comments as $com):
                               if ($com['com_ban'] == 0) {
                               ?>
                               <div class="media">
                               
                                  <!--<img src="img/no-user.jpg" class="mr-3" alt="..." width="64" height="64">-->
                                  <?php if (empty($com['img'])) 
                                  {
                                      echo '<img src="img/no-user.jpg" class="mr-3" alt="..." width="64" height="64">';
                                  } else {
                                    echo '<img src="'. 'img/' . $com['img']. '" class="mr-3" alt="..." width="64" height="64">';
                                  } ?>
                                  
                                  <div class="media-body">
                                    <h5 class="mt-0"><?php echo $com['name']; ?></h5> 
                                    <span><small><?php echo date("d.m.y",strtotime($com['time'])); ?></small></span>
                                    <p>
                                        <?php echo $com['text']; ?>
                                    </p>
                                  </div>
                                </div>

                               <?php } endforeach; ?>
                                </div>
                                </div>
                                <div class="col-md-12" style="margin-top: 20px;">
                                <?php 
                                    require_once 'parts/footer.php'; ?>

                    </div>
                </div>
            </div>
        </main>
    </div>
</body>