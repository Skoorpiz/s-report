<?php
    include_once '../includes/bdd.php';
    $idService = $_GET['id'];
    $req = "DELETE FROM detail_service WHERE service_id = $idService";
    $res = $pdo->exec($req);
    $req = "DELETE FROM service WHERE id = $idService";
    $res = $pdo->exec($req);
    header('Location: ../index.php');