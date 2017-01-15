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


if (!empty($_POST)) {
    $crypt_password = crypt($_POST['connexion_password'], 'branisnaomipratheepa');
    $login = $dbh->prepare('SELECT * FROM profil WHERE mail = :mail AND password = :password');
    $login->execute([
        ':mail' => htmlentities($_POST['connexion_mail']), //ajout duhtmlentities()
        ':password' => htmlentities($crypt_password) //ajout du htmlentities()
    ]);
    $users = $login->fetchAll();

    if (count($users) > 0) {
        $_SESSION['connected'] = true;
        $_SESSION['id'] = $users[0]['id_membre']; //enregistrement de l'id membre en session
        header('Location: membre.php');
    } else {
        echo 'Connexion impossible. Veuillez réessayer.'; //la ligne s'affiche même lors de l'inscription
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="css/inscription.css">
    <link rel="stylesheet" href="./css/connexion.css">
    <link href="https://fonts.googleapis.com/css?family=Concert+One" rel="stylesheet">
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

    <style>
        body {
            background-image: url(./image/geometry.png);
        }
    </style>
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
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="index.php">Accueil</a></li>
                <li><a href="inscription.php">S'inscrire</a></li>
            </ul>

        </div>
    </div>

</nav>


<div class="connexion">
    <form action="" method="post">
        <h4>Connexion</h4><br>
        <div>
            <label for="connexion_mail">Email</label> <br>
            <input type="text" name="connexion_mail" id="connexion_mail"> <br><br>
        </div>

        <div>
            <label for="connexion_password">Password</label> <br>
            <input type="password" name="connexion_password" id="connexion_password"> <br><br>
        </div>


        <button type="submit" class="button">
            Se connecter
        </button>
    </form>
</div>

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
