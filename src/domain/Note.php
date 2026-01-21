<?php

namespace domain;

class Note
{
    public int $id;
    public string $title;
    public ?string $description;
    public string $date;
    public User $user;
    public Degree $degree;
    public ?string $filePath;
    public string $subject;
    public int $grade;

    public function __construct(
        int $id,
        string $title,
        ?string $description,
        string $date,
        User $user,
        Degree $degree,
        ?string $filePath,
        string $subject,
        int $grade
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->date = $date;
        $this->user = $user;
        $this->degree = $degree;
        $this->filePath = $filePath;
        $this->subject = $subject;
        $this->grade = $grade;
    }

    public static function construct(array $data, User $user, Degree $degree): Note
    {
        return new Note(
            (int)$data['id'],
            $data['title'],
            $data['description'] ?? null,
            $data['date'],
            $user,
            $degree,
            $data['file_path'] ?? null,
            $data['subject'],
            (int)$data['grade']
        );
    }
}
