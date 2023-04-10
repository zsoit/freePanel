<?php
class DataController
{

    public function setPOST($name)
    {
        if(isset($_POST[$name])) return $_POST[$name];
        else return null;
    }


    public function setDomain()
    {
        $domain = $this->setPOST('domain');
        $user = $this->setPOST('user');

        if($domain == PRIMARY_DOMAIN) $domain = $user . "." . $domain;

        return $domain;

    }

    public function getCurrentDate() {
        return date('Y-m-d');
    }


}