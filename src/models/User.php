<?php

class User
{
    private $email;
    private $password;
    private $name;
    private $surname;
    private $description;
    private $usertype;

    public function __construct(string $email, string $password, string $name, string $surname)
    {
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->surname = $surname;
        $this->usertype = 0;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }
}