<?php
    /** @var PDO $pdo */
//    set_time_limit(600);
    $stats = true;
    include_once 'includes/header.php';
    if (isset($user)) {
        include_once 'includes/bdd.php';
        $req = "SELECT DISTINCT DATE_FORMAT(date,'%Y')
              FROM service ORDER BY DATE_FORMAT(date,'%Y') ASC";
        $res = $pdo->query($req);
        $year = $res->fetchAll();
        $yearGet = isset($_GET['date']) ? $_GET['date'] : date("Y");
        if (isset($_GET['radio'])) {
            $radio = $_GET['radio'];
            $req = "SELECT * FROM category WHERE is_actived = 1";
            $res = $pdo->query($req);
            $categories = $res->fetchAll();
            $month = [
                1 => "jan",
                2 => "fév",
                3 => "mar",
                4 => "avr",
                5 => "mai",
                6 => "juin",
                7 => "juil",
                8 => "août",
                9 => "sep",
                10 => "oct",
                11 => "nov",
                12 => "déc"
            ];
            $totalMonth = [];
            $total = 0;
            $totalVol = 0;
            $totalEcart = 0;
            $currentMonth = (int)date("m");
        }

        ?>
        <center>
            <section class="background-home">
                <br>
                <div class="container-fluid">
                    <form action="" method="get">
                        <div class="row">
                            <div class="col-3"></div>
                            <div class="col-2">
                                <select class="btn-round select-space form-control" name="date">
                                    <?php for ($i = 0; $i < count($year); $i++) {
                                        ?>
                                        <option <?php if ($yearGet == $year[$i][0]) { ?> selected <?php } ?> ><?php echo $year[$i][0] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-2">
                                <label class="select-space  checkbox-inline"><input name="radio" type="radio" checked
                                                                                    value="Synthétique">
                                    Synthétique</label>
                            </div>
                            <div class="col-2">
                                <label class="select-space  checkbox-inline"><input name="radio" type="radio"
                                                                                    value="Complet"> Complet</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-blue btn-round btn-index">VISUALISER</button>
                    </form>
                    <br>
            </section>
            <br>
            <br>
            <?php if (isset($yearGet) && $radio == "Complet") {
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
                for ($j = 0; $j < count($context); $j++) {
                    $nameContext = $context[$j]['name'];
                    $idContext = $context[$j]['id'];
                    $req = "SELECT *
        FROM category
        WHERE is_actived = 1
        AND context_id = $idContext ";
                    $res = $pdo->query($req);
                    $categories = $res->fetchAll();
                    $totalMonth = [];
                    $total = 0;
                    $totalVol = [];
                    ?>
                    <br>
                    <H4><?php echo $nameContext ?></H4>
                    <br>
                    <table class="table table-striped  w-50">
                        <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col" style="text-align: center;" colspan="15"><?php echo $yearGet ?></th>
                            <th scope="col" style="text-align: center;" colspan="3"><?php echo $yearGet - 1 ?></th>
                        </tr>
                        <tr>
                            <th scope="col"></th>
                            <?php foreach ($month as $value) { ?>
                                <th class="table-background" scope="col"><?php echo $value ?></th>
                            <?php } ?>
                            <th class="table-background" scope="col"></th>
                            <th class="table-background" scope="col">total</th>
                            <th class="table-background" scope="col">proj.</th>
                            <th class="table-background" scope="col"></th>
                            <th class="table-background" scope="col">vol.</th>
                            <th class="table-background" scope="col">écarts</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php for ($i = 0; $i < count($categories); $i++) {
                            $categoryIds = $categories[$i]['id'];
                            $req = "SELECT * FROM entity where is_actived = 1 AND category_id = $categoryIds";
                            $res = $pdo->query($req);
                            $entities = $res->fetchAll();
                            $sousTotalMonth = [];
                            $sousTotalCategory = 0;
                            $volCategory = [];
                            $ecartCategory = 0;
                            ?>
                            <tr>
                                <th class="table-background">
                                    <?php echo $categories[$i]['name'] ?>
                                </th>
                                <td colspan="18"></td>
                            </tr>
                            <?php for ($n = 0; $n < count($entities); $n++) {
                                $sousTotalEntity = 0;
                                $ecartEntity = 0;
                                $value = [];
                                $volEntity = [];
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $entities[$n]['name'] ?>
                                    </td>

                                    <?php
                                        for ($b = 1; $b <= count($month); $b++) {
                                            if (date("Y") == $yearGet && $b > $currentMonth) {
                                                $value[$j][$i][$n][$b] = 0;
                                            } else {
                                                $value[$j][$i][$n][$b] = rand(0, 10);
                                            }
                                            $sousTotalEntity += $value[$j][$i][$n][$b];
                                            $projectionEntity = ($sousTotalEntity / $currentMonth) * 12;
                                            $volEntity[$j][$i][$n] = $projectionEntity + random_int(-2, 5);
                                            $ecartEntity = $projectionEntity - $volEntity[$j][$i][$n];
                                            $sousTotalMonth[$j][$i][$b] += $value[$j][$i][$n][$b];

                                            ?>
                                            <td><?php echo $value[$j][$i][$n][$b] ?></td>
                                        <?php }
                                        $volCategory[$j][$i] += $volEntity[$j][$i][$n];
                                    ?>
                                    <td></td>
                                    <td><?php echo $sousTotalEntity; ?></td>
                                    <?php if (date("Y") == $yearGet) { ?>
                                        <td><?php echo $projectionEntity; ?></td>
                                    <?php } else { ?>
                                        <td><?php echo $sousTotalEntity; ?></td>
                                    <?php } ?>
                                    <td></td>
                                    <td><?php echo $volEntity[$j][$i][$n]; ?></td>
                                    <td><?php echo $ecartEntity; ?></td>
                                </tr>

                            <?php }
                            ?>
                            <tr>
                                <td style="color: gray">
                                    Sous-total
                                </td>
                                <?php for ($b = 1; $b <= count($month); $b++) {
                                    $sousTotalCategory += $sousTotalMonth[$j][$i][$b];

                                    $projectionSousTotal = ($sousTotalCategory / $currentMonth) * 12;
                                    $ecartCategory = $projectionSousTotal - $volCategory[$j][$i];
                                    $totalMonth[$j][$b] += $sousTotalMonth[$j][$i][$b];
                                    ?>
                                    <td><?php echo $sousTotalMonth[$j][$i][$b] ?></td>
                                <?php } $totalVol[$j] += $volCategory[$j][$i];
                                ?>
                                <td></td>
                                <td><?php echo $sousTotalCategory ?></td>
                                <?php if (date("Y") == $yearGet) { ?>
                                    <td><?php echo $projectionSousTotal; ?></td>
                                <?php } else { ?>
                                    <td><?php echo $sousTotalCategory; ?></td>
                                <?php } ?>
                                <td></td>
                                <td><?php echo $volCategory[$j][$i] ?></td>
                                <td><?php echo $ecartCategory ?></td>

                            </tr>
                        <?php }
                        ?>
                        <tr>
                            <td class="bold">
                                Total
                            </td>
                            <?php for ($b = 1; $b <= count($month); $b++) {
                                $total += $totalMonth[$j][$b];
                                $projectionTotal = ($total / $currentMonth) * 12;
                                $totalEcart = $projectionTotal - $totalVol[$j];
                                ?>
                                <td><?php echo $totalMonth[$j][$b] ?></td>
                            <?php } ?>
                            <td></td>
                            <td><?php echo $total; ?></td>
                            <?php if (date("Y") == $yearGet) { ?>
                                <td><?php echo $projectionTotal; ?></td>
                            <?php } else { ?>
                                <td><?php echo $total; ?></td>
                            <?php } ?>
                            <td></td>
                            <td><?php echo $totalVol[$j] ?></td>
                            <td><?php echo $totalEcart ?></td>
                        </tr>
                        </tbody>
                    </table>
                <?php }
            } else
                if (isset($yearGet) && $radio == "Synthétique") {
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
                    for ($j = 0; $j < count($context); $j++) {
                        $nameContext = $context[$j]['name'];
                        $idContext = $context[$j]['id'];
                        $req = "SELECT *
        FROM category
        WHERE is_actived = 1
        AND context_id = $idContext ";
                        $res = $pdo->query($req);
                        $categories = $res->fetchAll();
                        $volCategory = [];
                        $total = [];
                        $totalMonth = [];
                        ?>
                        <br>
                        <H4><?php echo $nameContext ?></H4>
                        <br>
                        <table class="table table-striped  w-50">
                            <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col" style="text-align: center;" colspan="15"><?php echo $yearGet ?></th>
                                <th scope="col" style="text-align: center;" colspan="3"><?php echo $yearGet - 1 ?></th>
                            </tr>
                            <tr>
                                <th scope="col"></th>
                                <?php foreach ($month as $value) { ?>
                                    <th class="table-background" scope="col"><?php echo $value ?></th>
                                <?php } ?>
                                <th class="table-background" scope="col"></th>
                                <th class="table-background" scope="col">total</th>
                                <th class="table-background" scope="col">proj.</th>
                                <th class="table-background" scope="col"></th>
                                <th class="table-background" scope="col">vol.</th>
                                <th class="table-background" scope="col">écarts</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                for ($i = 0;
                                     $i < count($categories);
                                     $i++) {
                                    $sousTotalCategory = 0;
                                    $ecartCategory = 0;
                                    $value = [];
                                    ?>
                                    <tr>
                                        <th class="table-background">
                                            <?php echo $categories[$i]['name'] ?>
                                        </th>
                                        <td colspan="18"></td>
                                    </tr>
                                    <tr>
                                        <td style="color: gray">
                                            sous-total
                                        </td>
                                        <?php
                                            for ($b = 1; $b <= count($month); $b++) {

                                                if (date("Y") == $yearGet && $b > $currentMonth) {
                                                    $value[$j][$i][$b] = 0;
                                                } else {
                                                    $value[$j][$i][$b] = rand(0, 10);
                                                }
                                                $sousTotalCategory += $value[$j][$i][$b];
                                                $projectionCategory = ($sousTotalCategory / $currentMonth) * 12;
                                                $volCategory[$j][$i] = $projectionCategory + random_int(-2, 5);
                                                $ecartCategory = $projectionCategory - $volCategory[$j][$i];
                                                if (!array_key_exists($j, $totalMonth)) {
                                                    $totalMonth[$j][$b] = $value[$j][$i][$b];
                                                } else {
                                                    $totalMonth[$j][$b] = $totalMonth[$j][$b] + $value[$j][$i][$b];
                                                }
                                                ?>
                                                <td><?php echo $value[$j][$i][$b]; ?></td>
                                            <?php } ?>
                                        <td></td>
                                        <td><?php echo $sousTotalCategory; ?></td>
                                        <?php if (date("Y") == $yearGet) { ?>
                                            <td><?php echo $projectionCategory; ?></td>
                                        <?php } else { ?>
                                            <td><?php echo $sousTotalCategory; ?></td>
                                        <?php } ?>
                                        <td></td>
                                        <td><?php echo $volCategory[$j][$i]; ?></td>
                                        <td><?php echo $ecartCategory; ?></td>
                                    </tr>
                                <?php } ?>
                            <tr>
                                <td class="bold">
                                    Total
                                </td>
                                <?php
                                    for ($b = 1; $b <= count($month); $b++) {
                                        $total[$j] += $totalMonth[$j][$b];


                                        $projectionTotal = ($total[$j] / $currentMonth) * 12;
                                        $totalVol = array_sum($volCategory[$j]);
                                        $totalEcart = $projectionTotal - $totalVol;
                                        ?>
                                        <td><?php echo $totalMonth[$j][$b]; ?></td>
                                    <?php } ?>
                                <td></td>
                                <td><?php echo $total[$j]; ?></td>
                                <?php if (date("Y") == $yearGet) { ?>
                                    <td><?php echo $projectionTotal; ?></td>
                                <?php } else { ?>
                                    <td><?php echo $total[$j]; ?></td>
                                <?php } ?>
                                <td></td>
                                <td><?php echo $totalVol ?></td>
                                <td><?php echo $totalEcart ?></td>
                            </tr>
                            </tbody>
                        </table>
                    <?php }
                } ?>
        </center>
        <?php
        include_once 'includes/footer.php';
    } else {
        header('Location: /authentification.php');
    }
