<?php
    include '../includes/bdd.php';
    print_r($_POST);
    $client = $_POST['client'];
    $date_to = $_POST['date_to'];
    $date_from = $_POST['date_from'];
    $service = $_POST;
    unset($service["client"]);
    unset($service["date_to"]);
    unset($service["date_from"]);

    echo "<pre>";
    print_r($service);
    echo "<pre>";
    $req = "INSERT INTO service (date_to,date_from,created_at,client_id) VALUES ('$date_to','$date_from',CURTIME(),'$client')";
    $res = $pdo->query($req);
    $idService = $pdo->lastInsertId();
    for ($i = 1; $i < count($service); $i++) {
        $valueService = $service[$i];
        $req = "INSERT INTO detail_service (value,entity_id,service_id) VALUES ('$valueService','$i','$idService')";
        $res = $pdo->query($req);
    }
    header('Location: ../index.php');