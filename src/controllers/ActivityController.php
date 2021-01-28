<?php

require_once 'AppController.php';
require_once 'DefaultController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/Activity.php';
require_once __DIR__.'/../repository/ActivityRepository.php';

class ActivityController extends AppController
{
    private $activityRepository;

    public function __construct()
    {
        parent::__construct();
        $this->activityRepository = new ActivityRepository();
    }

    public function addActivity($activity) {
        $this->activityRepository->addActivity($activity);
    }
    public function add_activity_validate_info($title, $time1h, $time1m, $time2h, $time2m, $date1, $date2, $date3,
                                               $address1, $address2, $address3)
    {
        $messages = [];
        if(!preg_match('/^[a-zA-Z0-9\s\.\-_]+/D ', $title))
        {
            $messages[] = 'Wrong name!';

        }
        if(!preg_match('/^[0-9]{1,2}$/', $time1h) || !preg_match('/^[0-9]{1,2}$/', $time1m)
        || !preg_match('/^[0-9]{1,2}$/', $time2h) || !preg_match('/^[0-9]{1,2}$/', $time2m))
        {
            $messages[] = 'Wrong time!';
        }
        else {
            if( $time2h < $time1h || ( $time2h == $time1h && $time2m <= $time1m )) {
                $messages[] = 'end time must be later!';
            }
        }

        if(!preg_match('/^[0-9]{1,2}/', $date1) || !preg_match('/^[0-9]{1,2}/', $date2)
            || !preg_match('/^[0-9]{1,2}/', $date3)) {
            $messages[] = 'Wrong date!';
        }
        else
            if($date1<1 || $date2<1 || $date3<2000 || $date1>31 || $date2>12 || $date3>9999 ) {
                $messages[] = 'Wrong date!';
            }


        if(!preg_match('/^[0-9]{1,4}/', $address1) || !preg_match('/^[a-zA-Z0-9\s\.\-_]{1,40}/', $address2)
            || !preg_match('/^[a-zA-Z0-9\s\.\-_]{1,40}/', $address3))
        {
            $messages[] = 'Wrong address!';
        }
        return $messages;
    }

    public function join($id_a) {
        $this->activityRepository->join($id_a);
        http_response_code(200);
    }
    public function left($id_a) {
        $this->activityRepository->left($id_a);
        http_response_code(200);
    }
    
    public function getUserActivs(): ?array
    {
        return $this->activityRepository->getUserActivs();
    }

    public function findActivities(string $name, string $type): ?array
    {
        return $this->activityRepository->findActivities($name, $type);
    }

    public function getActivity(int $id): ?Activity
    {
        return $this->activityRepository->getActivity($id);
    }

    public function getHeaderActivs(): ?array
    {
        return $this->activityRepository->getHeaderActivs();
    }
}
