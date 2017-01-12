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

if (!empty($_POST)) {
    //$crypted_password = crypt('connexion_password', 'branisnaomipratheepa');
    $login = $dbh->prepare('SELECT * FROM profil WHERE mail = :mail AND password = :password');
    $login->execute([
        ':mail' => $_POST['connexion_mail'],
        ':password' => $_POST['connexion_password']
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

?>

<div class="connexion">
    <form action="" method="post">
        <input type="text" name="connexion_mail" id="connexion_mail" placeholder="Identifiant">
        <input type="password" name="connexion_password" id="connexion_password" placeholder="Mot de passe">
        <button type="submit">Connexion</button>
    </form>
</div>
