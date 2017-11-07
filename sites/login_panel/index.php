<?php

  session_start();
  
  if ((isset($_SESSION['userLogged'])) && ($_SESSION['userLogged']==true))
  {
    header('Location: ../../index.php');
    exit();
  }

?>

<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>System zarządzania KEX</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../../css/font-awesome.min.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/login_style.css">
    <script src="js/prefixfree.min.js"></script>

  </head>

  <body>
    <div class="login_panel">
      <form class="form_login" action="login.php" method="post">
        <p class="title">Panel Logowania</p>
        <input type="text" name="userLogin" placeholder="Login: " autofocus/>
        <i class="fa fa-user"></i>
        <input type="password" name="userPassword" placeholder="Hasło: " />
        <i class="fa fa-key"></i>
        <?php
          if(isset($_SESSION['userBadLogin']))  echo $_SESSION['userBadLogin'];
        ?>

        <button>
          <span class="state">Zaloguj !</span>
        </button>
      </form>
    </div>
    <script src="../../js/jquery-3.1.1.min.js"></script>
  </body>
</html>
