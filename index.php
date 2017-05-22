<!DOCTYPE HTML>
<html>
<head>
  <title>Home | jobMailing</title>
  <link rel="stylesheet" type="text/css" href="bootstrap.css">
  <link rel="icon" type="favicon/png" href="./img/jobMailing.png">
  <link rel="stylesheet" href="./css/font-awesome/css/font-awesome.min.css">
</head>
<body>

  <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="./index.php">jobMailing</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="./enterprises.php">Entreprise List</a></li>
        <li><a href="./documents.php">Documents</a></li>
        <li><a href="./actions.php">Actions</a></li>
      </ul>
      <!-- <ul class="nav navbar-nav navbar-right">
        <li><a href="./contact.php">Contact</a></li>
      </ul> -->
      <ul class="nav navbar-nav navbar-right">
      <li>
      <p class="connect" style="color:white;margin-top:8px;margin-bottom:-5px;"><?php
      include ('./include/userConnect.php');
      $mysqli = new mysqli("localhost", "root", "root", "jobmailing");
      $result = $mysqli->query("SELECT user_id FROM users WHERE user_name = '$myusername' and user_pass = '$mypassword'");
      if ($_SESSION['login_user'] == "alasserre" ) {
          echo 'Yo ' . $_SESSION['login_user'] . '  <i class="fa fa-user-circle-o"></i>'  . ' !<br>';
          ?><p class="connect"><a href="./include/logout.php">Se déconnecter</a></p>
        <?php }
        else {
          ?><p class="connect"><a href="./include/login.php">Se connecter</a></p><?php
        }
        ?>
    </p>
      </li>
      </ul>
    </div>
  </div>
</nav>


<div class="jumbotron" style="padding-left: 20px;padding-right:20px;padding-top:250px">
  <h1>jobMailing</h1>
  <p>This is a simple web interface, to allow us to send multiple applicaiton mails in a click with differents settings to each enterprise.</p>
  <p><a class="btn btn-primary btn-lg">Join us now</a></p>
</div>

</body>
</html>
