<?php session_start();
    $user = $_SESSION['user'];
    $role = $_SESSION['role'];
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
    <link href="/includes/styles.css?v=<?php echo rand(999, 99999) ?>" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


    <link rel="icon" href="/images/favicon.ico" />
</head>
<nav class="navbar navbar-expand-sm navbar-color navbar-light img-nav">

    <ul class="navbar-color" id="menu" class="navbar-nav">
        <li class="nav-item">
            <a class="navbar-brand" href="/index.php">
                <img class="center-text logo" src="/images/syga_logo.gif" alt="Logo"">
            </a>
        </li>
        <li class="<?php if ($accueil == true) { ?> active <?php } ?> nav-item ">
            <a class=" nav-link bold " href="/index.php">Rechercher</a>
        </li>

        <li class="<?php if ($prestation == true) { ?> active <?php } ?> nav-item  ">
            <a class="nav-link bold" href="/ajouterService.php">Prestations</a>
        </li>

        <li class="<?php if ($stats == true) { ?> active <?php } ?>nav-item  ">
            <a class="nav-link bold" href="/statistique.php">Stats</a>
        </li>

        <li class="nav-item ">
            <a class="nav-link bold" href="#">Outils</a>
        </li>
    </ul>
    <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
        <ul class="navbar-nav">
            <li class="nav-item ">
                <a class="nav-link" href="/script/traitementDeconnexion.php"><i class="power-pink fas fa-power-off"></i></a>
            </li>
        </ul>
    </div>
</nav>

<body>