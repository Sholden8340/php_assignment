<?php

//Add libraries
spl_autoload_register(function ($classname) {
    require_once 'libraries/' . $classname . '.php';
});

//Create Session
require_once 'helpers/session_helper.php';


//Load Config
require_once 'config/config.php';

$init = new Core();
