<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('index', 'DefaultController');
Routing::get('register', 'DefaultController');
Routing::post('login', 'SecurityController');
Routing::post('register', 'SecurityController');
Routing::post('options_update_info', 'SecurityController');
Routing::post('options_update_password', 'SecurityController');
Routing::post('addActiv', 'ActivityController');
Routing::post('findActiv', 'ActivityController');

Routing::get('home', 'DefaultController');
Routing::get('myactivities', 'DefaultController');
Routing::get('activity_create', 'DefaultController');
Routing::get('options', 'DefaultController');
Routing::get('activity', 'DefaultController');

Routing::run($path);

?>
