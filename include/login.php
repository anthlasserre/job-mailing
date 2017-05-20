<?php
   session_start();
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form
      $myusername = $_POST['user'];
      $mypassword = $_POST['pass'];
      $link = mysqli_connect("localhost", "root", "root");
      mysqli_select_db($link, "findajobeasy");
      $mysqli = new mysqli("localhost", "root", "root", "findajobeasy");
      $result = $mysqli->query("SELECT id FROM users WHERE user = '$myusername' and pass = '$mypassword'");
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
  <title>Home | Find A Job EASY</title>
  <link rel="stylesheet" type="text/css" href="../bootstrap.css">
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
      <a class="navbar-brand" href="../index.php">Find A Job EASY</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="../enterprises.php">Entreprise List</a></li>
        <li><a href="../documents.php">Documents</a></li>
        <li><a href="../actions.php">Actions</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="../contact.php">Contact</a></li>

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

                   <div class="form-group">
                  <label class="control-label" for="inputSmall">Utilisateur  : </label>
                  <input type="text" name="user" class="form-control input-sm" id="inputSmall" placeholder="utilisateur.."/><br /><br />
                  <label class="control-label" for="inputPassword">Mot de passe  : </label>
                  <input type = "password" name="pass" class="form-control" id="inputPassword" placeholder="mot de passe.."/><br/><br />
                  <input type = "submit" class="btn btn-primary" value = "Se connecter"/><br />
               </form>
             </div>
           </div>

      </div>
    </div>

  </body>
  </html>
