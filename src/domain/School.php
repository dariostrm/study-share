<?php

namespace domain;

use mysqli;

class School
{
    public int $id;
    public string $name;
    public Location $location;
    public int $studentCount;
    public ?string $logoPath = null;
    public bool $isApproved = false;

    private mysqli $mysqli;

    public function __construct(int $id, string $name, Location $location, int $studentCount, bool $isApproved, mysqli $mysqli)
    {
        $this->id = $id;
        $this->name = $name;
        $this->location = $location;
        $this->studentCount = $studentCount;
        $this->isApproved = $isApproved;
        $this->mysqli = $mysqli;
    }

    public static function construct(array $data, mysqli $mysqli): School
    {
        return new School(
            (int)$data['id'],
            $data['name'],
            Location::construct($data),
            ((int)$data['student_count']) ?? -1,
            (bool)$data['is_approved'],
            $mysqli
        );
    }

    public function hasMultipleDegrees(): bool
    {
        $sql = "SELECT COUNT(*) as degree_count FROM degrees WHERE school_id = ?";
        $statement = $this->mysqli->prepare($sql);
        $statement->bind_param("i", $this->id);
        $statement->execute();
        $result = $statement->get_result();
        if ($row = $result->fetch_assoc()) {
            return (int)$row['degree_count'] > 1;
        }
        return false;
    }

    /**
     * @return Degree[]
     */
    public function getDegrees(): array
    {
        $sql = "SELECT * FROM degrees WHERE school_id = ?";
        $statement = $this->mysqli->prepare($sql);
        $statement->bind_param("i", $this->id);
        $statement->execute();
        $result = $statement->get_result();
        $degrees = [];
        while ($row = $result->fetch_assoc()) {
            $degrees[] = Degree::construct($row, $this, $this->mysqli);
        }
        return $degrees;
    }

    public function addDegree(Degree $degree): void
    {
        $sql = "INSERT INTO degrees (id, name, grade_count, student_count, school_id) VALUES (?, ?, ?, ?, ?)";
        $statement = $this->mysqli->prepare($sql);
        $statement->bind_param("isiii", $degree->id, $degree->name, $degree->gradeCount, $degree->studentCount, $this->id);
        $statement->execute();
    }

    public function removeDegree(int $degreeId): void
    {
        $sql = "DELETE FROM degrees WHERE id = ? AND school_id = ?";
        $statement = $this->mysqli->prepare($sql);
        $statement->bind_param("ii", $degreeId, $this->id);
        $statement->execute();
    }

    public function getDegreeById(int $degreeId): ?Degree
    {
        $sql = "SELECT * FROM degrees WHERE id = ? AND school_id = ?";
        $statement = $this->mysqli->prepare($sql);
        $statement->bind_param("ii", $degreeId, $this->id);
        $statement->execute();
        $result = $statement->get_result();
        if ($row = $result->fetch_assoc()) {
            return Degree::construct($row, $this, $this->mysqli);
        }
        return null;
    }

    public function getDegreeByName(string $degreeName): ?Degree
    {
        $sql = "SELECT * FROM degrees WHERE name = ? AND school_id = ?";
        $statement = $this->mysqli->prepare($sql);
        $statement->bind_param("si", $degreeName, $this->id);
        $statement->execute();
        $result = $statement->get_result();
        if ($row = $result->fetch_assoc()) {
            return Degree::construct($row, $this, $this->mysqli);
        }
        return null;
    }
}