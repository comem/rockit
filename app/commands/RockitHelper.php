<?php

class RockitHelper {

    /**
     * Function to return the number of whole days until the value inserted.
     * It's always calculated from 00:00:00 and also the inserted time value
     * is reset to 00:00:00. So time does not change anything.
     * @param int $time unix timestamp
     * @return int days until inserted value
     */
    public static function countDaysUntil($time) {
        $today = floor(time() / 60 / 60 / 24);
        $difference = floor($time / 60 / 60 / 24) - $today;
        return $difference;
    }
    /**
     * Function to replace double whitespace with a single whitespace,
     * it matches with the following regex pattern: /\s\s(\d\.)/ and keeps
     * the date. with a single whitespace.
     *
     * @param string $date a date as a string formatted with strftime
     * @return type
     */
    public static function deleteDoubleWhitspace($date) {
        $date = preg_replace("/\s\s(\d\.)/", " $1", $date);
        return $date;
    }
}    