<?php
session_start();
//connexion à la BDD
$dsn = 'mysql:dbname=projet_php;host=localhost';
$user = 'root';
$password = '';
try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}

    if (!empty($_POST)) {
        //préparation de la requete
        $requete = $dbh->prepare('INSERT INTO profil VALUES (NULL, :name, :password, :mail)');
        //exécution de la requete
        $requete->execute([
            ':name' => $_POST['name'],
            ':password' => $_POST['password'],
            ':mail' => $_POST['mail']
        ]);
    }
