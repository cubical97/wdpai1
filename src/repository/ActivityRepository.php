<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Activity.php';

class ActivityRepository extends Repository
{

    public function getACtivity(string $id): ?Activity{
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

    public function addActivity(Activity $activity) {
        $date = new DateTime();
        $stmt = $this->database->connect()->prepare('
        INSERT INTO activities (title, created_at, id_assigned_by, start_time, end_time, type, description, max_participants)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ');

        $assignedById = 1; //TODO

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

        $stmt = $this->database->connect()->prepare('
        INSERT INTO activities_address (id_activity, city, street, number)
        VALUES (?, ?, ?, ?)
        ');

        $id_activity = 2; //TODO

        $stmt->execute([
            $id_activity,
            $activity->getCity(),
            $activity->getStreet(),
            $activity->getNumber()
        ]);

        $stmt = $this->database->connect()->prepare('
        INSERT INTO activities_address (id_activity, city, street, number)
        VALUES (?, ?, ?, ?)
        ');

        $id_activity = 2; //TODO

        $stmt->execute([
            $id_activity,
            $activity->getCity(),
            $activity->getStreet(),
            $activity->getNumber()
        ]);
    }
}