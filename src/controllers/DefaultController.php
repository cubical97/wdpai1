<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/ActionType.php';
require_once __DIR__.'/../repository/UserRepository.php';

class DefaultController extends AppController {

    protected $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function index() {
        $this->render('index');
    }
    public function register() {
        $this->render('register');
    }
    public function home() {
        $user_name = $this->userRepository->getUserName();
        $this->render('home', ['user_name' => $user_name]);
    }
    public function myactivities() {
        $user_name = $this->userRepository->getUserName();
        $this->render('myactivities', ['user_name' => $user_name]);
    }
    public function activity_create() {
        $user_name = $this->userRepository->getUserName();
        $activty_types = ActionType::getAllNames();
        $this->render('activity_create', ['user_name' => $user_name, 'activity_types' => $activty_types]);
    }
    public function options() {
        $user_name = $this->userRepository->getUserName();
        $this->render('options', ['user_name' => $user_name]);
    }
    public function activity() {
        $user_name = $this->userRepository->getUserName();
        $this->render('activity', ['user_name' => $user_name]);
    }
}

?>