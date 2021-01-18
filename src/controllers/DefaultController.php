<?php

require_once 'AppController.php';

class DefaultController extends AppController {
    public function index() {
        $this->render('login');
    }
    public function register() {
        $this->render('register');
    }
    public function search() {
        $this->render('search');
    }
    public function activities() {
        $this->render('activities');
    }
    public function activity_create() {
        $this->render('activity_create');
    }
    public function friends() {
        $this->render('friends');
    }
    public function options() {
        $this->render('options');
    }
    public function activity() {
        $this->render('activity');
    }
}

?>