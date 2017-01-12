<?php
session_start();
$dsn = 'mysql:dbname=projet_php;host=localhost';
$user = 'root';
$password = '';
try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}

if(!empty($_GET['deconnexion']) && $_GET['deconnexion'] === 'true') {
    session_destroy();
    header('Location: connexion.php');
}

if (empty($_SESSION)) {
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Page Membre</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="css/connexion.css">
</head>
<body>

<div class="head">
       <div class="titre">NAME</div>
       <div class="membre">
           <a href="accueil_membre.php">Accueil</a>
           <a href="#">Mon Compte</a>
           <a href="membre.php?deconnexion=true">Se Déconnecter</a>
       </div>
   </div>

   <div class="galerie">
       <?php
       $image = $dbh->prepare('SELECT name, description, image FROM image');
       $image->execute();
       $image->fetchAll();
       ?>
   </div>

<div>
    <h1>    PAGE EN TRAVAUX
    </h1>
</div>




    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>