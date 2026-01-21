<?php

namespace lib;

use domain\School;

class SchoolRepository
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * @return School[]
     */
    public function getAllSchools(): array
    {
        return [];
    }

    public function getSchoolById(int $id): ?School
    {
        return null;
    }

    public function getSchoolByName(string $name): ?School
    {
        return null;
    }

    public function addSchool(School $school): void
    {

    }

    public function removeSchool(int $schoolId): void
    {

    }
}
