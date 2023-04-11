<?php
class DataController
{

    public function setPOST($name)
    {
        if (isset($_POST[$name])) return $_POST[$name];
        else return null;
    }


    public function setDomain()
    {
        $domain = $this->setPOST('domain');
        $user = $this->setPOST('user');

        if ($domain == PRIMARY_DOMAIN) $domain = $user . "." . $domain;

        return $domain;
    }

    public function getRAM()
    {
        $cmd = `free -m | grep "^Mem:" | awk '{print $2"MB"}'`;
        return shell_exec($cmd);
    }

    public function getCurrentDate()
    {
        return date('Y-m-d');
    }

    private function getDisk($output)
    {
        $cmd = "df -h --output=$output | awk 'NR==2 { print $1 }' | sed 's/G$//'";
        return shell_exec($cmd);
    }


    public function getSizeFolder($folder)
    {
        $cmd = <<<BASH
        du -sm $folder | awk '{print $1"MB"}'
        BASH;
        return shell_exec($cmd);
    }

    public function getInfoDisk()
    {
        $space = $this->getDisk("size");
        $usage = $this->getDisk("avail");
        $free = $this->getDisk("used");

        $result = "Disk SSD: $usage / $space GB (Free $free GB)";

        return $result;
    }

    public function getInfoFolder(){
        $www = $this->getSizeFolder("/www");

        $result = "Disk usage of all WWW: $www";
        return $result;
    }

    public function Test(){
        echo $this->getInfoDisk();
        echo $this->getInfoFolder();
    }


}