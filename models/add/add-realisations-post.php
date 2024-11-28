<?php
// Inclusion de la page de connexion
include ('../../connexion/bd.php');
// Appel de la fonction
require_once ('../../fonctions/fonctions.php');

// Création de l'événement sur le bouton valider
if (isset($_POST['valider'])) {
    $titre = htmlspecialchars($_POST['titre']);
    $description = htmlspecialchars($_POST['description']);
    $lien = htmlspecialchars($_POST['lien']);

    // Récupérer l'image

    $name = $_FILES['photo']['name'];
    $file = $_FILES['photo'];
    $destination = '../../assets/img/realisations/';
    $extensions = ['png', 'jpeg', 'jpg', 'gif'];

    $newimage = upload_file($name, $file, $destination, $extensions);

    // Vérification si la variable newimage a un élément
    if (! empty($name)) {
        // Vérifier si la réalisation existe ou pas dans la BD
        $getrealisations = $pdo->prepare("SELECT * FROM `realisations` WHERE `description` = ?");
        $getrealisations->execute([$description]);
        $tab = $getrealisations->fetch();

        // Vérification si la variable tab est supérieure à zéro
        if ($tab > 0) {
            $_SESSION['msg'] = 'Cette réalisation existe déjà dans la base de données'; // Notification
            $_SESSION['recuptitre'] = $titre;
            $_SESSION['recupdescription'] = $description;
            $_SESSION['recuplien'] = $lien;
            header("location:../../views/realisations.php");
        } else {
            // Insertion dans la base de données
            if ($newimage === $name){
              $req = $pdo->prepare("INSERT INTO realisations (nomreal, `description`, photo, lien) VALUES (?, ?, ?, ?)");
              $resultat = $req->execute([$titre, $description, $newimage, $lien]);
              if ($resultat == true) {
                  $_SESSION['msg'] = "Enregistrement réussi";
                  header("location:../../views/realisations.php");
              } else {
                  $_SESSION['msg'] = "Échec de l'enregistrement";
                  header("location:../../views/realisations.php");
              }
            }else{
              $_SESSION['msg'] = $newimage;
              header("location:../../views/realisations.php");
            }
            
        }
    } else {
        $_SESSION['msg'] = "Le format de l'image que vous avez choisi n'est pas autorisé";
        header("location:../../views/realisations.php");
    }
} else {
    header("location:../../views/realisations.php");
}
?>