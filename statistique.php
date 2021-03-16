<?php
    set_time_limit(600);
    $stats = true;
    include_once 'includes/header.php';
    if (isset($user)) {
        include_once 'includes/bdd.php';
        $req = "SELECT DISTINCT DATE_FORMAT(date,'%Y')
              FROM service ORDER BY DATE_FORMAT(date,'%Y') ASC";
        $res = $pdo->query($req);
        $year = $res->fetchAll();
        if (isset($_GET['date'])) {
            $yearGet = $_GET['date'];
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
        }
        ?>
        <br>
        <br>
        <br>
        <center>
            <form method="get" action="">
                <div class="col-2">
                    <select class="form-control" name="date">
                        <?php for ($i = 0; $i < count($year); $i++) {
                            ?>
                            <option><?php if (isset($yearGet)) {
                                    echo $yearGet;
                                } else {
                                    echo $year[$i][0];
                                } ?></option>
                        <?php } ?>
                    </select>
                    <br>
                    <button class="btn btn-primary" type="submit">Valider</button>
                </div>
            </form>


            <?php if (isset($yearGet)) { ?>
                <br>
                <table class="table table-bordered w-50">
                    <thead>
                    <tr>
                        <th style="text-align: center;" colspan="19"><H4>Interventions</H4></th>
                    </tr>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col" style="text-align: center;" colspan="15"><?php echo $yearGet ?></th>
                        <th scope="col" style="text-align: center;" colspan="3"><?php echo $yearGet - 1 ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="col"></th>
                        <?php foreach ($month as $value) { ?>
                            <th scope="col"><?php echo $value ?></th>
                        <?php } ?>
                        <th scope="col"></th>
                        <th scope="col">total</th>
                        <th scope="col">proj.</th>
                        <th scope="col"></th>
                        <th scope="col">vol.</th>
                        <th scope="col">écarts</th>
                    </tr>
                    <?php for ($i = 0; $i < count($categories); $i++) {
                        $categoryIds = $categories[$i]['id'];
                        $req = "SELECT * FROM entity where is_actived = 1 AND category_id = $categoryIds";
                        $res = $pdo->query($req);
                        $entities = $res->fetchAll();
                        ?>
                        <tr>
                            <th>
                                <?php echo $categories[$i]['name'] ?>
                            </th>
                            <td colspan="18"></td>
                        </tr>
                        <?php for ($n = 0; $n < count($entities); $n++) {
                            $totalEntity = 0;
                            $projEntity =0;
                            $vol = 0;
                            $totalEcart =0;
                            ?>
                            <tr>
                                <td>
                                    <?php echo $entities[$n]['name'] ?>
                                </td>

                                <?php for ($b = 1; $b <= count($month); $b++) {
                                    $value = rand(5, 200);
                                    $totalEntity += $value;
                                    $projEntity += $totalEntity;
                                    $vol += rand($totalEntity,800);
                                    $ecart = $projEntity - $vol;

                                    ?>
                                    <td><?php echo $value; ?></td>
                                <?php } ?>
                                <td></td>
                                <td><?php echo $totalEntity; ?></td>
                                <td><?php echo $projEntity; ?></td>
                                <td></td>
                                <td><?php echo $vol; ?></td>
                                <td><?php echo $ecart; ?></td>
                            </tr>

                        <?php }
                        ?>
                        <tr>
                            <td style="color: gray">
                                Sous-total
                            </td>
                            <?php for ($b = 1; $b <= count($month); $b++) {
                                $value = rand(100, 300);
                                $totalEntity += $value;
                                $projEntity += $totalEntity;
                                $vol += rand($totalEntity,800);
                                $totalEcart += $ecart;
                                ?>
                                <td><?php echo $value; ?></td>
                            <?php } ?>
                            <td></td>
                            <td><?php echo $totalEntity; ?></td>
                            <td><?php echo $projEntity; ?></td>
                            <td></td>
                            <td><?php echo $vol; ?></td>
                            <td><?php echo $totalEcart; ?></td>

                        </tr>
                    <?php } ?>
                    <tr>
                        <td>
                           Total
                        </td>
                        <?php for ($b = 1; $b <= count($month); $b++) {
                            $value = rand(700, 1200);
                            $totalEntity += $value;
                            $projEntity += $totalEntity;
                            $vol += rand($totalEntity,800);
                            $totalEcart += $ecart;
                            ?>
                            <td><?php echo $value; ?></td>
                        <?php } ?>
                        <td></td>
                        <td><?php echo $totalEntity; ?></td>
                        <td><?php echo $projEntity; ?></td>
                        <td></td>
                        <td><?php echo $vol; ?></td>
                        <td><?php echo $totalEcart; ?></td>
                    </tr>
                    </tbody>
                </table>
            <?php } ?>
        </center>
        <?php
        include_once 'includes/footer.php';
    } else {
        header('Location: /edsa-s-report/authentification.php');
    }
