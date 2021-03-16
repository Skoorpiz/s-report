<?php
    include_once 'includes/header.php';
    if (isset($user)) {
        include_once 'includes/bdd.php';
$year = 2018;
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
        for($i=0;$i<100;$i++){
        for ($b = 1; $b <= count($month); $b++) {
            $req = "SELECT SUM(value) 
                                        FROM detail_service 
                                        WHERE service_id IN
                                        (SELECT id 
                                        FROM service 
                                        WHERE DATE_FORMAT(date,'%Y') = $year
                                        AND DATE_FORMAT(date,'%m') = $b)";
            $res = $pdo->query($req);
            $total = $res->fetchColumn();
            echo $total;
            echo"<br>";
        }
        }
        include_once 'includes/footer.php';
    } else {
        header('Location: /authentification.php');
    }
