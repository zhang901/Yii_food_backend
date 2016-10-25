<?php
/**
 * Created by Lorge 
 *
 * User: Only Love.
 * Date: 12/15/13 - 1:11 PM
 */

class StringUtils {
    /**
     * Subtract a string with the limited length
     *
     * @param string $str the original string that need to subtract
     * @param int $length the length of word after subtraction
     * @param bool $isSemicolon the semicolon is used or not
     * @param bool $isSubWord the string will be subtracted by words or characters
     * @return string the string after subtraction is executed
     */
    public static function subString($str = "", $length = null, $isSemicolon = false, $isSubWord = false){
        $charset = 'UTF-8';
        $str = trim($str);
        if(empty($length) || !is_numeric($length) || $length >= strlen($str)) return $str;
        if($isSubWord){
            if(strpos($str, ' ') > $length){
                return $isSemicolon ? mb_substr($str, 0, $length, $charset) . '...' : mb_substr($str, 0, $length, $charset);
            }else{
                $wrappedText = wordwrap($str, $length, "\n");
                echo $isSemicolon ? mb_substr($wrappedText, 0, strpos($wrappedText, "\n"), $charset) . '...' : mb_substr($wrappedText, 0, strpos($wrappedText, "\n"), $charset);
            }
        }else{
            return $isSemicolon ? mb_substr($str, 0, $length, $charset) . '...' : mb_substr($str, 0, $length, $charset);
        }
    }

    /**
     * @param string $str the value need to hash
     * @return string the value after hash
     */
    public static function hashStr($str){
        return sha1($str);
    }

    /**
     * @param string $property this property need to check null(isset), then return empty
     * @return string return value of property of empty string
     */
    public static function viewProperty($property){
        return !empty($property) ? $property : '';
    }

    public static function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    public static function generateGUID() {
        $s = strtoupper(md5(uniqid(rand(),true)));
        $guidText = substr($s,0,8) . '-' .
            substr($s,8,4) . '-' .
            substr($s,12,4) . '-' .
            substr($s,16,4) . '-' .
            substr($s,20);
        return $guidText;
    }
}