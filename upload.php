<?php
session_start();

ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

/*$dsn = 'mysql:dbname=projet_php;host=localhost';
$user = 'root';
$password = '';
try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}*/

echo '<pre>';
var_dump($_FILES);
echo '</pre>'; // Pour afficher les erreurs

$extensions = array('png','jpeg','jpg'); //extension autorisé pour les images.
$mimes = array('image/png','image/jpeg'); //extension autorisé pour les images.


$bdd = new PDO('mysql:dbname=projet_php;charset=utf8', 'root', '');
/*
On aura besoin de se connecter à la base de donnée pour question de sécurité. Imaginons que l'utilisateur
met un code pour pouvoir pirater le site par exemple. Le but étant de modifier le nom de l'image dans la base de
donnée.
*/

// Récupération adresse IP
function adresse_ip() {
    // si internet partagé
    if (isset($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } // si proxy
    elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } // Si IP ordinaire
    elseif (isset($_SERVER['REMOTE_ADDR'])) {
        return  $_SERVER['REMOTE_ADDR'];
    }
}
$ip = adresse_ip();


$repertory_image = 'image/';

if (isset($_FILES['imageu']))  //imageu comme image upload .. c'est plus court et cela évite les erreurs sur la BDD
{


    // Vérifier le typemime du fichier qui sera uploadé
    $verifymime = finfo_open(FILEINFO_MIME_TYPE); // vérifier le mime
    $mime= finfo_file($verifymime, $_FILES['imageu']['tmp_name']); // regarder dans ce fichier le type mime

    if(!in_array($mime,$mimes)){

        echo "Ce type de fichier n'est pas autorisé";
        finfo_close($verifymime); //Une fois vérifié on arrête la lecture
    }

    else
    {
        finfo_close($verifymime); //Une fois vérifié on arrête la lecture

        $tableau = explode('.',$_FILES['imageu'] ['name']); // on fait un tableau
        $imagename=$_FILES['imageu']['name']; //Nom réel de l'image
        $extension = $tableau[1];
        $imagetmp=$_FILES['imageu'] ['tmp_name']; //Nom temporaire donné par le serveur
        $imagetype=$_FILES['imageu'] ['type']; // type de l'image
        $imagesize=$_FILES['imageu'] ['size']; // poids de l'image




        if(!in_array($extension,$extensions))
        {
            echo "Ce type de fichier n'est pas de la bonne extension";
        }

        else
        {
            //Vérifions si le fichier est supérieur à 8Mo

            $taille_maxi = 8000000; // taille maximum autorisé par le serveur.
            if($imagesize>$taille_maxi )
            {
                echo "Désolé le fichier est trop gros..";
            }
            else
            {

                $newname= "photo".uniqid();
                move_uploaded_file($imagetmp, $repertory_image .$newname);
                $dsn = 'mysql:dbname=projet_php;host=127.0.0.1';
                $user = 'root';
                $password = '';
                $image=$_FILES['imageu'] ['name'];
                try {
                    $dbh = new PDO($dsn, $user, $password);
                } catch (PDOException $e) {
                    echo 'Connexion à la base échouée : ' . $e->getMessage();
                }

                 $req = $dbh->prepare('INSERT INTO images VALUES (NULL, :name, :description, :imageu, :ip, NOW()');
                //rajout date d'ajout à changer
                $req->execute([
                    ':name' => $newname,
                    ':description' => $_POST['description'],
                    ':imageu' => $repertory_image.$newname,
                    ':ip' => $ip,
                ]);

                $test=$req-> fetchAll();
                var_dump($test);
            }

        }

    }

}

?>
<form action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="imageu" id="file">
    <input type="text" name="description" id="description">

    <button type="submit">Envoyer</button>
</form>
