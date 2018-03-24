<?php

class DateManager {

    public static function convertThaiYear($date) {
        $day = date("j", strtotime($date));
        $month = date("n", strtotime($date));
        $year = date("Y", strtotime($date)) + 543;
        $newDate = $day . '/' . $month . '/' . $year;
        return $newDate;
    }

}