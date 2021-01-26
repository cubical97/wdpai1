<?php

class Activity
{

    private $type;
    private $title;
    private $start_time;
    private $end_time;
    private $city;
    private $street;
    private $number;
    private $description;
    private $icon;
    private $id_a;
    private $assigned_by;

    public function __construct(string $type, string $title, string $start_time, string $end_time, string $description, string $city,
                                string $street, string $number, string $icon=null, int $id_a=null, int $assigned_by=null)
    {
        $this->type = $type;
        $this->title = $title;
        $this->start_time = $start_time;
        $this->end_time = $end_time;
        if(isset($description))
            $this->description = $description;
        else
            $this->description = null;
        $this->city = $city;
        $this->street = $street;
        $this->number = $number;

        $this->setIcon($icon);
        $this->setIdA($id_a);
        $this->setAssignedBy($assigned_by);
    }

    public function getAssignedBy()
    {
        return $this->assigned_by;
    }

    public function setAssignedBy($assigned_by): void
    {
        $this->assigned_by = $assigned_by;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): void
    {
        $this->icon = $icon;
    }

    public function getIdA(): ?int
    {
        return $this->id_a;
    }

    public function setIdA($id_a): void
    {
        $this->id_a = $id_a;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function setStreet(string $street): void
    {
        $this->street = $street;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number): void
    {
        $this->number = $number;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getStartTime(): string
    {
        return $this->start_time;
    }

    public function setStartTime(string $start_time): void
    {
        $this->start_time = $start_time;
    }

    public function getEndtime(): string
    {
        return $this->end_time;
    }

    public function setEndtime(string $end_time): void
    {
        $this->end_time = $end_time;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
}