<!DOCTYPE HTML>
<html>
<head>
  <title>Documents | Find A Job EASY</title>
  <link rel="stylesheet" type="text/css" href="bootstrap.css">
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
      <a class="navbar-brand" href="./index.php">Find A Job EASY</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="./enterprises.php">Entreprise List</a></li>
        <li class="active"><a href="./documents.php">Documents <span class="sr-only">(current)</span></a></li>
        <li><a href="./actions.php">Actions</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="./contact.php">Contact</a></li>

      </ul>
    </div>
  </div>
  </nav>
  <p class="connect"><?php
  include('./include/userConnect.php');
  if ($_SESSION['login_user'] == "root") {
    echo 'Bonjour ' . $_SESSION['login_user'] . '  <i class="fa fa-user-circle-o"></i>'  . '<br>';
    ?><p class="connect"><a href="./include/logout.php">Se déconnecter</a></p>
  <?php }
  else {
    ?><p class="connect"><a href="./include/login.php">Se connecter</a></p><?php
  }
  ?>



  <!-- CONTENU -->

  <!-- CURRICULUM VITAE -->
<div class="panel panel-default" style="position:absolute;width:48%;">
  <div class="panel-heading">Curriculum Vitae</div>
  <div class="panel-body">

  </div>
  <p style="margin-left:20px">Download</p>
  <form name="upload" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data"  style="margin-left:20px">
     <!-- On limite le fichier à 100Ko -->
     <input type="hidden" name="MAX_FILE_SIZE" value="100000">
     CV: <input type="file" name="cv">
     <input type="submit" name="envoyer" value="Envoyer le fichier">
</form>

  <?php

    if(isset($_FILES['cv']))
    {
    $dossier = './upload/';
    $fichier = basename($_FILES['cv']['name']);
    if(move_uploaded_file($_FILES['cv']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
    {
        echo 'Upload effectué avec succès !';
    }
    else //Sinon (la fonction renvoie FALSE).
    {
        echo 'Echec de l\'upload !<br>';
        echo '<pre>'; print_r($_FILES['cv']); echo '</pre>';
    }
    }
?>
    <br>
    <object data="./upload/cv.pdf" type="application/pdf" height=400px width=90% style="margin-left:20px;margin-right:-100px">
    <param name="filename" value="./upload/cv.pdf" />
    <a href="./upload/cv.pdf" title="le fichier">Téléchargez le fichier...</a>
    </object>
  </div>
  </div>


  <!-- MOTIVATION LETTER -->
<div class="panel panel-default" style="position:absolute;width:48%;right:10px">
  <div class="panel-heading">Motivation Letter</div>
  <div class="panel-body">

  </div>
  <p style="margin-left:20px">Download</p>
  <form name="upload" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data"  style="margin-left:20px">
     <!-- On limite le fichier à 100Ko -->
     <input type="hidden" name="MAX_FILE_SIZE" value="100000">
     Head: <input type="file" name="motivation_letter_head">
     <p>Ne pas mettre d'entreprise dans votre Head.</p>
     Content+Footer: <input type="file" name="motivation_letter_rest">
     <input type="submit" name="envoyer" value="Envoyer le fichier">
</form>

  <?php


  ?>
    <br>

  </div>
  </div>



</body>
</html>
