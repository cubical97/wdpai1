<?php

require_once 'AppController.php';

class DefaultController extends AppController {
    public function index() {
        $this->render('index');
    }
    public function register() {
        $this->render('register');
    }
    public function home() {
        $this->render('home');
    }
    public function myactivities() {
        $this->render('myactivities');
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