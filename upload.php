<?php

ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
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

$repertory_image = 'upload/';

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
                session_start();
                $newname=0001;
                $envoi = move_uploaded_file($imagetmp, $newname );
                $dsn = 'mysql:dbname=projet_php;host=127.0.0.1';
                $user = 'root';
                $password = '';

                try {
                    $dbh = new PDO($dsn, $user, $password);
                } catch (PDOException $e) {
                    echo 'Connexion à la base échouée : ' . $e->getMessage();
                }


                $req = $dbh->prepare('INSERT INTO images VALUES (NULL, :name, :description, :image');

                $req->execute([
                    ':name' => $_POST['name'],
                    ':image' => $imagename,

                ]);
            }

        }

    }

}

?>

<form action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="imageu" id="file">
    <button type="submit">Envoyer</button>
</form>
