<?php
/**
 * Created by Lorge 
 *
 * User: Only Love.
 * Date: 12/16/13 - 2:41 AM
 */

class DateTimeUtils {
    const FULL_DATETIME = 'Y-m-d H:i:s';
    const YMD_DATETIME = 'Y-m-d';

    /**
     * Get datetime now
     *
     * @param string $format the format of result
     * @return bool|string the datetime at the moment
     */
    public static function now($format = self::FULL_DATETIME){
        return date($format, time());
    }

    /**
     * Get datetime now string
     *
     * @return int the datetime at the moment
     */
    public static function nowStr(){
        return time();
    }

    /**
     * Get datetime now
     *
     * @param string $format the format of result
     * @param string $date the date need to convert
     * @return bool|string the datetime at the moment
     */
    public static function date2String($date, $format = self::FULL_DATETIME){
        return date($format, $date);
    }
}