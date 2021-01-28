<?php

session_start();
if(!isset($_SESSION['ident'])){
    $_SESSION['ident']=$_SERVER['REMOTE_ADDR'].DATE('Y. t');
    $_SESSION['logon']=0;
}

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('index', 'DefaultController');
Routing::get('register', 'DefaultController');
Routing::get('home', 'DefaultController');
Routing::get('myactivities', 'DefaultController');
Routing::get('activity_create', 'DefaultController');
Routing::get('options', 'DefaultController');
Routing::get('activity', 'DefaultController');

Routing::post('home_find', 'DefaultController');
Routing::post('add_activity', 'DefaultController');
Routing::post('options_update_info', 'DefaultController');
Routing::post('options_update_password', 'DefaultController');

Routing::post('login', 'SecurityController');
Routing::post('register', 'SecurityController');
Routing::post('logout', 'SecurityController');

Routing::get('get_activity', 'ActivityController');
Routing::get('join', 'ActivityController');
Routing::get('left', 'ActivityController');

Routing::run($path);

?>
