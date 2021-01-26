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
    private $max_participants;
    private $description;
    private $icon;

    public function __construct(string $type, string $title, string $start_time, string $end_time, string $description, string $city,
                                string $street, string $number, int $max_participants, string $icon=null)
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
        $this->max_participants = $max_participants;
        $this->icon = $icon;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): void
    {
        $this->icon = $icon;
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

    public function getMaxParticipants(): int
    {
        return $this->max_participants;
    }

    public function setMaxParticipants(int $max_participants): void
    {
        $this->max_participants = $max_participants;
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