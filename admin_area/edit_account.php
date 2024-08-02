<?php


if(isset($_GET['edit_account']) ){
    $edit_id=$_GET['edit_account'];
    //echo $edit_id;
    //$user_session_name=$_SESSION['admin'];
    $iduser=$_SESSION['admin'];
   // echo $iduser;
 
    
    $req=$pdo->query("SELECT * from `login`where username='$iduser'");
    if ($tab=$req->fetch()) {
        ?>
        <div class="container mt-5">
        <h1 class="text-center">Changer Mon Profile</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-outline w-50 m-auto mb-4">
            <div class="form-outline mb-4">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" 
                    placeholder="Entrer votre Nom" required="required" value="<?=$tab['username']; ?>" class="form-control">
            </div>
            <div class="form-outline mb-4">
                    <label for="number" class="form-label">Phone</label>
                    <input type="text" id="tel" name="tel" 
                    placeholder="Entrer votre téléphone" required="required" value="<?php echo $tab['numtel']; ?>" class="form-control">
                </div>
            <div class="form-outline m-auto mb-4">
                <label for="product_image1" class="form-label">Image Illustratif</label>
                <div class="d-flex">
                <input type="file" id="img" name="img" 
                class="form-control w-90 m-auto" required="required">
                <img src="img_profile/<?php echo $tab['image']; ?>" class="img">
                </div>
                
            </div>
           
            <div class="w-50 m-auto">
                <input type="submit" name="edit_account" value="Modifier"
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

if(isset($_POST['edit_account'])){
    $username=htmlspecialchars($_POST['username']);
    $tel=htmlspecialchars($_POST['tel']);
    $img=$_FILES['img']['name'];
   
    $tmp_img=$_FILES['img']['tmp_name'];
   
    //checking for field empty or not

    if($username==''or $tel=='' or $img==''){
        echo"<script>alert('Remplissez tous les champs, puis continuer le processus')</script>";
    }else{
        move_uploaded_file($tmp_img,"img_profile/$img");
       
        //query to update products
        $edit_id=$_GET['edit_account'];
       $pdo->query(" UPDATE login SET username='$username', numtel='$tel', image='$img' WHERE iduser='$edit_id' ");
      
        if($pdo){
            echo"<script>alert('Données modifiées avec succès')</script>"; 
            echo"<script>window.open('../index.php','_self')</script>";
        }
    }
}
?>