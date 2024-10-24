
<?php
if (isset($_SESSION['iduser']) && !empty($_SESSION['iduser'])) {
    $id = $_SESSION['iduser'];
    //requette qui permet d'afficher les données existant dans la base des données
    $getDatamod = $pdo->prepare("SELECT * FROM user WHERE id=?");
    $getDatamod->execute(array($id));
    // on s'assure que les informations ont été recupere
    if ($_tab = $getDatamod->fetch()) {
        $_nom =  $_tab[1];
        $_telephone =  $_tab[3];
        $_image = $_tab[4];
    } else {
        $_SESSION['msg'] = "Aucune information trouvée";
    }
} else {

}
