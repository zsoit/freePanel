<?php
namespace freePanel\Controller;

use freePanel\View\HtmlTemplate;
use freePanel\Model\LinuxCommand;
use freePanel\Model\DbQuery;

class App
{
    private $id;
    private $confirm;
    private $dbquery;
    private $LinuxCommand;

    public function __construct()
    {
        $this->LinuxCommand = new LinuxCommand();
        $this->dbquery = new DbQuery();

        $this->id = DataController::fetchGET("id");
        $this->confirm = DataController::fetchGET("confirm");

    }

    public function HomePage(): void
    {
        HtmlTemplate::PrimaryHeader("Home");

        $row = array();
        $row['disk'] = $this->LinuxCommand->getInfoDisk();
        $row['ram'] = $this->LinuxCommand->getRam();
        HtmlTemplate::ServerInfo($row);


        HtmlTemplate::JSsetTitle('page__home','Home');

    }

    public function AddPage(): void
    {

        $user = DataController::fetchPOST("user");
        $password = DataController::fetchPOST("password");
        $domain = DataController::setDomain();

        if($user == null && $password == null)
        {
            HtmlTemplate::ConsoleLog("Error: Empty !");
        }
        else
        {

            $data = array();
            $data['name'] = $user;
            $data['domain'] = $domain;
            $data['password'] = $password;
            $data['date'] = DataController::getCurrentDate();

            $this->dbquery->insertIntoUser($data);

            $cmd = "sh sh/add.sh $user $password $domain";
            HtmlTemplate::Console($cmd);
        }

    }

    public function DeletePage(): void
    {

        $data = $this->dbquery->getUserById($this->id);

        $name = isset($data['name']) ? $data['name']: null;
        $domain = isset($data['domain']) ? $data['domain']: null;


        if(
            $this->id != null AND $this->confirm == true AND $name != null AND $domain != null
        )
        {
            HtmlTemplate::ConsoleLog("<h3>User $name was deleted!!!</h3>");
            $sh = "sh sh/delete.sh $name $domain";
            HtmlTemplate::Console($sh);

            $this->dbquery->deleteUser($this->id);
            $this->ListUserPage();
        }
        else
        {
            HtmlTemplate::confirmDelete($this->id,$name,$domain);
            HtmlTemplate::JSsetTitle('page__delete','Delete');

        }

        HtmlTemplate::JSsetTitle('page__delete','Delete');


    }

    public function AddFormPage(): void
    {
        HtmlTemplate::addForm();
        HtmlTemplate::JSsetTitle('page__add','Add');
    }

    public function UserPage():void
    {
        $data = $this->dbquery->getUserById($this->id);

        $row = array();
        $row['id'] = $this->id;
        $row['domain'] = isset($data['domain']) ? $data['domain']: null ;
        $row['name'] = isset($data['name']) ? $data['name']: null ;
        $row['disk'] =  $this->LinuxCommand->getSizeFolder("/www/{$row['name']}");

        HtmlTemplate::UserPage($row);

    }

    public function UsersPage()
    {

        $users = $this->dbquery->getUsers();
        HtmlTemplate::tableList($users);
        HtmlTemplate::JSsetTitle('page__users','Home');

    }

    public function BackupPage(): void
    {
        HtmlTemplate::PrimaryHeader("Backup");
        HtmlTemplate::BackupList();
        HtmlTemplate::JSsetTitle('page__backup','Backup');

    }

}