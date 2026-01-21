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
            (int)$data['school_id'],
            (bool)$data['is_admin']
        );
    }

    public static function checkUnique(string $username, string $email, mysqli $mysqli): bool
    {
        $sql = "SELECT COUNT(*) as count FROM users WHERE username = ? OR email = ?";
        $statement = $mysqli->prepare($sql);
        $statement->bind_param("ss", $username, $email);
        $statement->execute();
        $result = $statement->get_result();
        if ($row = $result->fetch_assoc()) {
            return $row['count'] == 0;
        }
        return false;
    }

    public static function signUp(string $username, string $email, string $passwordHash, int $degreeId, int $schoolId, mysqli $mysqli): User
    {
        $sql = "INSERT INTO users (username, email, password_hash, degree_id, school_id) VALUES (?, ?, ?, ?, ?)";
        $statement = $mysqli->prepare($sql);
        $statement->bind_param("sssii", $username, $email, $passwordHash, $degreeId, $schoolId);
        $statement->execute();
        //get the inserted user id
        $userId = $mysqli->insert_id;
        return new User($userId, $username, $email, $degreeId, $schoolId);
    }

    public static function signIn(string $username, string $password, mysqli $mysqli): ?User
    {
        $sql = "SELECT * FROM users WHERE username = ?";
        $statement = $mysqli->prepare($sql);
        $statement->bind_param("s", $username);
        $statement->execute();
        $result = $statement->get_result();
        if ($row = $result->fetch_assoc()) {
            if (password_verify($password, $row['password_hash'])) {
                return User::construct($row);
            }
        }
        return null;
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

    public function changeUsername(string $newUsername, mysqli $mysqli): bool
    {
        $sql = "UPDATE users SET username = ? WHERE id = ?";
        $statement = $mysqli->prepare($sql);
        $statement->bind_param("si", $newUsername, $this->id);
        $success = $statement->execute();
        if ($success) {
            $this->username = $newUsername;
        }
        return $success;
    }

    public function changeEmail(string $newEmail, mysqli $mysqli): bool
    {
        $sql = "UPDATE users SET email = ? WHERE id = ?";
        $statement = $mysqli->prepare($sql);
        $statement->bind_param("si", $newEmail, $this->id);
        $success = $statement->execute();
        if ($success) {
            $this->email = $newEmail;
        }
        return $success;
    }

    public function changePassword(string $newPassword, mysqli $mysqli): bool
    {
        $newPasswordHash = password_hash($newPassword, PASSWORD_BCRYPT);
        $sql = "UPDATE users SET password_hash = ? WHERE id = ?";
        $statement = $mysqli->prepare($sql);
        $statement->bind_param("si", $newPasswordHash, $this->id);
        return $statement->execute();
    }
}