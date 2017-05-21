<?php
   session_start();
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form
      $createusername = $_POST['user_name'];
      $createpassword = $_POST['user_pass'];
      $link = mysqli_connect("localhost", "root", "root");
      mysqli_select_db($link, "jobmailing");
      $mysqli = new mysqli("localhost", "root", "root", "jobmailing");
      $result = $mysqli->query("INSERT INTO `users` (`user_id`, `user_name`, `user_pass`, `user_cv`, `user_cover_letter_head`, `user_cover_letter_rest`, `user_enterprises`) VALUES ((SELECT COUNT(*) FROM table)+1, '$createusername', '$createpassword', '', '', '', '');");
      $num_rows = mysqli_num_rows($result);
      // If result matched $myusername and $mypassword, table row must be 1 row
      if($num_rows == 1) {
         //session_register("myusername");
         $_SESSION['login_user'] = $createusername;
         header("location: ../documents.php");
      } else {
         $error = "L'enregistrement a échoué";
      }
   }
?>


<!DOCTYPE HTML>
<html>
<head>
  <title>Signup | jobMailing</title>
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
        <li class="active"><a href="./../enterprises.php">Entreprise List <span class="sr-only">(current)</span></a></li>
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
        <div class="panel panel-default" style="">
          <div class="panel-heading">Sign Up</div>
          <div class="panel-body" style="">
               <form action="" method="POST">
                <div class="container">
                  <label><b>Username</b></label>
                  <input type="text" placeholder="Enter Username" name="user_name" required><br>

                  <label><b>Email</b></label>
                  <input type="text" placeholder="Enter your email" name="user_mail" required><br>

                  <label><b>Password</b></label>
                  <input type="password" placeholder="Enter Password" name="user_pass" required><br>

                  <label><b>Repeat Password</b></label>
                  <input type="password" placeholder="Repeat Password" name="user_pass_repeat" required><br>
                  <input type="checkbox" checked="checked"> Remember me
                  <p>By creating an account you agree to our <a href="./../terms-and-privacy.html">Terms & Privacy</a>.</p>

                  <div class="clearfix">
                    <button type="button"  class="cancelbtn">Cancel</button>
                    <button type="submit" class="signupbtn">Sign Up</button>
                  </div>
                </div>
              </form>
             </div>
           </div>

      </div>
    </div>

  </body>
  </html>
