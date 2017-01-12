<?php

if (!empty($_POST)) {
    $login = $dbh->prepare('SELECT * FROM profil WHERE mail = :mail AND password = :password');
    $login->execute([
        ':mail' => $_POST['mail'],
        ':password' => $_POST['password']
    ]);
    $users = $login->fetchAll();

    if (count($users) > 0) {
        $_SESSION['connected'] = true;
        $_SESSION['id'] = $users[0] ['id']; //enregistrement de l'id membre en session
        header('location:membre.php');
    } else {
        echo 'Connexion impossible. Veuillez réessayer.'; //la ligne s'affiche même lors de l'inscription
    }
}
