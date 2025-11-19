<?php

namespace Domain;

class Degree
{
    public int $id;
    public int $schoolId;
    public string $name;
    public int $semesterCount;
    public int $studentCount;

    public function __construct(int $id, int $schoolId, string $name, int $semesterCount, int $studentCount)
    {
        $this->id = $id;
        $this->schoolId = $schoolId;
        $this->name = $name;
        $this->semesterCount = $semesterCount;
        $this->studentCount = $studentCount;
    }
}