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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/index.css">
</head>
<body>
    <header>
        <div class="titre">
            Name
        </div>
        <div class="connexion">
            <?php
            require 'connexion.php';
            ?>
            <form action="" method="post">
                <input type="text" name="mail" id="mail" placeholder="Identifiant">
                <input type="password" name="password" id="password" placeholder="Mot de passe">
                <button type="submit">Connexion</button>
            </form>
        </div>
    </header>

        
        
    <?php
    require 'inscription.php';
    ?>
    <div class="inscription">
        <form action="#" method="post" enctype="multipart/form-data">
            <h2>INSCRIPTION</h2>
            <br>

            <div>
                <label for="name">Nom</label>
                <br>
                <input type="text" name="name" id="name">
            </div>

            <br>
            <div>
                <label for="inscription_mail">Email</label>
                <br>
                <input type="Email" name="inscription_mail" id="inscription_mail">
            </div>

            <br>

            <div>
                <label for="inscription_password">Mot de passe</label>
                <br>
                <input type="password" name="inscription_password" id="inscription_password">
            </div>


            <br>

            <button type="submit"> S'inscrire</button>
        </form>
    </div>

     
     
     <div class="galerie">
            <div class="photo"></div>
            <div class="photo"></div>
            <div class="photo"></div>
            <div class="photo"></div>
            <div class="photo"></div>
        
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
    </html>