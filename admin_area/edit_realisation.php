<?php
if(isset($_GET['edit_realisation']) && !empty($_GET['edit_realisation'])){
    $edit_id=$_GET['edit_realisation'];
    //echo $edit_id;
    $req=$pdo->query("SELECT * from `realisations` where idreal=$edit_id");
    if ($tab=$req->fetch()) {
        ?>
        <div class="container mt-5">
        <h1 class="text-center">Effectuer la Modification</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-outline w-50 m-auto mb-4">
                <label for="real_title" class="form-label">Titre de la Réalisation</label>
                <input type="text" id="real_title" name="real_title" 
                class="form-control" required="required" value="<?=$tab['nomreal']; ?>">
            </div>
            <div class="form-outline w-50 m-auto mb-4">
                <label for="description" class="form-label">Description de la réalisation</label>
                <input type="text" id="description" name="description"value="<?php echo $tab['description']; ?>" 
                class="form-control" required="required">
            </div>
            <div class="form-outline w-50 m-auto mb-4">
                <label for="lien" class="form-label">URL</label>
                <input type="text" id="lien" name="lien"value="<?php echo $tab['lien']; ?>" 
                class="form-control" required="required">
            </div>
           
            <div class="form-outline w-50 m-auto mb-4">
                <label for="product_image1" class="form-label">Image Illustratif</label>
                <div class="d-flex">
                <input type="file" id="img_real" name="img_real" 
                class="form-control w-90 m-auto" required="required">
                <img src="../img/<?php echo $tab['photo']; ?>" class="img_real">
                </div>
                
            </div>
           
            <div class="w-50 m-auto">
                <input type="submit" name="edit_realiisation" value="Modifier"
                 class="btn btn-info px-3 mb-3">
            </div>
        </form>
        </div>

<?php
}
}
?>

<!-- ***editting realisation*** -->
<?php 

if(isset($_POST['edit_realiisation'])){
    $real_title=htmlspecialchars($_POST['real_title']);
    $description=htmlspecialchars($_POST['description']);
    $lien=htmlspecialchars($_POST['lien']);
    $img_real=$_FILES['img_real']['name'];
   
    $tmp_img_real=$_FILES['img_real']['tmp_name'];
   
    //checking for field empty or not

    if($real_title==''or $description=='' or $img_real=='' or $lien==''){
        echo"<script>alert('Remplissez tous les champs, puis continuer le processus')</script>";
    }else{
        move_uploaded_file($tmp_img_real,"../img/$img_real");
       
        //query to update products
        $edit_id=$_GET['edit_realisation'];
       $pdo->query(" UPDATE realisations SET nomreal='$real_title', description='$description',lien='$lien',photo='$img_real' WHERE idreal='$edit_id' ");
      
        if($pdo){
            echo"<script>alert('Données modifiées avec succès')</script>"; 
            echo"<script>window.open('index.php','_self')</script>";
        }
    }
}
?>