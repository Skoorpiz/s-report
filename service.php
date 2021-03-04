<?php
    include_once 'includes/bdd.php';
    include_once 'includes/header.php';
    $client = $_GET['client'];
    $date_from = $_GET['date_from'];
    $date_to = $_GET['date_to'];
    $req = "SELECT *
            FROM context";
    $res = $pdo->query($req);
    $context = $res->fetchAll();
?>
    <center>
    <div class="container-fluid">
            <div class="col-3 select-position">
                <select onchange="printValue(this.value)" class="form-control">
                    <option value="selected" selected>Choisir un contexte</option>
                    <?php
                        for ($i = 0; $i < count($context); $i++) {
                            ?>
                            <option value="<?php echo $context[$i]['id'] ?>"><?php echo $context[$i]['name'] ?></option>
                        <?php } ?>
                </select>
            </div>
        <form action="script/traitementInsertService.php" method="post">
            <input type="hidden" name="client" value="<?php echo $client ?>">
            <input type="hidden" name="date_to" value="<?php echo $date_to ?>">
            <input type="hidden" name="date_from" value="<?php echo $date_from ?>">
            <section id="service">


            </section>
            <button id="btnAdd" class="hidden btn btn-primary ">Valider</button>
            <a href="index.php">
                <button id="btnCancel" class="btn btn-primary ">Annuler</button>
            </a>
        </form>
    </div>
    </center>
    <script>
        function printValue(val) {
            if (val == "selected") {

            } else {
                document.getElementById("btnAdd").classList.remove("hidden");
                var formData = new FormData();
                formData.append('datum', val);
                var xmlHttp = new XMLHttpRequest();
                xmlHttp.onreadystatechange = function () {
                    if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                        document.getElementById("service").innerHTML = xmlHttp.responseText;
                        console.log(xmlHttp.responseText);
                    }
                }
                xmlHttp.open("post", "script/traitementAfficherService.php");
                xmlHttp.send(formData);
            }
        }
    </script>
<?php
    include_once 'includes/footer.php';
