<?php
    include('../connexion/bd.php');
    session_destroy();
    header("Location:../views/index.php");