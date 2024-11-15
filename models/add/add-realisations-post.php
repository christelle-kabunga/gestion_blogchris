<?php
#inclusion de la page de connexion
include ('../../connexion/bd.php');
// Appel de lq fonction
require_once ('../../fonctions/fonctions.php');
// creation de l'evenement sur le bouton valider
if(isset($_POST['valider'])){
  $titre = htmlspecialchars($_POST['titre']) ;
  $description = htmlspecialchars($_POST['description']);
  $lien = htmlspecialchars($_POST['lien']);
  

  // recuperer l'image
  $image = $_FILES['photo']['name'];
  $file = $_FILES['photo'];
  $destination = "../../assets/img/realisations/" . basename($image);
  // fonction permettant de recuperer la photo
  $newimage = RecuperPhoto($image, $file, $destination);
  // verification si la variable newimage a un element
  if ($newimage != 0) {
    #verifier si l'realisations existe ou pas dans la bd
    $getrealisations = $pdo->prepare("SELECT * FROM `realisations` WHERE `description` = ?");
    $getrealisations->execute([$description]);
    $tab = $getrealisations->fetch();
    // verification si la variable tab est superieur à zéro
    if ($tab > 0) {
      $_SESSION['msg'] = 'Cette realisation existe dejà dans la base de données';//Cette variable recoit le message pour notifier l'realisations de l'opération qu'il deja fait
      $_SESSION['recuptitre'] = $titre;
      $_SESSION['recupdescription'] = $description;
      $_SESSION['recuplien'] = $lien;
      header("location:../../views/realisations.php");
    } else {
        $req = $pdo->prepare("INSERT INTO realisations (nomreal,`description`,photo,lien) VALUES (?,?,?,?)");
        $resultat = $req->execute([$titre,$description,$newimage,$lien]);
        if ($resultat == true) {
          $_SESSION['msg'] = "Enregistrement réussie";
          header("location:../../views/realisations.php");
        } else {
          $_SESSION['msg'] = "Echec d'enregistrement";
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