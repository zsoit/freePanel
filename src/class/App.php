<?php
class App
{
    private $Data;
    private $id;
    private $confirm;

    public function __construct()
    {
        $this->Data = new DataController();

        $this->id = isset($_GET['id']) ? $_GET['id']  : null;
        $this->confirm = isset($_GET['confirm']) ? $_GET['confirm']  : "false";
    }

    private function Add()
    {
        $user = $this->Data->setPOST('user');
        $password = $this->Data->setPOST('password');
        $domain = $this->Data->setDomain();

        if($user == null && $password == null)
        {
            HtmlTemplate::ConsoleLog("Error: Empty !");
        }
        else
        {
            $query = new DbQuery();

            $data = array();
            $data['name'] = $user;
            $data['domain'] = $domain;
            $data['password'] = $password;
            $data['date'] = $this->Data->getCurrentDate();

            $query->insertIntoUser($data);

            $cmd = "sh sh/add.sh $user $password $domain";
            HtmlTemplate::Console($cmd);
        }

    }

    private function Delete()
    {

        $query = new DbQuery();
        $data = $query->getUserById($this->id);

        $name = isset($data['name']) ? $data['name']: null ;
        $domain = isset($data['domain']) ? $data['domain']: null ;


        if($this->id != null AND $this->confirm=="true" AND $name != null AND $domain != null)
        {
            HtmlTemplate::ConsoleLog("<h3>User $name was deleted!!!</h3>");
            $sh = "sh sh/delete.sh $name $domain";
            HtmlTemplate::Console($sh);

            $query->deleteUser($this->id);
            $this->ListUser();
        }
        else
        {
            HtmlTemplate::confirmDelete($this->id,$name,$domain);
        }

        HtmlTemplate::JSsetTitle('page__delete','Delete');


    }

    public function AddForm()
    {
        HtmlTemplate::addForm();
        HtmlTemplate::JSsetTitle('page__add','Add');
    }

    public function ListUser()
    {
        HtmlTemplate::tableList(
            'DbQuery::DisplayUsers'
        );
        HtmlTemplate::JSsetTitle('page__home','Home');

    }

    function User()
    {
        $query = new DbQuery();
        $data = $query->getUserById($this->id);

        $disk = $this->Data->getSizeFolder("{$this->id}");

        $name = isset($data['name']) ? $data['name']: null ;
        $domain = isset($data['domain']) ? $data['domain']: null ;

        echo <<<HTML
        <h2>User #$this->id</h2>
        <p>user: $name</p>
        <p>domain:<a href="https://{$domain}" target="_blank"> $domain</p></a>
        <p>Size WWW: $disk</p>


        HTML;
    }

    public function Router()
    {

        $page = isset($_GET['action']) ? $_GET['action']  : 'default';

        switch($page)
        {
            case 'add':
                $this->Add();
                break;

            case 'delete':
                $this->Delete();
                break;

            case 'add_form':
                $this->AddForm();
                break;

            case 'user':
                $this->User();
                break;
            default:
                $this->ListUser();
                break;
        }

    }
}