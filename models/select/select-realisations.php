<?php
    if (isset($_GET['idreal'])){
        $id=$_GET['idreal'];
        $getDataMod=$pdo->prepare("SELECT * FROM realisations WHERE id=?");
        $getDataMod->execute([$id]);
        if($tab=$getDataMod->fetch()){
            $title=$tab[1];
            $description=$tab[2];
            $lien=$tab[3];

        }
        /**
         * Ici je specifie le lien lors qu'il s'agit de la modification, ce lien montre ou il faut allez faire la modification 
         * Et changer le texte de bouton pour que les utiliseures sachent s'il s'agit de quel action
         */
        $url="../models/updat/up-realisations-post.php?idreal=".$id;
        $btn="Modifier";
        $title="Modifier réalisations";
    }else{
        /**
         * Ici je specifie le lien lors qu'il s'agit de l'enregistrement, ce lien montre ou il faut allez faire l'enregistrement 
         * Et changer le texte de bouton pour que les utiliseures sachent s'il s'agit de quel action
         */
        $url="../models/add/add-realisations-post.php";
        $btn="Enregistrer";
        $title="Ajouter réalisations";
    }

       /**
     * Le code qui permet d'afficher les realisations, lors de l'affichage simple, et lors de la recherche
     */
    if(isset($_GET['search']) && !empty($_GET['search'])){
        $search=$_GET['search'];
        $getData=$pdo->prepare("SELECT * from realisations WHERE realisations.nomreal LIKE ? OR realisations.description LIKE ? 
         OR realisations.photo LIKE ? OR realisations.lien LIKE ?");
        $getData->execute(["%".$search."%", "%".$search."%", "%".$search."%", "%".$search."%"]);
    }
    else{
        $getData=$pdo->prepare("SELECT * from realisations");
        $getData->execute();
    }