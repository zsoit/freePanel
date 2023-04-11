<?php
class App
{
    private $Data;

    public function __construct()
    {
        $this->Data = new DataController();
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
        $id = isset($_GET['id']) ? $_GET['id']  : null;
        $confirm = isset($_GET['confirm']) ? $_GET['confirm']  : "false";

        $query = new DbQuery();

        if($id != null AND $confirm=="true")
        {
            $query->deleteUser($id);
            HtmlTemplate::ConsoleLog("<h3>User was #$id deleted!!!</h3>");
            $this->ListUser();
        }
        else{
            $result = $query->getUserById($id);

            while ($row = $result->fetchArray()) {
                HtmlTemplate::confirmDelete($id,$row['name'],$row['domain']);
            }

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

            default:
                $this->ListUser();
                break;
        }

    }
}