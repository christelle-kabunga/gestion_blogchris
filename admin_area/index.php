<!-- ******connect file**** -->
<?php

include('../bd.php');
if(!isset($_SESSION['admin'])){
    header("location: login.php");
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Dashboard</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">

    <!-- Bootstrap core CSS -->
    <link href="../assetss/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assetss/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../style.css">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      .admin_image{
    width: 100px;
    object-fit: contain;
}
.img{
    width: 100px;
    object-fit: contain;
}
.footer{
    position:absolute;
    /* bottom:0; */
}
body{
    overflow-x: hidden;
}
.real_img{
    width: 100px;
    object-fit:contain;
}
.img_real{
    width: 100px;
    object-fit:contain;
}
    </style>

    
    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-info flex-md-nowrap p-0 shadow">
      <?php 
            $req=$pdo->prepare("select * from login");
           $req->execute();
           $donne=$req->fetch();
            ?>
      <img src="img_profile/<?php echo $donne["image"]; ?>" alt="" class="logo rounded-circle img-fluid" width="7%" height="7%px">

  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
    <?php
    if(isset($_SESSION['admin'])){ ?>
      <h5><a class="nav-link px-3" href="logout.php">Deconnexion</a></h5>
      <?php
    }else { ?>
      <h5><a class="nav-link px-3" href="login.php">Se connecter</a></h5>
      <?php } ?>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file"></span>
            
            </a>
          </li> <br> 
          <li class="nav-item">
            <a class="nav-link" href="insert_realisation.php">
              <span data-feather="shopping-cart"></span>
              inserer Réalisation
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?voir_realisation">
              <span data-feather="users"></span>
              voir Les réalisations
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?edit_account">
              <span data-feather="bar-chart-2"></span>
              Changer mon Profil
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Details</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
          <?php
        if(!isset($_SESSION['admin'])){ 
           echo" <h6 class='h2'>Bienvenu sur notre site</h6>";
            
          }else{
           echo" <h6 class='h2'> Bienvenu  ".$_SESSION['admin']."</h6>";
              }
                ?>
          </div>
        </div>
      </div>

      <div class="container my-3">
<?php
if(isset($_GET['voir_realisation'])){
    include('voir_realisation.php');  
}
if(isset($_GET['delete_realisation'])){
    include('delete_realisation.php');
}

if(isset($_GET['edit_realisation'])){
    include('edit_realisation.php');
}
if(isset($_GET['edit_account'])){
    include('edit_account.php');
}


?> 
</div>
    </main>
  </div>
</div>


    <script src="../assetss/dist/js/bootstrap.bundle.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
  </body>
</html>
