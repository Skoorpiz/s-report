<?php
    include '../includes/bdd.php';
    $client = $_POST['client'];
    $date = $_POST['date'];
    $service = $_POST;
    unset($service["client"]);
    unset($service["date"]);
    $req = "INSERT INTO service (date,updated_at,created_at,client_id) VALUES ('$date',CURTIME(),CURTIME(),'$client')";
    echo $req;
    $res = $pdo->query($req);
    $idService = $pdo->lastInsertId();
    for ($i = 1; $i < count($service) +1; $i++) {
        $valueService = $service[$i];
        $req = "INSERT INTO detail_service (value,entity_id,service_id) VALUES ('$valueService','$i','$idService')";
        $res = $pdo->query($req);
    }
    header('Location: ../ajouterService.php');