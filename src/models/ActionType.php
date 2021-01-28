<?php


class ActionType
{
    private static $typeName = ['cycling','jogging','gym','swimming'];
    private static $typeIcon = [
        "fas fa-biking", // class name to <i class="fas fa-iconname"></i>
        "fas fa-running",
        "fas fa-dumbbell",
        "fas fa-swimmer"
    ];

    public static function getTypeName(int $type): string
    {
        return ActionType::$typeName[$type];
    }
    public static function getAllNames(): array
    {
        return ActionType::$typeName;
    }
    public static function getTypeIcon(int $type): string
    {
        return ActionType::$typeIcon[$type];
    }
    public static function getTypeId(string $getname): int
    {
        $typeName = ActionType::$typeName;
        $index=0;
        foreach ($typeName as $name){
            if($name == $getname)
                return $index;
            $index++;
        }
        return -1;
    }
}