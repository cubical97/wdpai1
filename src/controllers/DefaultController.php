<?php

require_once 'AppController.php';

class DefaultController extends AppController {
    public function index() {
        $this->render('login');
    }
    public function activity() {
        $this->render('activity');
    }
    public function register() {
        $this->render('register');
    }
}

?>