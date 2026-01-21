<?php

namespace lib;

use domain\School;
use mysqli;

class SchoolRepository
{
    private mysqli $mysqli;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function getAllSchools(bool $approvedOnly = false): array
    {
        $sql = "SELECT s.*, c.id as city_id, c.name as city_name, co.id as country_id, co.name as country_name 
            FROM schools s
            JOIN cities c ON s.city_id = c.id
            JOIN countries co ON c.country_id = co.id";
        if ($approvedOnly) {
            $sql .= " WHERE s.is_approved = 1";
        }
        $statement = $this->mysqli->prepare($sql);
        $statement->execute();
        $result = $statement->get_result();
        $schools = [];
        while ($row = $result->fetch_assoc()) {
            $schools[] = School::construct($row, $this->mysqli);
        }
        return $schools;
    }

    public function getSchoolByName(string $name): ?School
    {
        $sql = "SELECT s.*, c.id as city_id, c.name as city_name, co.id as country_id, co.name as country_name 
            FROM schools s
            JOIN cities c ON s.city_id = c.id
            JOIN countries co ON c.country_id = co.id
            WHERE s.name = ?";
        $statement = $this->mysqli->prepare($sql);
        $statement->bind_param("s", $name);
        $statement->execute();
        $result = $statement->get_result();
        if ($row = $result->fetch_assoc()) {
            return School::construct($row, $this->mysqli);
        }
        return null;
    }

    public function getSchoolById(int $id): ?School
    {
        $sql = "SELECT s.*, c.id as city_id, c.name as city_name, co.id as country_id, co.name as country_name 
            FROM schools s
            JOIN cities c ON s.city_id = c.id
            JOIN countries co ON c.country_id = co.id
            WHERE s.id = ?";
        $statement = $this->mysqli->prepare($sql);
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result();
        if ($row = $result->fetch_assoc()) {
            return School::construct($row, $this->mysqli);
        }
        return null;
    }

    public function addSchool(string $name, int $cityId, ?int $studentCount = null, ?string $logoPath = null): bool
    {
        $sql = "INSERT INTO schools (name, student_count, logo_path, city_id) VALUES (?, ?, ?, ?)";
        $statement = $this->mysqli->prepare($sql);
        $statement->bind_param("sisi", $name, $studentCount, $logoPath, $cityId);
        return $statement->execute();
    }

    public function removeSchool(int $schoolId): bool
    {
        $sql = "DELETE FROM schools WHERE id = ?";
        $statement = $this->mysqli->prepare($sql);
        $statement->bind_param("i", $schoolId);
        $success = $statement->execute();
        return $success && $statement->affected_rows > 0;
    }

}
