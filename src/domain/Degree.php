<?php

namespace Domain;

class Degree
{
    public int $id;
    public int $schoolId;
    public string $name;
    public int $studentCount;

    public function __construct(int $id, int $schoolId, string $name, int $studentCount)
    {
        $this->id = $id;
        $this->schoolId = $schoolId;
        $this->name = $name;
        $this->studentCount = $studentCount;
    }
}