<?php
   include('../config/connect.inc.php');
   session_start();
   $user_check = $_SESSION['login_user'];
   $ses_sql = mysqli_query($db,"SELECT user_name FROM users WHERE user_name = '$user_check' ");
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   $login_session = $row['user_name'];
   if(!isset($_SESSION['login_user'])){
      header("location: ./include/login.php");
   }
