<?php
    if (!empty($_POST)) {
        $crypt_password = crypt($_POST['inscription_password'], 'branisnaomipratheepa');
        //préparation de la requete
        $requete = $dbh->prepare('INSERT INTO profil VALUES (NULL, :name, :password, :mail)');
        //exécution de la requete
        $requete->execute([
            ':name' => $_POST['name'],
            ':password' => $crypt_password,
            ':mail' => $_POST['inscription_mail']
        ]);
        header(('location:connexion.php'));
    }
