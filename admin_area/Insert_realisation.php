<?php
include('../bd.php');
if(isset($_POST['insert_realisation'])){
    $real_title=htmlspecialchars($_POST['real_title']) ;
    $description=htmlspecialchars($_POST['description']);
    $lien=htmlspecialchars($_POST['lien']);
    
//accessing images
$img_real=$_FILES['img_real']['name'];
//accessing images tmp name
$temp_img_real=$_FILES['img_real']['tmp_name'];

// checking empty condition
if($real_title=='' or $description=='' or $img_real=='' or $lien=='' ){
    echo"<script> alert('Remplissez tous les champs svp')</script>";
    exit();   
}else{
    //garder les images dans un dossier
    move_uploaded_file($temp_img_real,"../img/$img_real");
   
    //insert query
    $req=$pdo->prepare("INSERT INTO realisations (nomreal,description,photo,lien) VALUES (?,?,?,?)");
    $req->execute(array($real_title,$description,$img_real,$lien));
    if($req){
        echo"<script> alert('Enregistrement reussi')</script>";
    }
}

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin dashboard</title>
    <link rel="stylesheet" href="../assetss/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assetss/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body class="bg-light">
<h5><a class="nav-link px-3" href="index.php">RETOUR</a></h5>
<div class="container mt-3 ">
    <h1 class="text-center">Ajouter parmi vos Réalisations</h1>
    <!-- *****form****** -->
    <form action="" method="post" class="border border-warning" enctype="multipart/form-data">
        <!-- *****title***** -->
        <div class="outline mb-4 w-50 m-auto">
            <label for="real_title" class="form-label">Titre de la Réalisation</label>
            <input type="text" name="real_title" id="real_title" 
            class="form-control" placeholder=" entrer le titre de la Réalisation" 
            autocomplete="off" required="required">
        </div>
        <!-- *****description***** -->
        <div class="outline mb-4 w-50 m-auto">
            <label for="description" class="form-label">Description Réalisation</label>
            <input type="text" name="description" id="description" 
            class="form-control" placeholder=" entrer la description" 
            autocomplete="off" required="required">
        </div>

            <!-- *****image1***** -->
            <div class="outline mb-4 w-50 m-auto">
            <label for="img_real" class="form-label"> image illustratif</label>
            <input type="file" name="img_real" id="img_real" 
            class="form-control" required="required">
        </div>
        <!-- *****lien***** -->
        <div class="outline mb-4 w-50 m-auto">
            <label for="lien" class="form-label">URL</label>
            <input type="text" name="lien" id="lien" 
            class="form-control" placeholder=" entrer le lien" 
            autocomplete="off" required="required">
        </div>

          <!-- *****boutton***** -->
          <div class="outline mb-4 w-50 m-auto">
           <input type="submit" name="insert_realisation" value="inserer realisation"
            class="btn btn-primary mb-3 px-3">
        </div>
    </form>
</div>


<script src="../assetss/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>