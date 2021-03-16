<?php
    include_once '../includes/functions.php';

    include '../includes/bdd.php';

    $client = $_POST['client'];
    $dateFr = $_POST['date'];
    $date = convertDate($dateFr, '%s-%s-%s');
    $service = $_POST;
    unset($service["client"]);
    unset($service["date"]);
    $req = "INSERT INTO service (date,annee,mois,updated_at,created_at,client_id) VALUES ('$date',YEAR('$date'),MONTH('$date'),CURTIME(),CURTIME(),'$client')";
    $res = $pdo->query($req);
    $idService = $pdo->lastInsertId();

    $entities = $_POST['entities'];
    foreach ($entities as $entityId => $value) {
        if (!empty($value)) {
            $req = "INSERT INTO detail_service (value,entity_id,service_id) VALUES ('$value','$entityId','$idService')";
            $res = $pdo->query($req);
        }
    }
    /*
    for ($i = 1; $i < count($service) +1; $i++) {
        $valueService = $service[$i];
        if(!empty($service[$i])) {
            $req = "INSERT INTO detail_service (value,entity_id,service_id) VALUES ('$valueService','$i','$idService')";
            $res = $pdo->query($req);
        }
    }
    */
    header('Location: ../ajouterService.php');