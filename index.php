<?php

use freePanel\Controller\AppController;

include_once 'CONFIG.php';

$App = new AppController();

$App->includeHTML("head");
$App->includeHTML("header");
$App->Router();
$App->includeHTML("footer");
