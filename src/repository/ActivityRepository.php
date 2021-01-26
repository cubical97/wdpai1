<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Activity.php';

class ActivityRepository extends Repository
{

    public function getActivity(string $id): ?Activity{
        $stmt = $this->database->connect()->prepare('
        SELECT * FROM v_activities_info WHERE id = :id
        ');
        $stmt->bindParam(':id',$id,PDO::PARAM_INT);
        $stmt->execute();

        $activity = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($activity == false) {
            return null;
        }

        return new Activity(
            $activity['type'],
            $activity['title'],
            $activity['start_time'],
            $activity['end_time'],
            $activity['description'],
            $activity['city'],
            $activity['street'],
            $activity['number'],
            $activity['max_participants'],
        );
    }

    public function addActivity(Activity $activity)
    {
        $date = new DateTime();

        $assignedById = $_SESSION['userid'];

        $stmt = $this->database->connect()->prepare('
        INSERT INTO activities (title, created_at, id_u, start_time, end_time, type, description, max_participants)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ');

        $stmt->execute([
            $activity->getTitle(),
            $date->format('Y-m-d H:i:s'),
            $assignedById,
            $activity->getStartTime(),
            $activity->getEndtime(),
            $activity->getType(),
            $activity->getDescription(),
            $activity->getMaxParticipants()
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
            SELECT * FROM public.activities WHERE title = :title AND type = :type AND description = :description
         AND max_participants = :max_participants');

        $title = $activity->getTitle();
        $type = $activity->getType();
        $descr = $activity->getDescription();
        $max_par = $activity->getMaxParticipants();

        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':type', $type, PDO::PARAM_STR);
        $stmt->bindParam(':description', $descr, PDO::PARAM_STR);
        $stmt->bindParam(':max_participants', $max_par, PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data['id_a'];
    }

    public function findActivities(string $name, string $type): ?array
    {
        $result = [];

//        if ($name == null) {
//
//            die('name set:'.$name);
//
//            $stmt = $this->database->connect()->prepare('
//            SELECT * FROM v_activities_info WHERE title = :name AND type = :type AND end_time>NOW()');
//
//            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
//            $stmt->bindParam(':type', $type, PDO::PARAM_STR);
//            $stmt->execute();
//
//            $activities = $stmt->fetchAll(PDO::FETCH_ASSOC);
//        }
//        else {

            $stmt = $this->database->connect()->prepare('
            SELECT * FROM v_activities_info WHERE type = :type AND end_time>NOW()');

            $stmt->bindParam(':type', $type, PDO::PARAM_STR);
            $stmt->execute();

            $activities = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //}

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
                $activity['max_participants'],
                ActionType::getTypeIcon($activity['type'])
            );
        }

        return $result;
    }
}