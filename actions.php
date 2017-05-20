<!DOCTYPE HTML>
<html>
<head>
  <title>Home | Find A Job EASY</title>
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
        <li><a href="./documents.php">Documents</a></li>
        <li class="active"><a href="./actions.php">Actions <span class="sr-only">(current)</span></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="./contact.php">Contact</a></li>

      </ul>
    </div>
  </div>
</nav>

<form action="" method="post">
  <input type="radio" name="convertir" value="0" checked="checked">Choisir une action</input>
  <input type="radio" name="convertir" value="1">Name to GPS</input>
  <input type="submit" class="btn btn-primary"></input>
</form>

<form action="" method="post">
  <input type="radio" name="convertir2" value="0" checked="checked">Choisir une action</input>
  <input type="radio" name="convertir2" value="1">GPS to Address</input>
  <input type="submit" class="btn btn-primary"></input>
</form>

<?php
if ($_POST['convertir']) {
header('Content-Type: text/html; charset=utf-8');

// Adresse du fichier
$file_path = './importGeo.csv';
$file_path_dest = './exportGeo.csv';

// Ouverture du fichier
$file = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Lecture du fichier
foreach ($file as $line => $content)
{
    // Récupération de l'URL au bon format
    $url_gmap    = 'http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($content) . '&sensor=false';
    echo $url_gmap . '<br>';
    // Ouverture de l'URL au format JSON (sous forme d'un tableau de type Array)
    $json        = json_decode(file_get_contents($url_gmap), true);
    // Récupération des coordonnées dans le fichier JSON
    $coord       = $json['results']['0']['geometry']['location'];
    // Ajout des coordonnées (lattitude et longitude) dans notre nouvelle ligne
    $file[$line] = $content . ',' . $coord['lat'] . ',' . $coord['lng'];
}

// Retour à la ligne pour chaque ligne
$file = implode("\n", $file);
// Insertion des données
file_put_contents($file_path_dest, $file);
}

if ($_POST['convertir2']) {
header('Content-Type: text/html; charset=utf-8');

// Adresse du fichier
$file_path = './importGeo2.csv';
$file_path_dest = './exportGeo2.csv';

// Ouverture du fichier
$file = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Lecture du fichier
foreach ($file as $line => $content)
{
    // Récupération de l'URL au bon format
    $url_gmap    = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' . $content . '&sensor=false';
    echo $url_gmap . '<br>';
    // Ouverture de l'URL au format JSON (sous forme d'un tableau de type Array)
    $json        = json_decode(file_get_contents($url_gmap), true);
    echo $json. '<br>';
    // Récupération des coordonnées dans le fichier JSON
    $coord       = $json['results']['0']['geometry']['location'];
    echo $coord. '<br>';
    // Ajout des coordonnées (lattitude et longitude) dans notre nouvelle ligne
    $file[$line] = $content . ',' . $coord['formatted_address'];
}

// Retour à la ligne pour chaque ligne
$file = implode("\n", $file);
// Insertion des données
file_put_contents($file_path_dest, $file);
}
?>
</body>
</html>
