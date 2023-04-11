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

        if($id != null AND $confirm=="true")
        {
            $query = new DbQuery();
            $query->deleteUser($id);

            echo <<<HTML
            <p>User was #$id deleted!!!</p>
            HTML;

            $this->ListUser();
        }
        else{
            echo <<<HTML
            <p>Are you sure? Can you delete user #$id?</p>
            <p>ATTENTION! All data from www folder will be delete!</p>
            <a href='?action=delete&id=$id&confirm=true'>
                <button>
                    Confirm
                </button>
            </a>
            HTML;
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