<?php
    include_once 'includes/header.php';
    include_once 'includes/bdd.php';
    $req = "SELECT * FROM client";
    $res = $pdo->query($req);
    $client = $res->fetchAll();
?>
    <center>
        <br>
        <H2>Accueil</H2>
    </center>
    <form action="service.php" method="get">
        <div class="container-fluid">
            <div class="row">
                <div class="col-4"></div>
                <div class="col-1">
                    <p>Client</p>
                </div>
                <div class="col-2">
                    <select name="client" class="form-control" required>
                        <option selected>Choisir un client</option>
                        <?php
                            for ($i = 0; $i < count($client); $i++) {
                                ?>
                                <option value="<?php echo $client[$i]['id'] ?>"><?php echo $client[$i]['name'] ?></option>
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
                    <button class="btn btn-primary btn-index">Ajouter</button>
                </div>
            </div>

        </div>
    </form>
<?php
    include_once 'includes/footer.php';
