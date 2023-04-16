<?php
namespace freePanel\Model;

class LinuxCommand
{

    private function usedRam(){
    $cmd = <<<CMD
    free -m | awk 'NR==2{print $3" MB"}'
    CMD;
    return shell_exec($cmd);

    }

    private function freeRam()
    {
        $cmd = <<<CMD
        free -m | awk 'NR==2{print $4" MB"}'
        CMD;
        return shell_exec($cmd);

    }

    private function Ram()
    {
        $cmd = <<<BASH
        free -m | grep "^Mem:" | awk '{print $2"MB"}'
        BASH;
        return shell_exec($cmd);
    }


    public function getRam()
    {
        $ram = $this->Ram();
        $free = $this->freeRam();
        $used = $this->usedRam();

        $result = "$used / $ram (Free $free)";
        return $result;

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

        $result = "$usage / $space GB (Free $free GB)";

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