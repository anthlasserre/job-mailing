<?php
include('./include/session.php');
?>
<!DOCTYPE HTML>
<html>
<head>
  <title>Enterprises List | jobMailing</title>
  <link rel="stylesheet" type="text/css" href="./bootstrap.css">
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
        <li class="active"><a href="./enterprises.php">Entreprise List <span class="sr-only">(current)</span></a></li>
        <li><a href="./documents.php">Documents</a></li>
        <li><a href="./actions.php">Actions</a></li>
      </ul>
      <!-- <ul class="nav navbar-nav navbar-right">
        <li><a href="./contact.php">Contact</a></li>
      </ul> -->
      <ul class="nav navbar-nav navbar-right">
      <li>
      <p class="connect" style="color:white;margin-top:8px;margin-bottom:-5px;"><?php
      include('./include/userConnect.php');
      if ($_SESSION['login_user'] != "www-data") {
        echo 'Yo ' . $_SESSION['login_user'] . ' !' .'  <i class="fa fa-user-circle-o"></i>'  . '<br>';
        ?><p class="connect"><a href="./include/logout.php">Se déconnecter</a></p>
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

<?php
  include ('./config/connect.inc.php');
  include ('./include/session.php');

  // on crée la requête SQL
  // $reponse = $db->query('SELECT * FROM enterprises');

  $sql = 'SELECT * FROM enterprises';

  // on lance la requête (mysqli_query)
  $response = $db->query('SELECT * FROM enterprises');

  ?>
  <table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>id</th>
      <th>Entreprise</th>
      <th>Email</th>
      <th>Adresse</th>
      <th>Contact</th>
    </tr>
  </thead>
  <tbody>
  <?php
  // on fait une boucle qui va faire un tour pour chaque enregistrement
  while ($donnees = $response->fetch_assoc()) {
      // on affiche les informations de l'enregistrement en cours
      ?>
      <tr>
      <td width="10px"><?php echo $donnees['enterprise_id']; ?></td>
      <td width="300px"><?php echo $donnees['enterprise_name']; ?></td>
      <td width="300px"><?php echo $donnees['enterprise_email']; ?></td>
      <td><?php echo $donnees['enterprise_contact']; ?></td>
      <td><?php echo $donnees['enterprise_address']; ?></td>
    </tr>
    <?php
      }

?>
  </tbody>
  </table>
</body>
</html>
