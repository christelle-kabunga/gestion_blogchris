<?php
include ('../../connexion/bd.php');

// Appel de lq fonction
require_once ('../../fonctions/fonctions.php');

if (isset($_POST['valider']) && !empty($_GET['iduser'])) {
  $id = $_GET['iduser'];
  $username=htmlspecialchars($_POST['username']) ;
  $password=htmlspecialchars($_POST['password']);
  $numtel=htmlspecialchars($_POST['numtel']);
  // recuperer l'image
  $image = $_FILES['photo']['name'];
  $file = $_FILES['photo'];
  $destination = "../../assets/img/profiles/" . basename($image);
  // fonction permettant de recuperer la photo
  $newimage = RecuperPhoto($image, $file, $destination);
  // verification si la variable newimage a un element
  if ($newimage != 0) {
    #verifier si l'user existe ou pas dans la bd
    $getuser = $pdo->prepare("SELECT * FROM `user` WHERE password=?");
    $getuser->execute([$password]);
    $tab = $getuser->fetch();
    // verification si la variable tab est superieur à zéro
    if ($tab > 0) {
      $_SESSION['msg'] = 'Cette user existe dejà dans la base de données';//Cette variable recoit le message pour notifier l'users de l'opération qu'il deja fait
      $_SESSION['recupusername'] = $username;
      $_SESSION['recuppassword'] = $password;
      $_SESSION['recupnumtel'] = $numtel;
      header("location:../../views/user.php");
    }else{
      $req = $pdo->prepare("UPDATE `user` SET  username=?,password=?,numtel=?,photo=? WHERE id='$id'");
      $resultat = $req->execute([$username, $password,$numtel,$image]);
      if ($resultat == true) {
        $msg = "Modification réussie";
        $_SESSION['msg'] = $msg;
        header("location:../../views/user.php");
    }

  }
 
} else {
  header("location:../../views/user.php");
  }
}
