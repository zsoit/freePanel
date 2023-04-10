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
            HtmlTemplate::ConsoleLog("Error: Puste pola!");
        }
        else
        {
            $query = new DbQuery();

            $data = array();
            $data['name'] = $user;
            $data['domain'] = $domain;
            $data['date'] = $this->Data->getCurrentDate();

            $query->insertIntoUser($data);

            $cmd = "sh sh/add.sh $user $password $domain";
            HtmlTemplate::Console($cmd);
        }

    }


    public function AddForm()
    {
        echo '<section class="section_primary">';
        echo '<div class="section_primary__item">';
        HtmlTemplate::addForm();
        echo '</div>';
        echo '</section>';
    }

    public function ListUser()
    {
        HtmlTemplate::tableList(
            'DbQuery::DisplayUsers'
        );
    }

    public function Router()
    {

        $page = isset($_GET['action']) ? $_GET['action']  : 'default';

        switch($page)
        {
            case 'add':
                $this->Add();
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