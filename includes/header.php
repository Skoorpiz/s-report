<?php session_start();
    $user = $_SESSION['user'];
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="/edsa-s-report/includes/styles.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

</head>
<nav class="navbar navbar-expand-sm bg-light navbar-light">
    <a class="navbar-brand" href="#">
        <img src="/edsa-s-report/images/syga_logo.gif" alt="Logo" style="width:80px;">
    </a>
    <ul class="navbar-nav">
        <li class="nav-item active">
            <a <?php if (isset($accueil)) { ?> class="nav-link bold" <?php } else { ?> class="nav-link" <?php } ?> href="/edsa-s-report/index.php">Accueil</a>
        </li>
        <li class="nav-item active">
            <a <?php if (isset($prestation)) { ?> class="nav-link bold" <?php } else { ?> class="nav-link" <?php } ?> href="/edsa-s-report/ajouterService.php">Prestations</a>
        </li>
        <li class="nav-item active">
            <a <?php if (isset($stats)) { ?> class="nav-link bold" <?php } else { ?> class="nav-link" <?php } ?> href="/edsa-s-report/statistique.php">Stats</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="#">Outils</a>
        </li>
    </ul>
    <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="/edsa-s-report/script/traitementDeconnexion.php">Quiter</a>
            </li>
        </ul>
    </div>
</nav>

<body>