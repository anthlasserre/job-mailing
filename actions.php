<?php
include('./include/session.php');
?>
<?php
// Conversion sur action du boutton Name to GPS (Insertion des coordonnées GPS de l'entreprise à partir du Nom de l'entreprise)
if ($_POST['convertir']) {
  header('Content-Type: text/html; charset=utf-8;');

  $servername = "localhost";
  $username = "root";
  $password = "root";
  $dbname = "jobmailing";

  // Create connection
  $mysqli = mysqli_connect($servername, $username, $password, $dbname);
  $reponse = $mysqli->query("SELECT * FROM enterprises");

  while ($donnees = $reponse->fetch_assoc()) {
    // Récupération de l'URL au bon format
    $url_gmap    = 'http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($donnees['enterprise_name']) . '&sensor=false';
    // Ouverture de l'URL au format JSON (sous forme d'un tableau de type Array)
    $json        = json_decode(file_get_contents($url_gmap), true);
    // Récupération des coordonnées dans le fichier JSON
    $coord       = $json['results']['0']['geometry']['location'];
    // Ajout des coordonnées (lattitude et longitude) dans notre nouvelle ligne
    $coordgps = $coord['lat'] . ';' . $coord['lng'];
    $sql = "UPDATE enterprises SET enterprise_address_gps=\"" . $coordgps . "\", enterprise_address_gps_lat=\"" . $coord['lat'] . "\", enterprise_address_gps_lon=\"" . $coord['lng'] . "\" WHERE enterprise_name=\"" . $donnees['enterprise_name'] . "\"" ;
    $reponse2 = $mysqli->query($sql);
    echo "Requête" . $sql . "<br> réalisée avec succès.<br>";
    }
}
// Conversion sur action du boutton GPS to Address (Insertion de l'adresse de l'entreprise à partir des coordonnées GPS de l'entreprise)
if ($_POST['convertir2']) {
  header('Content-Type: text/html; charset=utf-8;');

  $servername = "localhost";
  $username = "root";
  $password = "root";
  $dbname = "jobmailing";

  // Create connection
  $mysqli = mysqli_connect($servername, $username, $password, $dbname);
  $reponse = $mysqli->query("SELECT * FROM enterprises");

  while ($donnees = $reponse->fetch_assoc()) {
    // Récupération de l'URL au bon format
    $url_gmap    = 'http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($donnees['enterprise_name']) . '&sensor=false';
    // Ouverture de l'URL au format JSON (sous forme d'un tableau de type Array)
    $json        = json_decode(file_get_contents($url_gmap), true);
    // Récupération des coordonnées dans le fichier JSON
    $coord       = $json['results']['0'];
    // Ajout de l'adresse dans notre nouvelle ligne
    $coordgps = $coord['formatted_address'];
    $sql = "UPDATE enterprises SET enterprise_address=\"" . $coordgps . "\" WHERE enterprise_name=\"" . $donnees['enterprise_name'] . " BORDEAUX\"" ;
    $reponse2 = $mysqli->query($sql);
    echo "Requête" . $sql . "<br> réalisée avec succès.<br>";
    }
}
?>
<!DOCTYPE HTML>
<html>
<head>
  <title>Actions | jobMailing</title>
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
        <li><a href="./enterprises.php">Entreprise List</a></li>
        <li><a href="./documents.php">Documents</a></li>
        <li class="active"><a href="./actions.php">Actions <span class="sr-only">(current)</span></a></li>
      </ul>
      <!-- <ul class="nav navbar-nav navbar-right">
        <li><a href="./contact.php">Contact</a></li>
      </ul> -->
      <ul class="nav navbar-nav navbar-right">
      <li>
      <p class="connect" style="color:white;margin-top:8px;margin-bottom:-5px;"><?php
      include('./include/userConnect.php');
      if ($_SESSION['login_user'] == "alasserre" ) {
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

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Complete your Entreprise List</h3>
  </div>
  <div class="panel-body">

    <form action="" method="post" style="margin-bottom:20px">
      <input type="radio" name="convertir" value="1" hidden="hidden" checked="checked"></input>
      <input type="submit" class="btn btn-primary" value="Name to GPS"></input>
      <p class="text-muted">"Name to GPS" will allow you to from enterprises's names find the good GPS address.</p>
    </form>

    <form action="" method="post" style="margin-bottom:20px">
      <input type="radio" name="convertir2" value="1" hidden="hidden" checked="checked"></input>
      <input type="submit" class="btn btn-primary" value="GPS to Address"></input>
      <p class="text-muted">"GPS to Address" will allow you to from GPS find the good address.</p>
    </form>

  </div>
</div>




</body>
</html>
