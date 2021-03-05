<?php
    session_start();
    include_once '../includes/bdd.php';
    $courriel = $_POST['courriel'];
    $mdp = $_POST['mdp'];
    $req = "SELECT * FROM user WHERE email = '$courriel' AND password = '$mdp'";
    $res = $pdo->query($req);
    $user = $res->fetchAll();

    if ($user) {
        $_SESSION['user'] = $courriel;
        header('Location: ../index.php');
    } else { ?>
        <div>Erreur, identifiant ou mot de passe invalide</div>
        <a href="../authentification.php">
            <button>Retour à la connexion</button>
        </a>
        <?php
    }