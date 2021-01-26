<?php

require_once 'AppController.php';
require_once 'DefaultController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/Activity.php';
require_once __DIR__.'/../repository/ActivityRepository.php';

class ActivityController extends DefaultController
{
    private $activityRepository;

    public function __construct()
    {
        parent::__construct();
        $this->activityRepository = new ActivityRepository();
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

        $max_participants = $_POST["maxmembers"];

        $address1 = $_POST["location_nr"];
        $address2 = $_POST["location_street"];
        $address3 = $_POST["location_city"];

        $type = ActionType::getTypeId($type);

        $user_name = $this->userRepository->getUserName();
        $activty_types = ActionType::getAllNames();


        if(!preg_match('/^[a-zA-Z0-9\s\.\-_]+/D ', $title))
        {
            return $this->render('activity_create', ['messages' => ['Wrong name!'],
                'user_name' => $user_name, 'activity_types' => $activty_types]);
        }
        if(!preg_match('/^[0-9]{1,2}$/', $time1h) || !preg_match('/^[0-9]{1,2}$/', $time1m)
        || !preg_match('/^[0-9]{1,2}$/', $time2h) || !preg_match('/^[0-9]{1,2}$/', $time2m))
        {
            return $this->render('activity_create', ['messages' => ['Wrong time!'],
                'user_name' => $user_name, 'activity_types' => $activty_types]);
        }
        else {
            if( $time2h < $time1h || ( $time2h == $time1h && $time2m <= $time1m ))
                return $this->render('activity_create', ['messages' => ['end time must be later!'],
                    'user_name' => $user_name, 'activity_types' => $activty_types]);
        }

        if(!preg_match('/^[0-9]{1,2}/', $date1) || !preg_match('/^[0-9]{1,2}/', $date2)
            || !preg_match('/^[0-9]{1,2}/', $date3))
        {
            return $this->render('activity_create', ['messages' => ['Wrong date!'],
                'user_name' => $user_name, 'activity_types' => $activty_types]);
        }
        else {
            if($date1<1 || $date2<1 || $date3<2000 || $date1>31 || $date2>12 || $date3>9999 )
                return $this->render('activity_create', ['messages' => ['Wrong date!'],
                    'user_name' => $user_name, 'activity_types' => $activty_types]);
        }

        if(!preg_match('/^[0-9]{1,10}/D ', $max_participants))
        {
            return $this->render('activity_create', ['messages' => ['wrong max number (1-100)'],
                'user_name' => $user_name, 'activity_types' => $activty_types]);
        }
        else {
            if($max_participants<1 || $max_participants>100)
                return $this->render('activity_create', ['messages' => ['wrong max number (1-100)'],
                    'user_name' => $user_name, 'activity_types' => $activty_types]);
        }

        if(!preg_match('/^[0-9]{1,4}/', $address1) || !preg_match('/^[a-zA-Z0-9\s\.\-_]{1,40}/', $address2)
            || !preg_match('/^[a-zA-Z0-9\s\.\-_]{1,40}/', $address3))
        {
            return $this->render('activity_create', ['messages' => ['wrong address'],
                'user_name' => $user_name, 'activity_types' => $activty_types]);
        }

        $date = $date1.'-'.$date2.'-'.$date3;

        $start_time = $date." ".$time1h.$time1m."00";
        $end_time = $date." ".$time2h.$time2m."00";

        $description = $_POST["description"];

        $activity = new Activity($type, $title, $start_time, $end_time, $description, $address3,
            $address2, $address1, $max_participants);

        $this->activityRepository->addActivity($activity);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/myactivities");
    }

    public function home_find() {
        if(!$this->isPost()) {
            $user_name = $this->userRepository->getUserName();
            $activty_types = ActionType::getAllNames();
            $this->render('home', ['user_name' => $user_name, 'activity_types' => $activty_types]);
        }

        $find = $_POST["find"];
        $type = ActionType::getTypeId($_POST["type"]);

        $user_name = $this->userRepository->getUserName();
        $activty_types = ActionType::getAllNames();
        $activities_find = $this->activityRepository->findActivities($find, $type);
        $this->render('home', ['user_name' => $user_name, 'activity_types' => $activty_types,
            'activities_find' => $activities_find]);
    }

    public function get_activity_types(): array {

        return ActionType::getAllNames();
    }
}