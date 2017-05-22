<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST") {
  // username and password sent from form
  $myusername = $_POST['user_name'];
  $mypassword = $_POST['user_pass'];
  $link = mysqli_connect("localhost", "root", "root");
  mysqli_select_db($link, "jobmailing");
  $mysqli = new mysqli("localhost", "root", "root", "jobmailing");
  $result = $mysqli->query("SELECT user_id FROM users WHERE user_name = '$myusername' and user_pass = '$mypassword'");
  $num_rows = mysqli_num_rows($result);
  // If result matched $myusername and $mypassword, table row must be 1 row
  if($num_rows == 1) {
     //session_register("myusername");
     $_SESSION['login_user'] = $myusername;
     header("location: ../documents.php");
  } else {
     $error = "Votre identifiant ou mot de passe est invalide";
   }
}
?>


<!DOCTYPE HTML>
<html>
<head>
  <title>Login | jobMailing</title>
  <link rel="stylesheet" type="text/css" href="./../bootstrap.css">
  <link rel="icon" type="favicon/png" href="./../img/jobMailing.png">
  <link rel="stylesheet" href="./../css/font-awesome/css/font-awesome.min.css">
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
      <a class="navbar-brand" href="./../index.php">jobMailing</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="./../enterprises.php">Entreprise List</a></li>
        <li><a href="./../documents.php">Documents</a></li>
        <li><a href="./../actions.php">Actions</a></li>
      </ul>
      <!-- <ul class="nav navbar-nav navbar-right">
        <li><a href="./../contact.php">Contact</a></li>
      </ul> -->
      <ul class="nav navbar-nav navbar-right">
      <li>
      <p class="connect" style="color:white;margin-top:8px;margin-bottom:-5px;"><?php
      include('./userConnect.php');
      if ($_SESSION['login_user'] != "www-data") {
        echo 'Yo ' . $_SESSION['login_user'] . ' !' .'  <i class="fa fa-user-circle-o"></i>'  . '<br>';
        ?><p class="connect"><a href="./logout.php">Se déconnecter</a></p>
      <?php }
      else {
        ?><p class="connect" style="margin-top:25px;margin-bottom:-25px"><a href="./login.php">Se connecter</a></p><?php
      }
      ?>
    </p>
      </li>
      </ul>
    </div>
  </div>
</nav>

      <div id="login" align = "center">
        <div class="panel panel-default" style="margin-left:300px;margin-right:300px">
          <div class="panel-heading">Connexion Admin</div>
          <div class="panel-body" style="padding-left:50px;padding-right:50px">

               <form action = "" method = "post" class="form-horizontal">
                 <fieldset>

                   <div class="form-group" style="margin-top:20px">
                  <img src="./../img/jobMailing.png" height="100px"/>
                  <input style="width:300px;margin-top:40px" type="text" name="user_name" class="form-control" id="inputSmall" placeholder="Utilisateur"/><br /><br />
                  <input style="width:300px" type = "password" name="user_pass" class="form-control" id="inputPassword" placeholder="Mot de passe"/><br/><br />
                  <input type = "submit" class="btn btn-primary" value = "Se connecter"/><br />
                  <p><a href="./signup.php">Sign Up</a></p>
               </form>
             </div>
           </div>

      </div>
    </div>

  </body>
  </html>
