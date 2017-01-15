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
    <title>
        8GAG
    </title>


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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="css/inscription.css">

    <style>
        body {
            background-image: url(./image/geometry.png);
        }
        header {
            display: flex;
            padding: 1em;
            /*padding-left: 40vw;*/
            background: white;
            text-decoration: none;
            border-bottom:dashed 2px black;
            opacity: 0.9;
            background: white;
            opacity:0.9;
            border-bottom:dotted 2px black;
            border-top:solid 2px black;
            padding-top:1em;
            height: 12vh;
            width:100%;
            z-index:3;
            text-transform:uppercase;
            letter-spacing:0.5em;
            position: fixed;
        }
        .typewrite {
            font-size: 45px;
            color: black;
            letter-spacing: 8px;
        }
        .typewrite:hover {
            text-decoration: none;
        }
        nav ul{
            list-style-type:none;
            display:block;
        }
        nav li{
            display:inline-block;
            text-align:left;
            padding:10px;
            border-right:black 1px solid;
        }
        .navbar{
            width:100%;
            position:fixed;
            margin-top: 12vh;
            padding:10px;
            font-size:13px;
            border-bottom:solid 2px black;
            text-align:center;
            background: white;
            opacity: 0.9;
            z-index: 2;
        }
        a {
            text-decoration: none;
            color: dimgrey;
        }
        a:hover {
            text-decoration: none;
            color: black;
            font-style: italic;
        }
        .copyright {
            display: flex;
            margin-top: 30vh;
            text-align: center;
            font-style: italic;
            color: black;
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


    <nav class="navbar">
        <ul>
            <li><a href="#">Accueil</a></li>
                    <li><a href="inscription.php">S'inscrire</a></li>
                    <li><a href="connexion.php">Se connecter</a></li>
                
                    

    </nav>
   <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
    <div>
        <p>Importez vos images !</p>
        <?php include 'upload.php'?>
    </div>
     
     <div class="galerie">
         <?php
         require 'images.php';
         ?>
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