<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/ActionType.php';
require_once __DIR__.'/../repository/UserRepository.php';

class DefaultController extends AppController {

    private $securityController;
    private $activityController;

    public function __construct()
    {
        parent::__construct();
        $this->securityController = new SecurityController();
        $this->activityController = new ActivityController();
    }

    public function index() {
        $this->render('index');
    }

    public function register() {
        $this->render('register');
    }
    public function home() {
        if((!isset($_SESSION['userid'])) or ($_SESSION['userid'] < 1))
            $this->index();

        $user_name = $this->securityController->getUserName();
        $activities_assigned = $this->activityController->getHeaderActivs();
        $activty_types = ActionType::getAllNames();
        $this->render('home', ['user_name' => $user_name, 'activities_assigned' => $activities_assigned,
            'activity_types' => $activty_types]);
    }

    public function myactivities() {
        if((!isset($_SESSION['userid'])) or ($_SESSION['userid'] < 1))
            $this->index();

        $user_name = $this->securityController->getUserName();
        $activities_assigned = $this->activityController->getHeaderActivs();
        $user_own_activities = $this->activityController->getUserActivs();
        $this->render('myactivities', ['user_name' => $user_name, 'activities_assigned' => $activities_assigned,
            'user_own_activities' => $user_own_activities]);
    }
    public function activity_create() {
        if((!isset($_SESSION['userid'])) or ($_SESSION['userid'] < 1))
            $this->index();

        $user_name = $this->securityController->getUserName();
        $activities_assigned = $this->activityController->getHeaderActivs();
        $activty_types = ActionType::getAllNames();
        $this->render('activity_create', ['user_name' => $user_name, 'activities_assigned' => $activities_assigned,
            'activity_types' => $activty_types]);
    }
    public function options() {
        if((!isset($_SESSION['userid'])) or ($_SESSION['userid'] < 1))
            $this->index();

        $user_name = $this->securityController->getUserName();
        $activities_assigned = $this->activityController->getHeaderActivs();
        $this->render('options', ['user_name' => $user_name, 'activities_assigned' => $activities_assigned]);
    }

    public function activity(string $id) {
        if((!isset($_SESSION['userid'])) or ($_SESSION['userid'] < 1))
            $this->index();

        $id = intval($id);

        $user_name = $this->securityController->getUserName();
        $user_activities = $this->activityController->getHeaderActivs();
        $activities_assigned = $this->activityController->getActivity($id);
        //$activities_assigned = $this->activityRepository->getActivity($id);
        $this->render('activity', ['user_name' => $user_name, 'activities_assigned' => $activities_assigned,
            'user_activities' => $user_activities]);
    }

    public function home_find() {
        if((!isset($_SESSION['userid'])) or ($_SESSION['userid'] < 1))
            $this->index();

        if(!$this->isPost()) {
            $user_name = $this->securityController->getUserName();
            $activities_assigned = $this->activityController->getHeaderActivs();
            $activty_types = ActionType::getAllNames();
            $this->render('home', ['user_name' => $user_name, 'activities_assigned' => $activities_assigned,
                'activity_types' => $activty_types]);
        }

        $find = $_POST["find"];
        $type = ActionType::getTypeId($_POST["type"]);

        $user_name = $this->securityController->getUserName();
        $activities_assigned = $this->activityController->getHeaderActivs();
        $activty_types = ActionType::getAllNames();
        $activities_find = $this->activityController->findActivities($find, $type);
        $this->render('home', ['user_name' => $user_name, 'activities_assigned' => $activities_assigned,
            'activity_types' => $activty_types, 'activities_find' => $activities_find]);
    }

    public function options_update_info() {
        if((!isset($_SESSION['userid'])) or ($_SESSION['userid'] < 1))
            $this->index();

        if(!$this->isPost()) {
            return $this->render('options');
        }

        $name = null;
        if(isset($_POST["name"])) {
            if(preg_match('/^[a-zA-Z]{1,50}$/', $_POST["name"]))
                $name = $_POST["name"];
        }

        if(strlen($name) > 0){

            $this->securityController->changeUserName($name);
        }

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/options");
    }

    public function options_update_password() {
        if((!isset($_SESSION['userid'])) or ($_SESSION['userid'] < 1))
            $this->index();

        if(!$this->isPost()) {
            return $this->render('options');
        }

        $password1 = $_POST["password1"];
        $password2 = $_POST["password2"];
        $password3 = $_POST["password3"];

        if (($password2 !== $password3) or (strlen($password1)<1)) {
            $user_name = $this->securityController->getUserName();
            $activities_assigned = $this->activityController->getHeaderActivs();
            $this->render('options', ['messages' => ['Different passwords!'], 'user_name' => $user_name, 'activities_assigned' => $activities_assigned]);
        }
        if (strlen($password2)<5) {
            $user_name = $this->securityController->getUserName();
            $activities_assigned = $this->activityController->getHeaderActivs();
            $this->render('options', ['messages' => ['Weak passwords!'], 'user_name' => $user_name, 'activities_assigned' => $activities_assigned]);
        }

        $this->securityController->changeUserPassword(sha1($password1), sha1($password2));

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/options");
    }

    public function add_activity()
    {
        if(!$this->isPost()) {
            return $this->render('activity_create');
        }

        $type = $_POST["type"];
        $title = $_POST["name"];

        $time1h = $_POST["time1h"];
        $time1m = $_POST["time1m"];
        $time2h = $_POST["time2h"];
        $time2m = $_POST["time2m"];

        $date1 = $_POST["date1"];
        $date2 = $_POST["date2"];
        $date3 = $_POST["date3"];

        $address1 = $_POST["location_nr"];
        $address2 = $_POST["location_street"];
        $address3 = $_POST["location_city"];

        $type = ActionType::getTypeId($type);

        $user_name = $this->securityController->getUserName();
        $activty_types = ActionType::getAllNames();

        $messages = $this->activityController->add_activity_validate_info(
            $title, $time1h, $time1m, $time2h, $time2m, $date1, $date2, $date3,
            $address1, $address2, $address3);

        if(sizeof($messages)>0) {
            return $this->render('activity_create', ['messages' => $messages,
                'user_name' => $user_name, 'activity_types' => $activty_types]);

        }

        if(strlen($date1)==1)
            $date1 = '0'.$date1;
        if(strlen($date2)==1)
            $date2 = '0'.$date2;

        $date = $date3.'-'.$date2.'-'.$date1;

        if(strlen($time1h)==1)
            $time1h = '0'.$time1h;
        if(strlen($time1m)==1)
            $time1m = '0'.$time1m;
        if(strlen($time2h)==1)
            $time2h = '0'.$time2h;
        if(strlen($time2m)==1)
            $time2m = '0'.$time2m;

        $start_time = $date." ".$time1h.':'.$time1m.':'."00";
        $end_time = $date." ".$time2h.':'.$time2m.':'."00";

        $description = $_POST["description"];

        $activity = new Activity($type, $title, $start_time, $end_time, $description, $address3,
            $address2, $address1);

        $this->activityController->addActivity($activity);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/myactivities");
    }

}

?>