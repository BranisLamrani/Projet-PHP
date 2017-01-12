<?php
    if (!empty($_POST)) {
        $crypted_password = crypt('inscription_password');
        //préparation de la requete
        $requete = $dbh->prepare('INSERT INTO profil VALUES (NULL, :name, :password, :mail)');
        //exécution de la requete
        $requete->execute([
            ':name' => $_POST['name'],
            ':password' => $_POST['inscription_password'],
            ':mail' => $_POST['inscription_mail']
        ]);
    }
