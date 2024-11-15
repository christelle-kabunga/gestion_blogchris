<?php
include ('../../connexion/bd.php');

// Appel de lq fonction
require_once ('../../fonctions/fonctions.php');

if (isset($_POST['valider']) && !empty($_GET['idreal'])) {
  $id = $_GET['idreal'];
  $titre=htmlspecialchars($_POST['titre']) ;
  $description=htmlspecialchars($_POST['description']);
  $lien=htmlspecialchars($_POST['lien']);

  // recuperer l'image
  $image = $_FILES['photo']['name'];
  $file = $_FILES['photo'];
  $destination = "../../assets/img/realisations/" . basename($image);
  // fonction permettant de recuperer la photo
  $newimage = RecuperPhoto($image, $file, $destination);
  // verification si la variable newimage a un element
  if ($newimage != 0) {
    #verifier si l'realisations existe ou pas dans la bd
    $getrealisations = $pdo->prepare("SELECT * FROM `realisations` WHERE `description`=?");
    $getrealisations->execute([$description]);
    $tab = $getrealisations->fetch();
    // verification si la variable tab est superieur à zéro
    if ($tab > 0) {
      $_SESSION['msg'] = 'Cette realisation existe dejà dans la base de données';//Cette variable recoit le message pour notifier l'realisations de l'opération qu'il deja fait
      $_SESSION['recuptitre'] = $titre;
      $_SESSION['recupdescription'] = $description;
      $_SESSION['recuplien'] = $lien;
      header("location:../../views/realisations.php");
    }else{
      $req = $pdo->prepare("UPDATE `realisations` SET  nomreal=?,`description`=?,photo=?,lien=? WHERE id='$id'");
      $resultat = $req->execute([$titre, $description, $image, $lien]);
      if ($resultat == true) {
        $msg = "Modification réussie";
        $_SESSION['msg'] = $msg;
        header("location:../../views/realisations.php");
    }

  }
 
} else {
  header("location:../../views/realisations.php");
  }
}
