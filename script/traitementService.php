<?php
    include '../includes/bdd.php';

    if (isset($_POST['datum'])) {
        $datum = $_POST['datum'];
        $req = "SELECT *
                FROM category
                WHERE is_actived = 1
                AND context_id = $datum";
        $res = $pdo->query($req);
        $categories = $res->fetchAll();
        for ($i = 0; $i < count($categories); $i++) {
            $idCategories = $categories[$i]['id'];
            $req = "SELECT *
                FROM entity
                WHERE is_actived = 1
                AND category_id = $idCategories;";
            $res = $pdo->query($req);
            $entities[$i] = $res->fetchAll();
            $nameCategories = $categories[$i]['name'];

            $fieldset1 = '<div class="container-fluid">
	<div class="col-md-12">
	    <form class="form-horizontal form-label-left"> 
	    <legend class="custom-border">' . $nameCategories . '</legend>
            <fieldset class="custom-border">
                <div class="form-group">
                    <div class="row">
        ';
            $fieldset2 = null;
            for ($n = 0; $n < count($entities[$i]); $n++) {
                $nameEntities = $entities[$i][$n]['name'];
                $fieldset2[$n] = '
                    <div class="col-md-3">
                        <label>' . $nameEntities . '</label>
                        <input type="number" class="form-control" required>
                    </div>
                ';
            }
            $fieldset3 = '</div></div>
            </fieldset></form>
	</div>
</div>';
            $fieldset[$i] = $fieldset1 . implode(' ', $fieldset2) . $fieldset3;
            echo $fieldset[$i];
        }
    }
