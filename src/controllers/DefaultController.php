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
        $this->render('home', ['user_name' => $user_name, 'activities_assigned' => $activities_assigned,
            'activity_types' => $activty_types]);
    }

    public function myactivities() {
        $user_name = $this->userRepository->getUserName();
        $activities_assigned = $this->activityRepository->getHeaderActivs();
        $user_own_activities = $this->activityRepository->getUserActivs();
        $this->render('myactivities', ['user_name' => $user_name, 'activities_assigned' => $activities_assigned,
            'user_own_activities' => $user_own_activities]);
    }
    public function activity_create() {
        $user_name = $this->userRepository->getUserName();
        $activities_assigned = $this->activityRepository->getHeaderActivs();
        $activty_types = ActionType::getAllNames();
        $this->render('activity_create', ['user_name' => $user_name, 'activities_assigned' => $activities_assigned,
            'activity_types' => $activty_types]);
    }
    public function options() {
        $user_name = $this->userRepository->getUserName();
        $activities_assigned = $this->activityRepository->getHeaderActivs();
        $this->render('options', ['user_name' => $user_name, 'activities_assigned' => $activities_assigned]);
    }

    public function activity(string $id) {
        $id = intval($id);

        $user_name = $this->userRepository->getUserName();
        $user_activities = $this->activityRepository->getHeaderActivs();
        $activities_assigned = $this->activityRepository->getActivityInfo($id);
        $this->render('activity', ['user_name' => $user_name, 'activities_assigned' => $activities_assigned,
            'user_activities' => $user_activities]);
    }

    public function home_find() {
        if(!$this->isPost()) {
            $user_name = $this->userRepository->getUserName();
            $activities_assigned = $this->activityRepository->getHeaderActivs();
            $activty_types = ActionType::getAllNames();
            $this->render('home', ['user_name' => $user_name, 'activities_assigned' => $activities_assigned,
                'activity_types' => $activty_types]);
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

    public function options_update_info() {

        if(!$this->isPost()) {
            return $this->render('options');
        }

        $name = null;
        if(isset($_POST["name"])) {
            if(preg_match('/^[a-zA-Z]{1,50}$/', $_POST["name"]))
                $name = $_POST["name"];
        }

        if(strlen($name) > 0){
            $this->userRepository->changeUserName($name);
        }

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/options");
    }

    public function options_update_password() {

        if(!$this->isPost()) {
            return $this->render('options');
        }

        $password1 = $_POST["password1"];
        $password2 = $_POST["password2"];
        $password3 = $_POST["password3"];

        if (($password2 !== $password3) or (strlen($password1)<1)) {
            $user_name = $this->userRepository->getUserName();
            $activities_assigned = $this->activityRepository->getHeaderActivs();
            $this->render('options', ['messages' => ['Different passwords!'], 'user_name' => $user_name, 'activities_assigned' => $activities_assigned]);
        }
        if (strlen($password2)<5) {
            $user_name = $this->userRepository->getUserName();
            $activities_assigned = $this->activityRepository->getHeaderActivs();
            $this->render('options', ['messages' => ['Weak passwords!'], 'user_name' => $user_name, 'activities_assigned' => $activities_assigned]);
        }

        $this->userRepository->changeUserPassword(sha1($password1), sha1($password2));

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/options");
    }

}

?>