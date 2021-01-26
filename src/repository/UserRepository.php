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

        $id_last_user = $this->getUsersId($user);

        $stmt = $this->database->connect()->prepare('
            INSERT INTO users_details (id_user, name, surname)
            VALUES (?, ?, ?)
        ');

        $stmt->execute([
            $id_last_user,
            $user->getName(),
            $user->getSurname()
        ]);
    }

    public function getUsersId(User $user): int
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM users WHERE email = :email
        ');
        $email = $user->getEmail();
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data['id_u'];
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
}