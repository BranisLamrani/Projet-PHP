<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Modification Membre</title>
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="membre.css">
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

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="index.php">Accueil</a></li>
                <li><a href="membre.php">Mon compte</a></li>
                <li><a href="membre.php?deconnexion=true">Se Déconnecter</a></li>
            </ul>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->

</nav>





<div class="Modification">
    <form action="" method="post">
        <h4>Modification</h4><br>
        <div>
            <label for="Name">Name</label> <br>
            <input type="text" name="name" id="name"> <br><br>
        </div>

        <div>
            <label for="Email">Email</label> <br>
            <input type="text" name="mail" id="mail"> <br><br>
        </div>

        <div>
            <label for="Password">Password</label> <br>
            <input type="password" name="password" id="password"> <br><br>
        </div>


        <button type="submit" class="button">
            Enregistrer
        </button>
    </form>
</div>

<br>
<br>

<footer>
    <div class="copyright">
        Copyright © 2017 PhotoSup
    </div>
</footer>




</body>
</html>