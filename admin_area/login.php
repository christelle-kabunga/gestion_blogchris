<?php
//@session_start();
include('../bd.php');


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin registration</title>
    <link rel="stylesheet" href="../assetss/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assetss/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../style.css">
    <style>
        body{
            overflow: hidden;
        }
    </style>
</head>
<body>
   <div class="container-fluid">
    <h2 class="text-center mb-5 ">Connectez-vous ici</h2>
    <div class="row d-flex justify-content-center">
        <div class="col-lg-6 col-xl-5 ">
            <img src="../img/login.jpg" alt="admin registration" class="img-fluid">
        </div>
        <div class="col-lg-6 col-xl-4">
            <form action="" method="post">
                <div class="form-outline mb-4">
                    <label for="username" class="form-label">Nom Utilisateur</label>
                    <input type="text" id="username" name="username" 
                    placeholder="Entrer votre Nom" required="required" class="form-control">
                </div>
              
                <div class="form-outline mb-4">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" id="password" name="password" 
                    placeholder="Entrer votre Mot de passe" required="required" class="form-control">
                </div>
                
                <div>
                    <input type="submit" class="bg-primary py-2 px-3 border-0" name="admin_login" value="Se connecter">
                    <p class="small fw-bold pt-1 mt-2 ">Vous n'avez pas de compte? 
                        <a href="admin_register.php" class="link-danger">S'enregistrer</a> </p>
                </div>
            </form>
        </div>
    </div>
   </div> 
</body>
</html>

<!-- php login -->
<?php
if(isset($_POST['admin_login'])){
    $username=$_POST['username'];
    $password=($_POST['password']);
    if(!empty($username)&&(!empty($password))){
        $reqadmin=$pdo->prepare("SELECT * from login where username=? 
        and password=? ");
        $reqadmin->execute(array($username,$password));
        $admin=$reqadmin->fetch();
       
        if($admin){
            $_SESSION['admin']=$admin['username'];
            $_SESSION['admi']=$admin['iduser'];


            echo"<script>alert('La connexion a réussie')</script>";
            echo"<script>window.open('./index.php','_self')</script>";
        }else{
            echo"<script>alert('Echec de connexion')</script>";
        }
   
    
}
}
?>