
<h3 class="text-center text-success">Tous mes Réalisations</h3>
<div class="table-responsive">
    <table class="table table-bordered mt-5  table-striped table-sm">
        <thead class="bg-info">
            <tr>
            <th>ID Réalisation</th>
            <th>Titre Réalisation</th>
            <th>Image</th>
            <th>Déscription</th>
            <th>Modifier</th>
            <th>Supprimer</th>
            </tr>
        </thead>
        <tbody class="bg-secondary text-light">
            <?php
             $number=0;
            $req=$pdo->query("SELECT * from realisations");
            while($realisations=$req->fetch()){
             $number++;
        ?>
        <tr class="text-center text-light">
        <td><?php echo $number;?></td>
        <td><?php echo $realisations['nomreal'] ?></td>
        <td><img src='../img/<?php echo $realisations['photo']?>' class='real_img'></td>
        <td><?php echo  $realisations['description']?></td>
        <td><a href='index.php?edit_realisation=<?php echo $realisations['idreal'] ?>' class='text-light'><i class='bi-solid bi bi-pencil-square text-light'></i></a></td>
        <td><a href='index.php?delete_realisation=<?php echo $realisations['idreal'] ?>' type="button" 
        class="text-light" data-toggle="modal" data-target="#boite">
        <i class='bi-solid bi bi-trash text-light'></i></a></td>
    </tr>
    <?php
    }
    ?>
        </tbody>
    </table>
    </div>
    <!-- modal -->
<div class="container ">
   <div class="modal fade" id="boite">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-body">
              <h4>Etes-vous sûr de vouloir supprimer ceci?</h4>  
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-danger"><a href="./index.php?voir_realisation" 
               class="text-light text-decoration-none">Non</a></button>
               <button type="button" class="btn btn-primary"><a href='index.php?delete_realisation=<?php echo $realisations['idreal'] ?>' 
               class="text-light text-decoration-none">Oui</a></button>
            </div>
        </div>
    </div>
   </div>
  </div>
