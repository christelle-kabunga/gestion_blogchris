<?php
  include '../../connexion/bd.php';//Se connecter à la BD
  #suppression
  if (isset($_GET['idsupcat']) && !empty($_GET['idsupcat'])) {
      $id=$_GET['idsupcat'];
    $req=$pdo->prepare("DELETE from `realisations` WHERE id=?");
    $resultat=$req->execute([$id]);
    if($resultat==true){
        $_SESSION['msg']= 'Suppression réussie';
        header('location:../../views/realisations.php');
      }
  }else{
    header('location:../../views/realisations.php');
  }
?>