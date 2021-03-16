<?php
    function convertDate($stringDateFr, $format)
    {
        $date = explode("/", $stringDateFr);
        return sprintf($format, $date[2], $date[1], $date[0]);
    }