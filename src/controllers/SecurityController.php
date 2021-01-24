<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';

class SecurityController extends AppController
{
    public function login()
    {
        $user = new User('admin@adminemail.pl', 'admin', 'Johnny', 'Snow', 'none');

        if(!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST["email"];
        $password = $_POST["password"];

        //find user there

        if ($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['User with this email not exists!']]);
        }

        if ($user->getPassword() !== $password) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/home");
    }

    public function register() {

        if(!$this->isPost()) {
            return $this->render('register');
        }

        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $email = $_POST["email"];
        $password1 = $_POST["password1"];
        $password2 = $_POST["password2"];
        $description = $_POST["description"];

        if (!(isset($name) && strlen($name) > 0))
        {
            return $this->render('register', ['messages' => ['missing: name']]);
        }
        if (!(isset($surname) && strlen($surname) > 0))
        {
            return $this->render('register', ['messages' => ['missing: surname']]);
        }
        if (!(isset($email) && strlen($email) > 0))
        {
            return $this->render('register', ['messages' => ['missing: email']]);
        }
        if (!(isset($password1) && strlen($password1) > 0))
        {
            return $this->render('register', ['messages' => ['missing: password']]);
        }

        if(!preg_match('/^[a-zA-Z0-9\.\-_]+\@[a-zA-Z0-9\.\-_]+\.[a-z]{2,4}$/D ', $email))
        {
            return $this->render('register', ['messages' => ['wrong email style!']]);
        }

        if ($password1 !== $password2) {
            return $this->render('register', ['messages' => ['Different passwords!']]);
        }

        //find if email is used
        //create user

        $user = new User($email, $password1, $name, $surname, $description);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/home");
    }

    public function options_update_info() {

        if(!$this->isPost()) {
            return $this->render('options');
        }

        if(isset($_POST["name"])) {
            if(preg_match('/^[a-zA-Z]{1,40}$/', $_POST["name"]))
                $name = $_POST["name"];
        }
        $name = null;
        if(isset($_POST["surname"])) {
            if(preg_match('/^[a-zA-Z]{1,40}$/', $_POST["surname"]))
                $surname = $_POST["surname"];
        }
        $surname = null;
        if(isset($_POST["email"])) {
            if(preg_match('/^[a-zA-Z0-9\.\-_]+\@[a-zA-Z0-9\.\-_]+\.[a-z]{2,4}$/D ', $_POST["email"]))
                $email = $_POST["email"];
        }
        $email = null;
        if(isset($_POST["description"])) {
            if(preg_match('/^[a-zA-Z0-9\.\-_]+/', $_POST["name"]))
                $description = $_POST["description"];
        }
        $description = null;

        //change user informations in db, if not null

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

        if ($password2 !== $password3) {
            return $this->render('options', ['messages' => ['Different passwords!']]);
        }
        if (strlen($password2)<5) {
            return $this->render('options', ['messages' => ['Weak passwords!']]);
        }

        //change user informations in db

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/options");
    }
}

?>