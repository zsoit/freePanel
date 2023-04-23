<?php
define("PRIMARY_DOMAIN","banankox.pl");
define("SERVER_HOST","maluch.mikr.us");
define("SERVER_PORT","10312");



define("TITLE_APP","freePanel");
define("VERSION_APP","1.0 BETA");

define("DATABASE","database/db");

foreach(glob("src/class/*.php") as $class) require_once $class;