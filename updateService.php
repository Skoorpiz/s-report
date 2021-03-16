<?php
    include_once 'includes/header.php';
    if (isset($user)) {
        include_once 'includes/bdd.php';
        $idService = $_GET['id'];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $entitiesService = $_POST['entities'];
            foreach ($entitiesService as $method => $entities) {
                if ($method == "update") {
                    foreach ($entities as $item) {
                        foreach ($item as $detailService) {
                            $idDetail = key($detailService);
                            $value = $detailService[$idDetail];
                            $req = "UPDATE detail_service set value = $value WHERE id = $idDetail";
                            $res = $pdo->query($req);
                        }
                    }
                } else {
                    foreach ($entities as $idEntity => $item) {
                        foreach ($item as $service) {
                            $idService = key($service);
                            $value = $service[$idService];
                            if (!empty($value)) {
                                $req = "INSERT INTO detail_service (value,entity_id,service_id) VALUES ('$value','$idEntity','$idService')";
                                $res = $pdo->query($req);
                            }
                        }
                    }
//
                }
//
            }
        }
        ?>
        <br>
        <center>
            <form action="/updateService.php?id=<?php echo $idService ?>" method="post">
                <a href="/index.php">
                    <input type="button" value="Annuler" class="btn btn-Service btn-round btn-index">
                </a>
                <span>&nbsp;&nbsp;</span>
                <button type="submit" class="btn btn-Service btn-round btn-index">Ajouter</button>
                <br><br>
                <?php
                    switch ($role) {
                        case 1:
                            $req = "SELECT *
        FROM context
        WHERE is_actived = 1";
                            $res = $pdo->query($req);
                            $context = $res->fetchAll();
                            break;
                        case 2 :
                            $req = "SELECT *
        FROM context
        WHERE is_actived = 1
        AND id = 1";
                            $res = $pdo->query($req);
                            $context = $res->fetchAll();
                            break;
                        case 3:
                            $req = "SELECT *
        FROM context
        WHERE is_actived = 1
        AND id = 2";
                            $res = $pdo->query($req);
                            $context = $res->fetchAll();
                            break;
                        case 4 :
                            $req = "SELECT *
        FROM context
        WHERE is_actived = 1
        AND id = 3";
                            $res = $pdo->query($req);
                            $context = $res->fetchAll();
                            break;
                    }
                    for ($j = 0;
                         $j < count($context);
                         $j++) {
                        $nameContext = $context[$j]['name'];
                        $idContext = $context[$j]['id'];
                        $req = "SELECT *
                            FROM category
                            WHERE is_actived = 1
                            AND context_id = $idContext ";
                        $res = $pdo->query($req);
                        $categories = $res->fetchAll();


                        ?>

                        <H3><?php echo $nameContext ?></H3>
                        <?php
                        for ($i = 0; $i < count($categories); $i++) {
                            $idCategories = $categories[$i]['id'];
                            $req = "SELECT *
                            FROM entity
                            WHERE is_actived = 1
                            AND category_id = $idCategories;";
                            $res = $pdo->query($req);
                            $entities[$i] = $res->fetchAll();
                            $nameCategories = $categories[$i]['name'];

                            ?>
                            <div class="col-6">
                                <fieldset class="custom-border">
                                    <legend class="custom-border">
                                        <?php echo $nameCategories ?></legend>
                                    <div class="form-group">
                                        <div class="row entities">
                                            <?php

                                                for ($n = 0; $n < count($entities[$i]); $n++) {
                                                    $nameEntities = $entities[$i][$n]['name'];
                                                    $req = "SELECT id, value FROM detail_service WHERE service_id = $idService AND entity_id = " . $entities[$i][$n]['id'];
                                                    $res = $pdo->query($req);
                                                    $detail_service = $res->fetchAll();
                                                    $detail_service = $detail_service[0];
                                                    ?>
                                                    <div class="col-2">
                                                        <label>
                                                            <?php echo $nameEntities ?></label>
                                                    </div>
                                                    <div class="col-1">
                                                        <?php if (!empty($detail_service)) { ?>
                                                            <input style="width: 50px;"
                                                                   name="entities[update][<?php echo $entities[$i][$n]['id'] ?>][detail_service][<?php echo $detail_service['id'] ?>]"
                                                                   value="<?php echo $detail_service['value'] ?>"
                                                                   class="form-control form-input">
                                                        <?php } else { ?>
                                                            <input style="width: 50px;"
                                                                   name="entities[insert][<?php echo $entities[$i][$n]['id'] ?>][service][<?php echo $idService ?>]"
                                                                   class="form-control form-input">
                                                        <?php } ?>
                                                    </div>
                                                    <?php
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <?php
                        }
                    }
                ?>
                <a href="/index.php">
                    <input type="button" value="Annuler" class="btn btn-Service btn-round btn-index">
                </a>
                <span>&nbsp;&nbsp;</span>
                <button type="submit" class="btn btn-Service btn-round btn-index">Ajouter</button>
                <br><br>
            </form>
        </center>
        <?php
        include_once 'includes/footer.php';
    } else {
        header('Location: /authentification.php');
    }
