<?php
    

    
  
   

    $dsn = 'mysql:dbname=projet_php;host=127.0.0.1';
    $user = 'root';
    $password = '';
    
    try {
        $dbh = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        echo 'Connexion échouée : ' . $e->getMessage();
    }

    if (!empty($_POST)) {
        $password1 = htmlentities($_POST['password1']);
        $password2 = htmlentities($_POST['password2']);
        $crypt_password = crypt($_POST['password1'], 'branisnaomipratheepa');
        //préparation de la requete
            if($password1 == $password2)
            {
                $requete = $dbh->prepare('INSERT INTO profil VALUES (NULL, :name, :password1, :mail)');
                //exécution de la requete
                $requete->execute([
                    ':name' => $_POST['name'],
                    ':password1' => $crypt_password,
                    ':mail' => $_POST['inscription_mail']
                ]);
                /*$dest = $_POST['inscription_mail'];
                $subject = 'Bienvenue sur PhotoSup';
                $message = 'Bienvenue sur PhotoSup ! <br> Tu peux dès à présent te connecter sur le site et commencer à partager tes photos avec notre communauté.
                <br> A très bientôt, <br> L\'équipe de PhotoSup';
                mail($dest, $subject, $message);
                header(('location:connexion.php'));*/
            }
            else{
                echo "Les mots de passes ne sont pas identiques.. Faites attention à bien taper le mot de passe !";
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
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/connexion.css">
    <link rel="stylesheet" href="./css/inscription.css">
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
            </ul>

        </div>
    </div>

</nav>


<div class="inscription">
 <form method="post">
    
    
    <label>Pseudo: <input type="text" name="name" class="saisir"/></label><br/>
   

    
    <label>Mot de passe: <input type="password" name="password1"/></label><br/>
   

    
    <label>Confirmation du mot de passe: <input type="password" name="password2"/></label><br/>
    

    
    <label >Adresse e-mail: <input type="text" name="inscription_mail"/></label><br/>
    

   
    <input type="submit" value="M'inscrire" class="submitt" />
    
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
