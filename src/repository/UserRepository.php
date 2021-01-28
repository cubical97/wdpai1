<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{

    public function getUser(string $email): ?User{
        $stmt = $this->database->connect()->prepare('
        SELECT * FROM v_users_login_details WHERE email = :email
        ');
        $stmt->bindParam(':email',$email,PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return null;
        }

        $_SESSION['logon'] = 1;
        $_SESSION['userid'] = $user['id_u'];

        return new User(
            $user['email'],
            $user['password'],
            $user['name'],
            $user['surname'],
            $user['role']
        );
    }

    public function addUser(User $user)
    {

        $stmt = $this->database->connect()->prepare('
            INSERT INTO users (email, password)
            VALUES (?, ?)
        ');

        $stmt->execute([
            $user->getEmail(),
            $user->getPassword(),
        ]);

        $email = $user->getEmail();
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM users WHERE email = :email
            ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user1 = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user1 == false) {
            return null;
        }

        $_SESSION['logon'] = 1;
        $_SESSION['userid'] = $user1['id_u'];

        $stmt = $this->database->connect()->prepare('
            INSERT INTO users_details (id_u, name, surname)
            VALUES (?, ?, ?)
        ');

        $stmt->execute([
            $_SESSION['userid'],
            $user->getName(),
            $user->getSurname()
        ]);
    }

    public function getUserName(): string
    {
        $stmt = $this->database->connect()->prepare('
                SELECT * FROM v_users_details WHERE id_u = :id_u
                ');
        $stmt->bindParam(':id_u',$_SESSION['userid'],PDO::PARAM_STR);
        $stmt->execute();

        $names = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($names == false) {
            return "-unknown-";
        }
        return $names["name"];
    }

    public function changeUserName(string $name){

        $id_u = $_SESSION['userid'];

        $stmt = $this->database->connect()->prepare('
            UPDATE public.users_details
            SET name = :name
            WHERE id_u = :id_u;
            ');
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':id_u', $id_u, PDO::PARAM_STR);
        $stmt->execute();
    }
    public function changeUserPassword(string $password1, string $password2){

        $id_u = $_SESSION['userid'];

        $stmt = $this->database->connect()->prepare('
            UPDATE public.users
            SET password = :password2
            WHERE id_u = :id_u AND password = :password1;
            ');
        $stmt->bindParam(':id_u', $id_u, PDO::PARAM_STR);
        $stmt->bindParam(':password2', $password2, PDO::PARAM_STR);
        $stmt->bindParam(':password1', $password1, PDO::PARAM_STR);
        $stmt->execute();
    }
}