<?php


class ActionType
{
    public static function getTypeName(int $type): string
    {
        $typeName = ['cycling','jogging','gym','swimming'];
        return $typeName[type];
    }
    public static function getTypeIcon(): string
    {
        $typeIcon = [
            "fas fa-biking", //<i class="fas fa-biking"></i>
            "fas fa-running",
            "fas fa-dumbbell",
            "fas fa-swimmer"
        ];
        return $typeIcon[type];
    }
    public static function getTypeId(string $getname): int
    {
        $typeName = ['cycling','jogging','gym','swimming'];
        $index=0;
        foreach (typenames as $name){
            if($name == $getname)
                return index;
            $index++;
        }
        return -1;
    }
}