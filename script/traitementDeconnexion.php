<?php
    session_start();
    session_destroy();
    header('Location: /edsa-s-report/authentification.php');