<?php
// Inclusion de la connexion BD
include '../connexion/bd.php';
// Appel des sélections
require_once ('../models/select/select-realisations.php');
// Appel des fonctions
require_once ('../fonctions/fonctions.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Réalisations</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <?php require_once ('style.php'); ?>
</head>

<body>

    <!-- Appel du menu -->
    <?php require_once ('aside.php') ?>

    <main id="main" class="main">
        <div class="row">
            <div class="col-12">
                <h4><?= $title ?></h4>
            </div>

            <!-- Affichage des messages -->
            <?php if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) { ?>
                <div class="alert-info alert text-center"><?= $_SESSION['msg']; ?></div>
            <?php } unset($_SESSION['msg']); ?>

            <div class="col-xl-12">
                <form action="<?= $url ?>" method="POST" class="card p-3" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 p-3">
                            <label for="">Titre <span class="text-danger">*</span></label>
                            <input autocomplete="off" name="titre" 
                                value="<?= isset($_GET['idreal']) ? $tab['nomreal'] : (isset($_SESSION['recuptitre']) ? $_SESSION['recuptitre'] : '') ?>" 
                                required type="text" class="form-control" placeholder="EX: site web">
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 p-3">
                            <label for="">Description <span class="text-danger">*</span></label>
                            <input autocomplete="off" name="description" 
                                value="<?= isset($_GET['idreal']) ? $tab['description'] : (isset($_SESSION['recupdescription']) ? $_SESSION['recupdescription'] : '') ?>" 
                                required type="text" class="form-control" placeholder="EX: site de e-commerce">
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 p-3">
                            <label for="">Lien <span class="text-danger">*</span></label>
                            <input autocomplete="off" name="lien" 
                                value="<?= isset($_GET['idreal']) ? $tab['lien'] : (isset($_SESSION['recuplien']) ? $_SESSION['recuplien'] : '') ?>" 
                                required type="text" class="form-control" placeholder="EX: https://...">
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 p-3">
                            <label for="">Image <span class="text-danger">*</span></label>
                            <input name="photo" type="file" class="form-control">
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <input name="valider" type="submit" class="btn btn-dark w-100" value="<?= $btn ?>">
                        </div>
                    </div>
                </form>
            </div>

            <!-- Affichage des données -->
            <div class="col-xl-12 table-responsive px-3 card mt-4 px-4 pt-3">
                <table class="table table-borderless datatable">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Titre</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Lien</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $n = 0;
                        while ($idreal = $getData->fetch()) {
                            $n++;
                        ?>
                            <tr>
                                <th scope="row"><?= $n; ?></th>
                                <td><?= $idreal["nomreal"] ?></td>
                                <td><?= $idreal["description"] ?></td>
                                <td><img src="../assets/img/realisations/<?= $idreal["photo"] ?>" width='50' height="50" style="object-fit: cover;"></td>
                                <td><?= $idreal["lien"] ?></td>
                                <td>
                                    <a href='realisations.php?idreal=<?= $idreal['id'] ?>' class="btn btn-dark btn-sm"><i class="bi bi-pencil-square"></i></a>
                                    <a onclick="return confirm('Voulez-vous vraiment supprimer ?')" 
                                        href='../models/delete/del-realisations-post.php?idsupcat=<?= $idreal['id'] ?>' 
                                        class="btn btn-danger btn-sm"><i class="bi bi-trash3-fill"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <?php require_once ('script.php') ?>

</body>
</html>