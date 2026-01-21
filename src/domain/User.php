<?php

namespace domain;

use mysqli;

class User
{
    public int $id;
    public string $username;
    public string $email;
    public int $degreeId;
    public int $schoolId;
    public bool $isAdmin = false;

    public function __construct(int $id, string $username, string $email, int $degreeId, int $schoolId, bool $isAdmin = false)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->degreeId = $degreeId;
        $this->schoolId = $schoolId;
        $this->isAdmin = $isAdmin;
    }

    public static function construct(array $data): User
    {
        return new User(
            (int)$data['id'],
            $data['username'],
            $data['email'],
            (int)$data['degree_id'],
            (int)$data['school_id']
        );
    }

    public static function getById(int $id, mysqli $mysqli): ?User
    {
        $sql = "SELECT * FROM users WHERE id = ?";
        $statement = $mysqli->prepare($sql);
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result();
        if ($row = $result->fetch_assoc()) {
            return User::construct($row);
        }
        return null;
    }
}