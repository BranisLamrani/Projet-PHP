<?php
    if (!empty($_POST)) {
        $crypt_password = crypt($_POST['inscription_password'], 'branisnaomipratheepa');
        //préparation de la requete
        $requete = $dbh->prepare('INSERT INTO profil VALUES (NULL, :name, :password, :mail)');
        //exécution de la requete
        $requete->execute([
            ':name' => $_POST['name'],
            ':password' => $crypt_password,
            ':mail' => $_POST['inscription_mail']
        ]);
        /*$dest = $_POST['inscription_mail'];
        $subject = 'Bienvenue sur PhotoSup';
        $message = 'Bienvenue sur PhotoSup ! <br> Tu peux dès à présent te connecter sur le site et commencer à partager tes photos avec notre communauté.
        <br> A très bientôt, <br> L\'équipe de PhotoSup';
        mail($dest, $subject, $message);
        header(('location:connexion.php'));*/
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="index.css">
</head>
<body>

<header>
    <div class="titre">
        Photosup
    </div>
</header>


<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->

        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="index.php">Accueil</a></li>
                <li><a href="connexion.php">Se connecter</a></li>
            </ul>

        </div>
    </div>

</nav>

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

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</body>
</html>
