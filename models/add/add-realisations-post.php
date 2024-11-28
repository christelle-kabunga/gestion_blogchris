<?php
// Inclusion de la page de connexion
include('../../connexion/bd.php');
// Appel de la fonction
require_once('../../fonctions/fonctions.php');

// Création de l'événement sur le bouton "valider"
if (isset($_POST['valider'])) {
    $titre = htmlspecialchars($_POST['titre']);
    $description = htmlspecialchars($_POST['description']);
    $lien = htmlspecialchars($_POST['lien']);

    // Nettoyage et validation des données
    $titre = filter_var($titre, FILTER_SANITIZE_STRING);
    $description = filter_var($description, FILTER_SANITIZE_STRING);
    $lien = filter_var($lien, FILTER_VALIDATE_URL);

    if (!$lien) {
        $_SESSION['msg'] = "Lien invalide.";
        $_SESSION['recuptitre'] = $titre;
        $_SESSION['recupdescription'] = $description;
        $_SESSION['recuplien'] = $lien;
        header("location:../../views/realisations.php");
        exit;
    }

    // Gestion de l'image
    $image = $_FILES['photo']['name'];
    $file = $_FILES['photo'];
    $destination = "../../assets/img/realisations/" . basename($image);
    $newimage = RecuperPhoto($image, $file, $destination);

    // Vérification des résultats de la méthode RecuperPhoto
    if ($newimage == -1) {
        $_SESSION['msg'] = "Aucune image sélectionnée.";
        $_SESSION['recuptitre'] = $titre;
        $_SESSION['recupdescription'] = $description;
        $_SESSION['recuplien'] = $lien;
        header("location:../../views/realisations.php");
        exit;
    } elseif ($newimage == '0') {
        $_SESSION['msg'] = "Le format de l'image n'est pas autorisé.";
        $_SESSION['recuptitre'] = $titre;
        $_SESSION['recupdescription'] = $description;
        $_SESSION['recuplien'] = $lien;
        header("location:../../views/realisations.php");
        exit;
    } elseif ($newimage == -2) {
        $_SESSION['msg'] = "Erreur lors du téléchargement de l'image.";
        $_SESSION['recuptitre'] = $titre;
        $_SESSION['recupdescription'] = $description;
        $_SESSION['recuplien'] = $lien;
        header("location:../../views/realisations.php");
        exit;
    } else {
        // Vérification si la réalisation existe déjà dans la base de données
        $getrealisations = $pdo->prepare("SELECT * FROM `realisations` WHERE `description` = ?");
        $getrealisations->execute([$description]);
        $tab = $getrealisations->fetch();

        if ($tab > 0) {
            $_SESSION['msg'] = "Cette réalisation existe déjà dans la base de données.";
            $_SESSION['recuptitre'] = $titre;
            $_SESSION['recupdescription'] = $description;
            $_SESSION['recuplien'] = $lien;
            header("location:../../views/realisations.php");
            exit;
        } else {
            // Insertion de la nouvelle réalisation
            $req = $pdo->prepare("INSERT INTO realisations (nomreal, `description`, photo, lien) VALUES (?, ?, ?, ?)");
            $resultat = $req->execute([$titre, $description, $newimage, $lien]);
            if ($resultat) {
                $_SESSION['msg'] = "Enregistrement réussi.";
                header("location:../../views/realisations.php");
                exit;
            } else {
                $_SESSION['msg'] = "Échec de l'enregistrement.";
                $_SESSION['recuptitre'] = $titre;
                $_SESSION['recupdescription'] = $description;
                $_SESSION['recuplien'] = $lien;
                header("location:../../views/realisations.php");
                exit;
            }
        }
    }
} else {
    header("location:../../views/realisations.php");
    exit;
}
?>
