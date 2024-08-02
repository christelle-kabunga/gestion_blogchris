<?php
if(isset($_GET['delete_realisation']) && !empty($_GET['delete_realisation'])){
    $delete_id=$_GET['delete_realisation'];
 // echo $delete_id;

    //delete query
    $pdo->query("DELETE from  `realisations` where idreal=$delete_id");
    if($pdo){
        echo"<script>alert('Données supprimé avec succès')</script>"; 
        echo"<script>window.open('index.php','_self')</script>";
    }

}

?>