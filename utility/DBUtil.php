<?php

/**
 * Description of DBUtil
 *
 * @author Handi
 */
class DBUtil {
    public static function createPDOConnection() {
        $link = new PDO("mysql:host=localhost;dbname=ExpenseTrackerDB","root","");
        $link->setAttribute(PDO::ATTR_AUTOCOMMIT, FALSE);
        $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $link;
    }
    public static function closePDOConnection($link) {
        if(isset($link))
        {
            $link=NULL;
        }
    }
}
