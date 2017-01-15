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
    header('Location: connexion.php'); //A changer après MAJ de Branis
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
    <link rel="stylesheet" href="./css/connexion.css">
    <link rel="stylesheet" href="./membre.css">

    <style>
        body {
            background-image: url(./image/geometry.png);
        }
        .travaux {
            margin-top: 20vh;
            margin-left: 5vw;
            background: #EDEDEE;
            display: inline-block;
            width: 90%;
            padding-bottom: 5vh;
            text-align: center;
        }


        progress {
            border-radius: 25px;
            width: 50vw;
            height: 5vh;
        }


        progress[value]::-webkit-progress-bar {
            background-color: #eee;
            border-radius: 2px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.25) inset;
        }

        progress[value]::-webkit-progress-value {
            background-image:
                    -webkit-linear-gradient(-45deg,
                    transparent 33%, rgba(0,0,0,.1) 33%,
                    rgba(0,0, 0, .1) 66%, transparent 66%),
                    -webkit-linear-gradient(top,
                    blue,
                    purple),
                    -webkit-linear-gradient(left, #09c, #f44);
            border-radius: 2px;
            background-size: 35px 20px, 100% 100%, 100% 100%;
        }

        form {
            padding: 5vh 30vw;
            background: #EDEDEE;
            width: 100%;
        }
    </style>
    <script>

        var TxtType = function(el, toRotate, period) {
            this.toRotate = toRotate;
            this.el = el;
            this.loopNum = 0;
            this.period = parseInt(period, 10) || 2000;
            this.txt = '';
            this.tick();
            this.isDeleting = false;
        };

        TxtType.prototype.tick = function() {
            var i = this.loopNum % this.toRotate.length;
            var fullTxt = this.toRotate[i];

            if (this.isDeleting) {
                this.txt = fullTxt.substring(0, this.txt.length - 1);
            } else {
                this.txt = fullTxt.substring(0, this.txt.length + 1);
            }

            this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

            var that = this;
            var delta = 200 - Math.random() * 100;

            if (this.isDeleting) { delta /= 2; }

            if (!this.isDeleting && this.txt === fullTxt) {
                delta = this.period;
                this.isDeleting = true;
            } else if (this.isDeleting && this.txt === '') {
                this.isDeleting = false;
                this.loopNum++;
                delta = 500;
            }

            setTimeout(function() {
                that.tick();
            }, delta);
        };

        window.onload = function() {
            var elements = document.getElementsByClassName('typewrite');
            for (var i=0; i<elements.length; i++) {
                var toRotate = elements[i].getAttribute('data-type');
                var period = elements[i].getAttribute('data-period');
                if (toRotate) {
                    new TxtType(elements[i], JSON.parse(toRotate), period);
                }
            }
            // INJECT CSS
            var css = document.createElement("style");
            css.type = "text/css";
            css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #000; color: black; text-decoration: none} a {text-decoration: none} ";
            document.body.appendChild(css);
        };

    </script>

</head>
<body>

<header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 titre">
                <a href="" class="typewrite" data-period="2000" data-type='[ "PHOTOSUP." ]'>
                    <span class="wrap"></span>
                </a>
            </div>
        </div>
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
                <li><a href="accueil_membre.php">Accueil</a></li>
                <li><a href="membre.php">Mon Compte</a></li>
                <li><a href="membre.php?deconnexion=true">Se Déconnecter</a></li>
            </ul>

        </div>
    </div>

</nav>
<?php
    require 'upload.php';
?>
<div class="form">
<form id="uploader" action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="imageu" id="file">
    <input type="text" name="description" id="description" placeholder="description">
    <button type="submit">Envoyer</button>
</form>
</div>
<br><br>

<div class="galerie">
    <?php
        require 'images_membre.php';
    ?>
</div>

<div class="travaux">
    <h1>    PAGE EN TRAVAUX
    </h1><br><br>
    <div>
        <progress value="50" max="100"></progress>
    </div>

</div>

<br>
<br>

<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
    <li><a href="modif_membre.php"> Modifier</a></li>
    <li><a href="suppression_membre.php">Supprimer</a></li>
</div>

<br>
<br>

<footer>
    <div class="copyright">
        Copyright © 2017 PhotoSup
    </div>
</footer>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


</body>
</html>