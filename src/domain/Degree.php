<?php

namespace domain;

use mysqli;

class Degree
{
    public int $id;
    public School $school;
    public string $name;
    public int $gradeCount;
    public int $studentCount;

    private mysqli $mysqli;

    public function __construct(int $id, School $school, string $name, int $gradeCount, int $studentCount, mysqli $mysqli)
    {
        $this->id = $id;
        $this->school = $school;
        $this->name = $name;
        $this->gradeCount = $gradeCount;
        $this->studentCount = $studentCount;
        $this->mysqli = $mysqli;
    }

    public static function construct(array $data, School $school, mysqli $mysqli) : Degree
    {
        return new Degree(
            (int)$data['id'],
            $school,
            $data['name'],
            (int)$data['grade_count'],
            (int)$data['student_count'],
            $mysqli
        );
    }

    /**
     * @return Note[]
     */
    public function getNotes(): array
    {
        $sql = "SELECT * FROM notes WHERE degree_id = ?";
        $statement = $this->mysqli->prepare($sql);
        $statement->bind_param("i", $this->id);
        $statement->execute();
        $result = $statement->get_result();
        $notes = [];
        while ($row = $result->fetch_assoc()) {
            $notes[] = Note::construct($row, User::getById($row['user_id'], $this->mysqli), $this);
        }
        return $notes;
    }

    public function addNote(Note $note): void
    {
        $sql = "INSERT INTO notes (id, title, description, created_at, user_id, degree_id, file_path, subject, grade) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $statement = $this->mysqli->prepare($sql);
        $statement->bind_param("isssiissi",
            $note->id,
            $note->title,
            $note->description,
            $note->date,
            $note->user->id,
            $this->id,
            $note->filePath,
            $note->subject,
            $note->grade
        );
        $statement->execute();
    }

    public function removeNote(int $noteId): void
    {
        $sql = "DELETE FROM notes WHERE id = ? AND degree_id = ?";
        $statement = $this->mysqli->prepare($sql);
        $statement->bind_param("ii", $noteId, $this->id);
        $statement->execute();
    }

    public function getNoteById(int $noteId): ?Note
    {
        $sql = "SELECT * FROM notes WHERE id = ? AND degree_id = ?";
        $statement = $this->mysqli->prepare($sql);
        $statement->bind_param("ii", $noteId, $this->id);
        $statement->execute();
        $result = $statement->get_result();
        if ($row = $result->fetch_assoc()) {
            return Note::construct($row, User::getById($row['user_id'], $this->mysqli), $this);
        }
        return null;
    }
}
