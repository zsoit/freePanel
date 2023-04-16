<?php

namespace freePanel\Controller;

class AppController extends App
{
    private $App;
    public function __construct()
    {
        $this->App = new App();
    }
    public function Router()
    {
        $page = DataController::fetchGET('action');

        switch($page)
        {
            case 'add': $this->App->AddPage(); break;

            case 'delete': $this->App->DeletePage(); break;

            case 'add_form': $this->App->AddFormPage(); break;

            case 'users': $this->App->UsersPage(); break;

            case 'user': $this->App->UserPage(); break;

            case 'backup': $this->App->BackupPage(); break;

            default: $this->App->HomePage(); break;
        }

    }

    public function includeHTML($file)
    {
        require_once "src/public/$file.php";
    }
}