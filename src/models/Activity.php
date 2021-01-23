<?php

class Activity
{
    private $type;
    private $name;
    private $time;
    private $endtime;
    private $date;
    private $maxmembers;
    private $address;
    private $description;

    public function __construct(string $type, string $name, string $time, string $endtime, string $date, int $maxmembers, string $address, string $description)
    {
        $this->type = $type;
        $this->name = $name;
        $this->time = $time;
        $this->endtime = $endtime;
        $this->date = $date;
        $this->maxmembers = $maxmembers;
        $this->address = $address;
        $this->description = $description;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getTime(): string
    {
        return $this->time;
    }

    public function setTime(string $time): void
    {
        $this->time = $time;
    }

    public function getEndtime(): string
    {
        return $this->endtime;
    }

    public function setEndtime(string $endtime): void
    {
        $this->endtime = $endtime;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    public function getMaxmembers(): int
    {
        return $this->maxmembers;
    }

    public function setMaxmembers(int $maxmembers): void
    {
        $this->maxmembers = $maxmembers;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
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