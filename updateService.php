<?php
    include_once 'includes/header.php';
    print_r($_SESSION);
    if (isset($user)) {
        include_once 'includes/bdd.php';
        $idService = $_GET['id'];
        if (isset($_POST)) {
            $valueService = $_POST;
            for ($i = 1; $i < count($valueService) + 1; $i++) {
                $value = $valueService[$i];
                $req = "UPDATE detail_service set value = $value WHERE service_id = $idService AND entity_id = $i";
                $res = $pdo->exec($req);
            }
        }
        $req = "SELECT * FROM detail_service WHERE service_id = $idService";
        $res = $pdo->query($req);
        $detail_service = $res->fetchAll();
        $req = "SELECT *
        FROM context";
        $res = $pdo->query($req);
        $context = $res->fetchAll();
        for ($i = 0;
             $i < count($context);
             $i++) {
            $nameContext = $context[$i]['name'];
            $idContext = $context[$i]['id'];
            $req = "SELECT *
        FROM category
        WHERE is_actived = 1
        AND context_id = $idContext ";
            $res = $pdo->query($req);
            $categories = $res->fetchAll();

            $b = 0;
            $o = -1;
            ?>
            <form action="/edsa-s-report/updateService.php?id=<?php echo $idService ?>" method="post">
            <center>
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
                                        $o++;
                                        $nameEntities = $entities[$i][$n]['name'];
                                        ?>
                                        <div class="col-2">
                                            <label><?php echo $nameEntities ?></label>
                                        </div>
                                        <div class="col-1">
                                            <input style="width: 50px;" name="<?php echo $b ?>"
                                                   value="<?php echo $detail_service[$o]['value'] ?>"
                                                   class="form-control form-input" required>
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
        <button type=submit class="btn btn-primary ">Valider</button>
        </form>
        </center>
        <?php
        include_once 'includes/footer.php';
    } else {
        header('Location: /edsa-s-report/authentification.php');
    }
