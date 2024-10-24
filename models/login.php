<?php
include('../connexion/bd.php');
if(isset($_POST['connect']))
{
    $username=htmlspecialchars($_POST['username']);
    $password=htmlspecialchars($_POST['password']);

    // Fetch the user based on the username
    $req=$pdo->prepare("SELECT * FROM `user` WHERE username=?");
    $req->execute(array($username));
    if($_identifiant = $req->fetch()){
        // Verify the password
        if (password_verify($password, $_identifiant['password'])) {
            $_SESSION['msg']="";
            $_SESSION['iduser']=$_identifiant['id'];
            $_SESSION['username']=$_identifiant['username'];
            $_SESSION['image']=$_identifiant['photo'];
            $_SESSION['password']=$_identifiant['password'];
            $_SESSION['numtel']=$_identifiant['numtel'];
            $_SESSION['noms']=$_identifiant['username'];

            header("location:../views/realisations.php");
        } else {
            $_SESSION['msg']="username or password incorrect";
            header("location:../views/index.php");
        }
    } else {
        $_SESSION['msg']="username or password incorrect";
        header("location:../views/index.php");
    }
}
?>
