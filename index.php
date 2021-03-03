<?php
    include_once 'includes/header.php';
?>
    <center>
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
                    <input name="client" type="text" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-4"></div>
                <div class="col-1">
                    <p>Date</p>
                </div>
                <div class="col-2">
                    <input name="date" type="date" class="form-control" required>
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
