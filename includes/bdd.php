<?php
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=s-report;port=3306;charset=utf8", "root");
    } catch (Exception $ex) {
        echo "<div>Une erreur est survenue : <div><code>$ex</code></div></div>";
        $pdo = null;
    }