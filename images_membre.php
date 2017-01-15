<?php
$dsn = 'mysql:dbname=projet_php;host=localhost';
$user = 'root';
$password = '';
try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}
$id = $_SESSION['id'];
$req = $dbh->prepare("SELECT * FROM images WHERE id_membre='$id'");
$req->execute();
$res = $req->fetchAll();

foreach ($res as $image) {
    echo '<img height="100" src=" ' . $image['image'] . ' ">';
}
