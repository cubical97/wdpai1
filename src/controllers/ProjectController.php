<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/Activity.php';

class ProjectController extends AppController
{

    public function findactiv() {
        if(!$this->isPost()) {
            return $this->render('home');
        }

        $name = $_POST["name"];
        $type = $_POST["type"];

        //searh for activities in db
        //prind activities on screen

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/home");
    }

    public function addactiv()
    {
        if(!$this->isPost()) {
            return $this->render('activity_create');
        }

        $type = $_POST["type"];
        $name = $_POST["name"];

        $time1h = $_POST["time1h"];
        $time1m = $_POST["time1m"];
        $time2h = $_POST["time2h"];
        $time2m = $_POST["time2m"];

        $date1 = $_POST["date1"];
        $date2 = $_POST["date2"];
        $date3 = $_POST["date3"];

        $maxmembers = $_POST["maxmembers"];

        $address1 = $_POST["location_nr"];
        $address2 = $_POST["location_street"];
        $address3 = $_POST["location_city"];

        if(!preg_match('/^[a-zA-Z0-9\s\.\-_]+/D ', $name))
        {
            return $this->render('activity_create', ['messages' => ['Wrong name!']]);
        }
        if(!preg_match('/^[0-9]{1,2}$/', $time1h) || !preg_match('/^[0-9]{1,2}$/', $time1m)
        || !preg_match('/^[0-9]{1,2}$/', $time2h) || !preg_match('/^[0-9]{1,2}$/', $time2m))
        {
            return $this->render('activity_create', ['messages' => ['Wrong time!']]);
        }
        else {
            if( $time2h < $time1h || ( $time2h == $time1h && $time2m <= $time1m ))
                return $this->render('activity_create', ['messages' => ['end time must be later!']]);
        }

        if(!preg_match('/^[0-9]{1,2}/', $date1) || !preg_match('/^[0-9]{1,2}/', $date2)
            || !preg_match('/^[0-9]{1,2}/', $date3))
        {
            return $this->render('activity_create', ['messages' => ['Wrong date!']]);
        }
        else {
            if($date1<1 || $date2<1 || $date3<2000 || $date1>31 || $date2>12 || $date3>9999 )
                return $this->render('activity_create', ['messages' => ['Wrong date!']]);
        }

        if(!preg_match('/^[0-9]{1,10}/D ', $maxmembers))
        {
            return $this->render('activity_create', ['messages' => ['wrong max number (1-100)']]);
        }
        else {
            if($maxmembers<1 || $maxmembers>100)
                return $this->render('activity_create', ['messages' => ['wrong max number (1-100)']]);
        }

        if(!preg_match('/^[0-9]{1,4}/', $address1) || !preg_match('/^[a-zA-Z0-9\s\.\-_]{1,40}/', $address2)
            || !preg_match('/^[a-zA-Z0-9\s\.\-_]{1,40}/', $address3))
        {
            return $this->render('activity_create', ['messages' => ['wrong address']]);
        }

        $time = $time1h.$time1m."00";
        $endtime = $time2h.$time2m."00";

        $date = $date1.'/'.$date2.'/'.$date3;

        $address = $address1.'/'.$address2.'/'.$address3;
        $description = $_POST["description"];

        //add activity to db

        $activity = new Activity($type, $name, $time, $endtime, $date, $maxmembers, $address, $description);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/myactivities");
    }
}