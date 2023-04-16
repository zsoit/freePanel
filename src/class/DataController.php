<?php
namespace freePanel\Controller;

class DataController
{
    public static function fetchPOST($post)
    {
        return (isset($_POST[$post])) ? $_POST[$post] : null;
    }

    public static function fetchGET($get)
    {
        return  (isset($_GET[$get])) ?  $_GET[$get] :  null ;
    }

    public static function setDomain()
    {
        $domain = DataController::fetchPOST('domain');
        $user = DataController::fetchPOST('user');

        if ($domain == PRIMARY_DOMAIN) $domain = $user . "." . $domain;

        return $domain;
    }

    public static function getCurrentDate()
    {
        return date('Y-m-d');
    }
}