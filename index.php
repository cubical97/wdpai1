<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('index', 'DefaultController');
Routing::get('register', 'DefaultController');
Routing::get('search', 'DefaultController');
Routing::get('activities', 'DefaultController');
Routing::get('activity_create', 'DefaultController');
Routing::get('friends', 'DefaultController');
Routing::get('options', 'DefaultController');
Routing::get('activity', 'DefaultController');

Routing::run($path);

?>
