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
    $crypt_password = crypt($_POST['connexion_password'], 'branisnaomipratheepa');
    $login = $dbh->prepare('SELECT * FROM profil WHERE mail = :mail AND password = :password');
    $login->execute([
        ':mail' => $_POST['connexion_mail'],
        ':password' => $crypt_password]);
    $users = $login->fetchAll();

    if (count($users) > 0) {
        $_SESSION['connected'] = true;
        $_SESSION['id'] = $users[0]['id_membre']; //enregistrement de l'id membre en session
        header('Location: membre.php');
    } else {
        echo 'Connexion impossible. Veuillez réessayer.'; //la ligne s'affiche même lors de l'inscription
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="css/connexion.css">
</head>
<body>
<div class="connexion">
    <form action="" method="post">
        <h4>Connexion</h4><br>
        <div>
            <label for="connexion_mail">Email</label> <br>
            <input type="text" name="connexion_mail" id="connexion_mail"> <br><br>
        </div>

        <div>
            <label for="connexion_password">Password</label> <br>
            <input type="password" name="connexion_password" id="connexion_password"> <br><br>
        </div>


        <button type="submit" class="button">
            Se connecter
        </button>
    </form>
</div>
</body>
</html>
