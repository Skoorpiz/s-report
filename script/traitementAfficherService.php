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
        $b = 0;
        for ($i = 0; $i < count($categories); $i++) {
            $idCategories = $categories[$i]['id'];
            $req = "SELECT *
                FROM entity
                WHERE is_actived = 1
                AND category_id = $idCategories;";
            $res = $pdo->query($req);
            $entities[$i] = $res->fetchAll();
            $nameCategories = $categories[$i]['name'];

            $fieldset1 = '
	<div class="col-6">	    
	    <legend class="custom-border">' . $nameCategories . '</legend>
            <fieldset class="custom-border">
                <div class="form-group">
                    <div class="row entities">
        ';
            $fieldset2 = null;
            for ($n = 0; $n < count($entities[$i]); $n++) {
                $b++;
                $nameEntities = $entities[$i][$n]['name'];
                $fieldset2[$n] = '
                    <div class="col-2">
                        <label>' . $nameEntities . '</label>
                                            </div>
                    <div class="col-1">
                        <input style="width: 50px;" name ="' . $b . '" value="0" class="form-control form-input" required>
                        </div>
                ';
            }
            $fieldset3 = '</div></div>
            </fieldset>
	</div>';
            $fieldset[$i] = $fieldset1 . implode(' ', $fieldset2) . $fieldset3;
            echo $fieldset[$i];
        }
    }
