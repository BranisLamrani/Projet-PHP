<?php

$dsn = 'mysql:dbname=projet_php;host=localhost';
$user = 'root';
$password = '';
try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}

$req = $dbh->prepare('SELECT * FROM images ORDER BY id DESC LIMIT 5');
$req->execute();
$res = $req->fetchAll();

foreach ($res as $image) {
    echo '<img height="100" src=" ' . $image['image'] . ' ">';
}
