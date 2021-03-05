<?php
    /** @var PDO $pdo */

    include_once 'includes/header.php';
    if (isset($user)) {
        include_once 'includes/bdd.php';
        $req = "SELECT * FROM client";
        $res = $pdo->query($req);
        $client = $res->fetchAll();
        if (isset($_GET['idClient']) && isset($_GET['date_from']) && isset($_GET['date_to'])) {
            $idGetClient = $_GET['idClient'];
            $date_from = $_GET['date_from'];
            $date_to = $_GET['date_to'];
        }
        ?>
        <center>
            <br>
            <H2>Accueil</H2>
        </center>
        <div class="container-fluid">
            <form action="" method="get">
                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-1">
                        <p>Bénéficiaire</p>
                    </div>
                    <div class="col-2">
                        <select name="idClient" class="form-control" required>
                            <option selected>Choisir un bénéficiaire</option>
                            <?php
                                for ($i = 0; $i < count($client); $i++) {
                                    $idClient = $client[$i]['id'];
                                    $nameClient = $client[$i]['name'];
                                    ?>
                                    <option value="<?php echo $idClient ?>"><?php echo $nameClient ?></option>
                                <?php } ?>
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-1">
                        <p>Date de début</p>
                    </div>
                    <div class="col-2">
                        <input name="date_from" type="date" class="form-control" required>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-1">
                        <p>Date de fin</p>
                    </div>
                    <div class="col-2">
                        <input name="date_to" type="date" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                    </div>
                    <div class="col-2">
                        <button class="btn btn-primary btn-index">Rechercher</button>
                    </div>
                </div>

            </form>
            <div class="row">
                <div class="col-6">
                </div>
                <div class="col-2">
                    <a href="ajouterService.php">
                        <button class="btn btn-primary btn-index">Nouvelle <br> prestation</button>
                    </a>
                </div>
            </div>
            <?php
                if (isset($idGetClient) && isset($date_from) && isset($date_to)) {
//                $req = "SELECT *
//                        FROM service
//                        WHERE client_id = $idGetClient
//                        AND date BETWEEN '$date_from'
//                        AND '$date_to'";
                    $req = sprintf("SELECT * 
                        FROM service 
                        WHERE client_id = %s 
                        AND date BETWEEN '%s'
                        AND '%s'", $idGetClient, $date_from, $date_to);
                    $res = $pdo->query($req);
                    $service = $res->fetchAll();
                    $req = "SELECT name FROM client WHERE id = $idGetClient";
                    $res = $pdo->query($req);
                    $nameGetClient = $res->fetchColumn();
                    ?>
                    <center>
                        <table class="table table-bordered w-50">
                            <thead>
                            <tr>
                                <th width="1px;">Date</th>
                                <th width="1px;">Client</th>
                                <th width="1px;">Modifier</th>
                                <th width="1px;">Supprimer</th>

                            </tr>
                            <?php for ($i = 0; $i < count($service); $i++) { ?>
                                <tr>
                                    <td>
                                        <?php echo $service[$i]['date'] ?>
                                    </td>
                                    <td>
                                        <?php echo $nameGetClient ?>
                                    </td>
                                    <td>
                                        <a href="updateService.php?id=<?php echo $service[$i]['id'] ?>">
                                            <i class="fas fa-pen-square"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="script/traitementDeleteService.php?id=<?php echo $service[$i]['id'] ?>">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>

                                </tr>
                            <?php } ?>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </center>
                    <?php
                }
            ?>

        </div>

        <?php
        include_once 'includes/footer.php';
    } else {
        header('Location: /edsa-s-report/authentification.php');
    }
