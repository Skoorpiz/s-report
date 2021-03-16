<?php
    try {
        $pdo = new PDO("mysql:host=192.168.0.210;dbname=s-report;port=3306;charset=utf8", "root","root");
    } catch (Exception $ex) {
        echo "<div>Une erreur est survenue : <div><code>$ex</code></div></div>";
        $pdo = null;
    }