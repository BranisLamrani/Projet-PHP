<?php

$dsn = 'mysql:dbname=projet_php;host=localhost';
$user = 'root';
$password = '';
try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}

$req = $dbh->prepare('SELECT * FROM images');
$req->execute();
$res = $req->fetchAll();

foreach ($res as $image) {

    echo '<img height="200" src="' . $image['image'] . '">';

}

