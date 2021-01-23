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

        if ($password1 !== $password2) {
            return $this->render('register', ['messages' => ['Different passwords!']]);
        }

        $user = new User($email, $password1, $name, $surname, $description);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/home");
    }
}

?>