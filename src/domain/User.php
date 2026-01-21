<?php

namespace domain;

class User
{
    public int $id;
    public string $username;
    public string $email;
    public Degree $degree;
    public School $school;
    public bool $isAdmin = false;

    public function __construct(int $id, string $username, string $email, Degree $degree, School $school, bool $isAdmin = false)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->degree = $degree;
        $this->school = $school;
        $this->isAdmin = $isAdmin;
    }
}