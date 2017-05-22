<?php
//include('../include/config.php');
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST") {
   // username and password sent from form
   $myusername = $_POST['user_name'];
   $mypassword = $_POST['user_pass'];
   $link = mysqli_connect("localhost", "root", "root");
   mysql_select_db("jobmailing", $link);
   $result = mysql_query("SELECT user_id FROM users WHERE user_name = '$myusername' and user_pass = '$mypassword'", $link);
   $num_rows = mysql_num_rows($result);
   // If result matched $myusername and $mypassword, table row must be 1 row
   if($num_rows == 1) {
      //session_register("myusername");
      $_SESSION['login_user'] = $myusername;
      header("location: ../index.php");
   } else {
      $error = "Votre identifiant ou mot de passe est invalide";
   }
}
?>
