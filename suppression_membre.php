<?php

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Suppression</title>
    <link rel="stylesheet" href="css/inscription.css">
    <link rel="stylesheet" href="css/connexion.css">
    <link rel="stylesheet" href="membre.css">
    <link rel="stylesheet" href="index.php">





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




<div class="suppression">
    <form action="" method="post">
        <h4>Supprimer</h4><br>
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