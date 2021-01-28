<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Activity.php';

class ActivityRepository extends Repository
{
    public function getActivity(int $id_a): ?Activity
    {
        $result = null;

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM v_activities_info WHERE (v_activities_info.id_a = :id_a);
            ');

        $stmt->bindParam(':id_a', $id_a, PDO::PARAM_INT);
        $stmt->execute();

        $activity = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($activity == false) {
            return null;
        }
      
        $result = new Activity(
            ActionType::getTypeName($activity['type']),
            $activity['title'],
            $activity['start_time'],
            $activity['end_time'],
            $activity['description'],
            $activity['city'],
            $activity['street'],
            $activity['number'],
            ActionType::getTypeIcon($activity['type']),
            $activity['id_a']
        );

        return $result;
    }

    public function addActivity(Activity $activity)
    {
        $date = new DateTime();

        $assignedById = $_SESSION['userid'];

        $stmt = $this->database->connect()->prepare('
        INSERT INTO activities (title, created_at, id_u, start_time, end_time, type, description)
        VALUES (?, ?, ?, ?, ?, ?, ?)
        ');

        $stmt->execute([
            $activity->getTitle(),
            $date->format('Y-m-d H:i:s'),
            $assignedById,
            $activity->getStartTime(),
            $activity->getEndtime(),
            $activity->getType(),
            $activity->getDescription(),
        ]);

        $id_activity = $this->getActivityId($activity);

        $stmt = $this->database->connect()->prepare('
        INSERT INTO activities_address (id_a, city, street, number)
        VALUES (?, ?, ?, ?)
        ');

        $stmt->execute([
            $id_activity,
            $activity->getCity(),
            $activity->getStreet(),
            $activity->getNumber()
        ]);

        $stmt = $this->database->connect()->prepare('
        INSERT INTO users_activities (id_u, id_a)
        VALUES (?, ?)
        ');

        $stmt->execute([
            $assignedById,
            $id_activity
        ]);
    }

    public function getActivityId(Activity $activity): int
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.activities WHERE title = :title AND type = :type AND description = :description');

        $title = $activity->getTitle();
        $type = $activity->getType();
        $descr = $activity->getDescription();

        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':type', $type, PDO::PARAM_INT);
        $stmt->bindParam(':description', $descr, PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data['id_a'];
    }

    public function findActivities(string $name, string $type): ?array
    {
        $result = [];

        if (!is_null($name) and (strlen($name) > 0)) {

            $stmt = $this->database->connect()->prepare('
            SELECT * FROM v_activities_info WHERE title = :name AND type = :type AND end_time>NOW()');

            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':type', $type, PDO::PARAM_INT);
            $stmt->execute();

            $activities = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {

            $stmt = $this->database->connect()->prepare('
            SELECT * FROM v_activities_info WHERE type = :type AND end_time>NOW()');

            $stmt->bindParam(':type', $type, PDO::PARAM_INT);
            $stmt->execute();

            $activities = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        foreach ($activities as $activity) {
            $result[] = new Activity(
                ActionType::getTypeName($activity['type']),
                $activity['title'],
                $activity['start_time'],
                $activity['end_time'],
                $activity['description'],
                $activity['city'],
                $activity['street'],
                $activity['number'],
                ActionType::getTypeIcon($activity['type']),
                $activity['id_a']
            );

        }
        return $result;
    }

    public function getHeaderActivs(): ?array
    {
        $result = [];

        $activities = $this->getUserActivs();

        $max = 3;
        foreach ($activities as $activity) {
            if ($max > 0) {
                $result[] = $activity;
            }
            $max--;
        }

        return $result;
    }

    public function getUserActivs(): ?array
    {
        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM (v_activities_info LEFT JOIN public.users_activities ua ON (v_activities_info.id_a = ua.id_a))
            WHERE ua.id_u = :id_u AND v_activities_info.end_time>NOW();
            ');

        $id_u = $_SESSION['userid'];

        $stmt->bindParam(':id_u', $id_u, PDO::PARAM_INT);
        $stmt->execute();

        $activities = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($activities as $activity) {
            $result[] = new Activity(
                ActionType::getTypeName($activity['type']),
                $activity['title'],
                $activity['start_time'],
                $activity['end_time'],
                $activity['description'],
                $activity['city'],
                $activity['street'],
                $activity['number'],
                ActionType::getTypeIcon($activity['type']),
                $activity['id_a']
            );
        }

        return $result;
    }

    public function join($id_a) {

        $assignedById = $_SESSION['userid'];

        $stmt = $this->database->connect()->prepare('
        INSERT INTO users_activities (id_u, id_a)
        VALUES (?, ?)
        ');

        $stmt->execute([
            $assignedById,
            $id_a
        ]);
    }
    public function left($id_a) {

        $id_u = $_SESSION['userid'];

        $stmt = $this->database->connect()->prepare('
        DELETE
        FROM public.users_activities
        WHERE id_u = :id_u AND id_a = :id_a
        ');

        $stmt->execute([
            $id_u,
            $id_a
        ]);
    }
}