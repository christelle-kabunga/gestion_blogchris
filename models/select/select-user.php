<?php
    if (isset($_GET['iduser'])){
        $id=$_GET['iduser'];
        $getDataMod=$pdo->prepare("SELECT * FROM user WHERE id=?");
        $getDataMod->execute([$id]);
        if($tab=$getDataMod->fetch()){
            $username=$tab[1];
            $password=$tab[2];
            $numtel=$tab[3];

        }
        /**
         * Ici je specifie le lien lors qu'il s'agit de la modification, ce lien montre ou il faut allez faire la modification 
         * Et changer le texte de bouton pour que les utiliseures sachent s'il s'agit de quel action
         */
        $url="../models/updat/up-user-post.php?iduser=".$id;
        $btn="Modifier";
        $title="Modifier réalisations";
    }else{
        /**
         * Ici je specifie le lien lors qu'il s'agit de l'enregistrement, ce lien montre ou il faut allez faire l'enregistrement 
         * Et changer le texte de bouton pour que les utiliseures sachent s'il s'agit de quel action
         */
        $url="../models/add/add-user-post.php";
        $btn="Enregistrer";
        $title="Ajouter réalisations";
    }

       /**
     * Le code qui permet d'afficher les user, lors de l'affichage simple, et lors de la recherche
     */
    if(isset($_GET['search']) && !empty($_GET['search'])){
        $search=$_GET['search'];
        $getData=$pdo->prepare("SELECT * from user WHERE user.username LIKE ? OR user.password LIKE ? 
         OR user.photo LIKE ? OR user.numtel LIKE ?");
        $getData->execute(["%".$search."%", "%".$search."%", "%".$search."%", "%".$search."%"]);
    }
    else{
        $getData=$pdo->prepare("SELECT * from user");
        $getData->execute();
    }