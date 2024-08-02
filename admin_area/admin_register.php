<?php
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
        /* body{
            overflow: hidden;
        } */
    </style>
</head>
<body>
   <div class="container-fluid">
    <h2 class="text-center mb-5 ">Enregistrement d'un administrateur</h2>
    <div class="row d-flex justify-content-center">
        <div class="col-lg-6 col-xl-5 ">
            <img src="../img/login.jpg" alt="admin registration" class="img-fluid">
        </div>
        <div class="col-lg-6 col-xl-4">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-outline mb-4">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" 
                    placeholder="Entrer votre Nom" required="required" class="form-control">
                </div>
                <div class="form-outline mb-4">
                    <label for="number" class="form-label">Phone</label>
                    <input type="text" id="tel" name="tel" 
                    placeholder="Entrer votre téléphone" required="required" class="form-control">
                </div>
                <div class="form-outline mb-4">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" id="password" name="password" 
                    placeholder="Entrer votre Mot de passe" required="required" class="form-control">
                </div>
                <div class="form-outline mb-4">
                    <label for="confirm_password" class="form-label">Confirmer Mot de passe</label>
                    <input type="password" id="confirm_password" name="confirm_password" 
                    placeholder="Confirmer votre Mot de passe" required="required" class="form-control">
                </div>
                <!-- ***image field*** -->
                <div class="form-outline  mb-4">
                    <label for="user_img" class="form-label">Image de profile</label>
                    <input type="file" id="user_img" class="form-control"  
                    required="required" name="user_img">
                </div>
                
                <div>
                    <input type="submit" class="bg-primary btn btn-rounded py-2 px-3 border-0" name="admin_registration" value="Enregistrer">
                    <p class="small fw-bold pt-1 mt-2 ">Avez-vous déjà un compte? <a href="login.php" class="link-danger">Se connecter</a> </p>
                </div>
            </form>
        </div>
    </div>
   </div> 
</body>
</html>

<!-- php logic -->

<!-- ***php code*** -->
<?php
if(isset($_POST['admin_registration'])){
    $username=htmlspecialchars($_POST['username']);
    $tel=htmlspecialchars($_POST['tel']);
    $password=$_POST['password'];
    $hash_pwd=password_hash($password,PASSWORD_DEFAULT);
    $confirm_password=$_POST['confirm_password'];
    
    $user_img=$_FILES['user_img']['name'];
    $user_img_tmp=$_FILES['user_img']['tmp_name'];
   // checking empty condition
      
    //select query

    $req=$pdo->query("select * from `login` where username='$username' 
    or numtel='$tel'");
    $c = $req->rowCount();
    if($c>0){
        echo"<script>alert('ce nom ou ce numero de téléphone existe déjà')</script>";  
    }elseif($password!=$confirm_password){
        echo"<script>alert('vérifier si le mot de passe corresponde')</script>";   
    }else{
        
         //insert_query
         move_uploaded_file($user_img_tmp,"img_profile/$user_img");
         
         $req=$pdo->prepare("INSERT into login (username,password,numtel,image) values(?,?,?,?)");
         $req->execute([$username,$password,$tel,$user_img]);
    }
    if($req){
        echo"<script>alert('votre compte a été créer avec succès')</script>";
        echo"<script>window.open('./login.php','_self')</script>";  
    }
}

?>