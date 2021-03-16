<?php

    $prestation = true;
    include_once 'includes/header.php';
    if (isset($user)) {
        include_once 'includes/bdd.php';
        $req = "SELECT * FROM client";
        $res = $pdo->query($req);
        $client = $res->fetchAll();
        ?>


        <center>
            <form action="script/traitementInsertService.php" method="post">
                <section class="background-home">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-3"></div>
                            <div class="col-3">
                                <select name="client" class="select-space btn-round form-control" required>
                                    <option selected>Choisir un bénéficiaire</option>
                                    <?php
                                        for ($i = 0; $i < count($client); $i++) {
                                            ?>
                                            <option value="<?php echo $client[$i]['id'] ?>"><?php echo $client[$i]['name'] ?></option>
                                        <?php } ?>
                                </select>
                            </div>
                            <div class="col-3">
                                <input autocomplete="off" name="date" value="<?php echo date('d/m/Y') ?>"
                                       class="select-space btn-round form-control datepicker"
                                       type="text">
                            </div>
                            <div class="col-3"></div>
                        </div>
                        <a href="/index.php">
                            <input type="button" value="Annuler" class="btn btn-Service btn-round btn-index">
                        </a>
                        <span>&nbsp;&nbsp;</span>
                        <button type="submit" class="btn btn-Service btn-round btn-index">Ajouter</button>
                        <br><br>
                </section>
                <br>
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
                    for ($i = 0; $i < count($context); $i++) {
                        $nameContext = $context[$i]['name'];
                        $idContext = $context[$i]['id'];
                        $req = "SELECT *
        FROM category
        WHERE is_actived = 1
        AND context_id = $idContext ";
                        $res = $pdo->query($req);
                        $categories = $res->fetchAll();

                        ?>
                        <H3><?php echo $nameContext ?></H3>
                        <?php
                        for ($j = 0; $j < count($categories); $j++) {
                            $idCategories = $categories[$j]['id'];
                            $req = "SELECT *
        FROM entity
        WHERE is_actived = 1
        AND category_id = $idCategories;";
                            $res = $pdo->query($req);
                            $entities[$j] = $res->fetchAll();
                            $nameCategories = $categories[$j]['name'];

                            ?>
                            <div class="col-6">
                                <fieldset class="custom-border">
                                    <legend class="custom-border"><?php echo $nameCategories ?></legend>
                                    <div class="form-group">
                                        <div class="row entities">
                                            <?php

                                                for ($n = 0; $n < count($entities[$j]); $n++) {
                                                    $nameEntities = $entities[$j][$n]['name'];
                                                    ?>
                                                    <div class="col-2">
                                                        <label><?php echo $nameEntities ?></label>
                                                    </div>
                                                    <div class="col-1">
                                                        <input style="width: 50px;"
                                                               name="entities[<?php echo $entities[$j][$n]['id'] ?>]"
                                                               class="form-control form-input">
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
            </form>

            <br><br>
        </center>
        </div>
        <?php

        include_once 'includes/footer.php';
    } else {
        header('Location: /authentification.php');
    }
