<?php
    include_once 'includes/bdd.php';
    include_once 'includes/header.php';
    $client = $_GET['client'];
    $date = $_GET['date'];
    $req = "SELECT *
            FROM context";
    $res = $pdo->query($req);
    $context = $res->fetchAll();
?>
    <div class="container-fluid">
        <div class="row">
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
        </div>
        <form action="" method="post">
            <section id="service">


            </section>
            <button id="btnAdd" class="hidden btn btn-primary btn-position">Valider</button>
            <a href="index.php">
                <button id="btnCancel" class="btn btn-primary btn-position">Annuler</button>
            </a>
        </form>


    </div>
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
                xmlHttp.open("post", "script/traitementService.php");
                xmlHttp.send(formData);
            }
        }
    </script>
<?php
    include_once 'includes/footer.php';
