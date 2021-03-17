<?php
    include_once 'includes/functions.php';
    /** @var PDO $pdo */
    $accueil = true;
    include_once 'includes/header.php';
    if (isset($user)) {
        include_once 'includes/bdd.php';
        $req = "SELECT * FROM client";
        $res = $pdo->query($req);
        $client = $res->fetchAll();

        $idGetClient = null;
        $date_from = null;
        $date_to = null;
        $page = 1;
        $a_paramQuerry = [
            "idClient" => $idGetClient,
            "date_from" => $date_from,
            "date_to" => $date_to,
        ];
        $query = [];
        $query2 = [];
        $query[] = "SELECT s.*, c.name FROM service s JOIN client c ON s.client_id = c.id";
        $query2[] = "SELECT COUNT(s.id) AS total FROM service s JOIN client c ON s.client_id = c.id";

        if (isset($_GET['idClient']) && !empty($_GET['idClient'])) {
            $idGetClient = $_GET['idClient'];
            $a_paramQuerry["idClient"] = $_GET['idClient'];
            $query["where"] = "WHERE s.client_id = $idGetClient";
            $query2["where"] = "WHERE s.client_id = $idGetClient";
        }

        if (isset($_GET['date_from']) && !empty($_GET['date_from'])) {
            if (!isset($_GET['page'])) {
                $date = $_GET['date_from'];
                $date_from = convertDate($date, '%s-%s-%s');
            } else {
                $date_from = $_GET['date_from'];
            }


            $a_paramQuerry["date_from"] = $date_from;
            if (array_key_exists("where", $query)) {
                $query[] = "AND s.date >= '$date_from'";
                $query2[] = "AND s.date >= '$date_from'";
            } else {
                $query["where"] = "WHERE s.date >= '$date_from'";
                $query2["where"] = "WHERE s.date >= '$date_from'";

            }
        }
        if (isset($_GET['date_to']) && !empty($_GET['date_to'])) {
            if (!isset($_GET['page'])) {
                $date = $_GET['date_to'];
                $date_to = convertDate($date, '%s-%s-%s');
            } else {
                $date_to = $_GET['date_to'];
            }

            $a_paramQuerry["date_to"] = $date_to;
            if (array_key_exists("where", $query)) {
                $query[] = "AND s.date <= '$date_to'";
                $query2[] = "AND s.date <= '$date_to' ";
            } else {
                $query["where"] = "WHERE s.date <= '$date_to'";
                $query2["where"] = "WHERE s.date <= '$date_to'";
            }
        }

        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $page = $_GET['page'];
        }
        $totalElement = (int)$pdo->query(implode(" ", $query2))->fetchColumn();
        $nbPage = ceil($totalElement / 15);
        $premier = ($page * 15) - 15;
        $query[] = "LIMIT $premier, 15";
        $res = $pdo->query(implode(" ", $query));
        $service = $res->fetchAll();
        ?>
        <center>
            <section class="background-home">
                <br>
                <div class="container-fluid">
                    <form action="" method="get">
                        <div class="row">
                            <div class="col-3"></div>
                            <div class="col-2">
                                <select name="idClient" class="btn-round select-space form-control">
                                    <option value="" selected>
                                        Choisir un bénéficiaire
                                    </option>
                                    <?php
                                        for ($i = 0; $i < count($client); $i++) {
                                            $idClient = $client[$i]['id'];
                                            $nameClient = $client[$i]['name'];
                                            ?>
                                            <option value="<?php echo $idClient ?>"><?php echo $nameClient ?></option>
                                        <?php } ?>
                                </select>
                            </div>
                            <div class="col-2">
                                <input autocomplete="off" name="date_from" placeholder="Date de début"
                                       class="select-space btn-round form-control datepicker" type="text">
                            </div>
                            <div class="col-2">
                                <input autocomplete="off" name="date_to" placeholder="Date de fin"
                                       class="select-space btn-round form-control datepicker" type="text">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-blue btn-round btn-index">RECHERCHER</button>
                    </form>
                    <br>
            </section>
            <br>
            <br>
            <?php if (isset($_GET['client']) || isset($_GET['date_from']) || isset($_GET['date_to']) || isset($_GET['page'])) { ?>
                <table class="table table-striped w-50">
                    <thead class="table-blue bold">
                    <tr>
                        <td width="1%">id</td>
                        <td width="5%">Date</td>
                        <td width="20%">Bénéficiaire</td>
                        <td width="1%">Modifier</td>
                        <td width="1%;">Supprimer</td>

                    </tr>

                    </thead>
                    <tbody>
                    <?php for ($i = 0; $i < count($service); $i++) {
                        ?>
                        <tr class="table-text">
                            <td class="bold">
                                <?php
                                    echo $service[$i]['id'];
                                ?>
                            </td>
                            <td class="bold">
                                <?php
                                    $date = new DateTime($service[$i]['date']);

                                ?>
                                <?php echo $date->format('d/m/Y') ?>
                            </td>
                            <td class="bold">
                                <?php
                                    echo $service[$i]['name'];
                                ?>
                            </td>
                            <td>
                                <a href="updateService.php?id=<?php echo $service[$i]['id'] ?>">
                                    <i class="size-table fas fa-pen-square"></i>
                                </a>
                            </td>
                            <td>
                                <a href="script/traitementDeleteService.php?id=<?php echo $service[$i]['id'] ?>">
                                    <i class="size-table fas fa-trash"></i>
                                </a>
                            </td>

                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <br>
                <?php
                if ($nbPage != 1) {

                    $link_pagination = "/index.php?";

                    ?>
                    <div id="demo" class="pagination">
                        <?php
                            $pageRetour = $page - 1;
                            $pageSuivant = $page + 1;
                        ?>

                        <a href="<?php
                            echo $link_pagination . http_build_query($a_paramQuerry) . "&page=1" ?>">
                            <button class="btn btn-pagination">Premier</button>
                        </a>
                        <a href="<?php
                            echo $link_pagination . http_build_query($a_paramQuerry) . "&page=" . $pageRetour ?>">&laquo;</a>
                        <?php if ($nbPage > 10) { ?>
                            <?php for ($i = 1; $i < 11; $i++) {
                                if ($page != 1) {
                                    if ($page <= $nbPage) {
                                        ?>
                                        <a href="<?php echo $link_pagination . http_build_query($a_paramQuerry) . "&page=" . $page ?>" <?php if ($i == 1) { ?> class="active" <?php } ?>><?php echo $page ?></a>
                                        <?php
                                        $page++;
                                    }
                                } else {
                                    ?>
                                    <a href="<?php echo $link_pagination . http_build_query($a_paramQuerry) . "&page=" . $i ?>" <?php if ($page == $i) { ?> class="active" <?php } ?>><?php echo $i ?></a>
                                <?php }
                            }
                        } else { ?>
                            <?php for ($i = 1; $i <= $nbPage; $i++) {
                                ?>
                                <a href="<?php echo $link_pagination . http_build_query($a_paramQuerry) . "&page=" . $i ?>" <?php if ($page == $i) { ?> class="active" <?php } ?>><?php echo $i ?></a>
                            <?php }
                        } ?>
                        <a href="<?php
                            echo $link_pagination . http_build_query($a_paramQuerry) . "&page=" . $pageSuivant ?>">&raquo;</a>
                        <a href="<?php
                            echo $link_pagination . http_build_query($a_paramQuerry) . "&page=" . $nbPage ?>">
                            <button class="btn btn-pagination">Dernier</button>
                        </a>
                    </div>
                <?php }
            } ?>
            <br>
            <a href="ajouterService.php">
                <button class="btn btn-pink btn-round btn-index">NOUVELLE PRESTATION</button>
            </a>
            <br>

            <br>
        </center>
        </div>
        <?php
        include_once 'includes/footer.php';
    } else {
        header('Location: /authentification.php');
    }
