<?php

namespace Lib;

use Domain\School;

class SchoolRepository
{
    private array $schools;

    public function __construct()
    {
        $this->schools = [];
    }

    /**
     * @return School[]
     */
    public function getAllSchools(): array
    {
        return $this->schools;
    }

    public function getSchoolById(int $id): ?School
    {
        foreach ($this->schools as $school) {
            if ($school->id === $id) {
                return $school;
            }
        }
        return null;
    }

    public function getSchoolByName(string $name): ?School
    {
        foreach ($this->schools as $school) {
            if ($school->name === $name) {
                return $school;
            }
        }
        return null;
    }

    public function addSchool(School $school): void
    {
        array_push($this->schools, $school);
    }

    public function removeSchool(int $schoolId): void
    {
        $this->schools = array_filter($this->schools, fn($school) => $school->id !== $schoolId);
    }
}
