<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/ActionType.php';
require_once __DIR__.'/../repository/UserRepository.php';

class DefaultController extends AppController {

    protected $userRepository;
    private $activityRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
        $this->activityRepository = new ActivityRepository();
    }

    public function index() {
        $this->render('index');
    }
    public function register() {
        $this->render('register');
    }
    public function home() {
        $user_name = $this->userRepository->getUserName();
        $activities_assigned = $this->activityRepository->getHeaderActivs();
        $activty_types = ActionType::getAllNames();
        $this->render('home', ['user_name' => $user_name, 'activities_assigned' => $activities_assigned, 'activity_types' => $activty_types]);
    }

    public function myactivities() {
        $user_name = $this->userRepository->getUserName();
        $activities_assigned = $this->activityRepository->getHeaderActivs();
        $user_own_activities = $this->activityRepository->getUserActivs();
        $this->render('myactivities', ['user_name' => $user_name, 'activities_assigned' => $activities_assigned, 'user_own_activities' => $user_own_activities]);
    }
    public function activity_create() {
        $user_name = $this->userRepository->getUserName();
        $activities_assigned = $this->activityRepository->getHeaderActivs();
        $activty_types = ActionType::getAllNames();
        $this->render('activity_create', ['user_name' => $user_name, 'activities_assigned' => $activities_assigned, 'activity_types' => $activty_types]);
    }
    public function options() {
        $user_name = $this->userRepository->getUserName();
        $activities_assigned = $this->activityRepository->getHeaderActivs();
        $this->render('options', ['user_name' => $user_name, 'activities_assigned' => $activities_assigned]);
    }
    public function activity() {
        $user_name = $this->userRepository->getUserName();
        $activities_assigned = $this->activityRepository->getHeaderActivs();
        $this->render('activity', ['user_name' => $user_name, 'activities_assigned' => $activities_assigned]);
    }

    // extra  extra  extra  extra  extra  extra  extra  extra  extra

    public function home_find() {
        if(!$this->isPost()) {
            $user_name = $this->userRepository->getUserName();
            $activty_types = ActionType::getAllNames();
            $this->render('home', ['user_name' => $user_name, 'activity_types' => $activty_types]);
        }

        $find = $_POST["find"];
        $type = ActionType::getTypeId($_POST["type"]);


        $user_name = $this->userRepository->getUserName();
        $activities_assigned = $this->activityRepository->getHeaderActivs();
        $activty_types = ActionType::getAllNames();
        $activities_find = $this->activityRepository->findActivities($find, $type);
        $this->render('home', ['user_name' => $user_name, 'activities_assigned' => $activities_assigned,
            'activity_types' => $activty_types, 'activities_find' => $activities_find]);
    }
}

?>