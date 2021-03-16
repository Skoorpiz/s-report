<?php
    $prestation = true;
    include_once 'includes/header.php';
    if (isset($user)) {
        include_once 'includes/bdd.php';
        $req = "SELECT * FROM client";
        $res = $pdo->query($req);
        $client = $res->fetchAll();
        ?>

        <br>
        <div class="container-fluid">
            <center>
                <form action="script/traitementInsertService.php" method="post">
                    <div class="row">
                        <div class="col-3"></div>
                        <div class="col-3">
                            <p>Bénéficiaire</p>
                            <select name="client" class="form-control" required>
                                <option selected>Choisir un bénéficiaire</option>
                                <?php
                                    for ($i = 0; $i < count($client); $i++) {
                                        ?>
                                        <option value="<?php echo $client[$i]['id'] ?>"><?php echo $client[$i]['name'] ?></option>
                                    <?php } ?>
                            </select>
                        </div>
                        <div class="col-3">
                            <p>Date</p>
                            <input name="date" type="date" class="form-control" required>
                        </div>
                        <div class="col-3"></div>
                    </div>
                    <br>

                    <?php
                        $req = "SELECT *
        FROM context";
                        $res = $pdo->query($req);
                        $context = $res->fetchAll();
                        for ($i = 0; $i < count($context); $i++) {
                            $nameContext = $context[$i]['name'];
                            $idContext = $context[$i]['id'];
                            $req = "SELECT *
        FROM category
        WHERE is_actived = 1
        AND context_id = $idContext ";
                            $res = $pdo->query($req);
                            $categories = $res->fetchAll();

                            $b = 0;
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
                                        <legend class="custom-border"><?php echo $nameCategories ?></legend>
                                        <div class="form-group">
                                            <div class="row entities">
                                                <?php

                                                    for ($n = 0; $n < count($entities[$i]); $n++) {
                                                        $b++;
                                                        $nameEntities = $entities[$i][$n]['name'];
                                                        ?>
                                                        <div class="col-2">
                                                            <label><?php echo $nameEntities ?></label>
                                                        </div>
                                                        <div class="col-1">
                                                            <input style="width: 50px;" name="<?php echo $b ?>"
                                                                   value="0" class="form-control form-input" required>

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
                    <a href="index.php">
                        <button class="btn btn-primary ">Annuler</button>
                    </a>
                    <button type="submit" class="btn btn-primary ">Ajouter</button>
                </form>
            </center>
        </div>
        <?php

        include_once 'includes/footer.php';
    } else {
        header('Location: /edsa-s-report/authentification.php');
    }
