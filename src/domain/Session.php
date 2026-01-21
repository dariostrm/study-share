<?php

namespace domain;

use lib\SchoolRepository;
use mysqli;

class Session
{
    public User $user;
    public School $school;
    public Degree $degree;

    public function __construct(User $user, School $school, Degree $degree)
    {
        $this->user = $user;
        $this->school = $school;
        $this->degree = $degree;
    }

    public static function fromUser(User $user, SchoolRepository $schoolRepository): Session
    {
        $school = $schoolRepository->getSchoolById($user->schoolId);
        $degree = $school->getDegreeById($user->degreeId);
        return new Session($user, $school, $degree);
    }
}