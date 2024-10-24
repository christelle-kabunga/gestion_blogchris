<?php
#inclusion de la page de connexion
include ('../../connexion/bd.php');
// Appel de lq fonction
require_once ('../../fonctions/fonctions.php');
// creation de l'evenement sur le bouton valider
if(isset($_POST['valider'])){
  $username=htmlspecialchars($_POST['username']) ;
  $password=htmlspecialchars($_POST['password']);
  $numtel=htmlspecialchars($_POST['numtel']);

    // password hashing
    $passwordh = $password;
    $passwordhacher = password_hash($passwordh, PASSWORD_DEFAULT);
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
      $_SESSION['msg'] = 'Cet utilisation existe dejà dans la base de données';//Cette variable recoit le message pour notifier l'user de l'opération qu'il deja fait
      $_SESSION['recupusername'] = $username;
      $_SESSION['recuppassword'] = $password;
      $_SESSION['recupnumtel'] = $numtel;
      header("location:../../views/user.php");
    } else {
      if (is_numeric($numtel)) {
        $req = $pdo->prepare("INSERT INTO user (username,password,numtel,photo) VALUES (?,?,?,?)");
        $resultat = $req->execute([$username,$passwordhacher,$numtel,$newimage]);
        if ($resultat == true) {
          $_SESSION['msg'] = "Enregistrement réussie";
          header("location:../../views/user.php");
        } else {
          $_SESSION['msg'] = "Echec d'enregistrement";
          header("location:../../views/user.php");
      } 
    } else {
        $_SESSION['msg'] = "Le numero de téléphone ne doit pas être une chaîne de caractère";
        $_SESSION['recupusername'] = $username;
        $_SESSION['recuppassword'] = $password;
        $_SESSION['recupnumtel'] = $numtel;
        header("location:../../views/user.php");
      }
    }
  } else {
    $_SESSION['msg'] = "Le format de l'image que vous avez choisi n'est pas autorisé";
    header("location:../../views/user.php");
  }

} else {
  header("location:../../views/user.php");
}
?>