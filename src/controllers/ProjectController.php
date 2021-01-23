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
        $time = $_POST["time"];
        $endtime = $_POST["endtime"];
        $date = $_POST["date"];
        $maxmembers = $_POST["maxmembers"];
        $address = $_POST["location"];
        $description = $_POST["description"];

        $activity = new Activity($type, $name, $time, $endtime, $date, $maxmembers, $address, $description);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/myactivities");
    }
}