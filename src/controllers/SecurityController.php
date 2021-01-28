<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class SecurityController extends AppController
{
    protected $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function login()
    {

        if(!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST["email"];
        $password = sha1($_POST["password"]);

        $user = $this->userRepository->getUser($email);

        if(!$user) {
            return $this->render('index', ['messages' => ['User with this email not exists!']]);
        }

        if ($user->getEmail() !== $email) {
            return $this->render('index', ['messages' => ['User with this email not exists!2']]);
        }

        if ($user->getPassword() !== $password) {
            return $this->render('index', ['messages' => ['Wrong password!']]);
        }

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/home");
    }

    public function logout()
    {

        $_SESSION['logon'] = 0;
        $_SESSION['userid'] = -1;

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/");
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

        $user = new User($email, sha1($password1), $name, $surname, 0 );

        $this->userRepository->addUser($user);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/home");
    }

    public function getUserName(): string
    {
        return $this->userRepository->getUserName();
    }

    public function changeUserName(string $name)
    {
        $this->userRepository->changeUserName($name);
    }

    public function changeUserPassword(string $password1, string $password2)
    {
        $this->userRepository->changeUserPassword($password1, $password2);
    }
}

?>