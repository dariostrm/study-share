<?php

namespace Domain;

require_once __DIR__ . '/Note.php';
use Domain\Note;

class Degree
{
    public int $id;
    public int $schoolId;
    public string $name;
    public int $semesterCount;
    public int $studentCount;

    /** @var Note[] */
    private array $notes = [];

    public function __construct(int $id, int $schoolId, string $name, int $semesterCount, int $studentCount, array $notes = [])
    {
        $this->id = $id;
        $this->schoolId = $schoolId;
        $this->name = $name;
        $this->semesterCount = $semesterCount;
        $this->studentCount = $studentCount;
        $this->notes = $notes;
    }

    public function addNote(Note $note): void
    {
        $this->notes[] = $note;
    }

    /**
     * @return Note[]
     */
    public function getNotes(): array
    {
        return $this->notes;
    }

    public function removeNote(int $noteId): void
    {
        $this->notes = array_filter($this->notes, fn($note) => $note->id !== $noteId);
    }

    public function getNoteById(int $noteId): ?Note
    {
        foreach ($this->notes as $note) {
            if ($note->id === $noteId) {
                return $note;
            }
        }
        return null;
    }
}
