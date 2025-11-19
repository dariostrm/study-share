<?php

namespace Lib;

require_once __DIR__ . '/../domain/School.php';
require_once __DIR__ . '/../domain/Degree.php';
require_once __DIR__ . '/../domain/Note.php';

use Domain\Note;
use Domain\School;
use Domain\Degree;

class SchoolRepository
{
    private array $schools;

    public function __construct()
    {
        $this->schools = [
            new School(
                id: 1,
                name: "FH Technikum",
                country: "Austria",
                city: "Vienna",
                studentCount: 5000,
                degrees: [
                    new Degree(
                        id: 1,
                        schoolId: 1,
                        semesterCount: 6,
                        name: "Computer Science",
                        studentCount: 2000,
                        notes: [
                            new Note(
                                id: 1,
                                title: "PHP Advanced abcdrefef",
                                description: "Advanced PHP concepts and examples.",
                                date: "2025-10-23",
                                user: "Dario",
                                subject: "WEB",
                                grade: 1
                            ),
                            new Note(
                                id: 2,
                                title: "Betriebssysteme",
                                description: "Einführung Ubuntu, VM installieren, etc.",
                                date: "2025-10-23",
                                user: "Ali",
                                subject: "INFRA",
                                grade: 1
                            ),
                        ],
                    ),
                    new Degree(
                        id: 2,
                        schoolId: 1,
                        semesterCount: 6,
                        name: "Information Technology",
                        studentCount: 1500,
                        notes: [
                            new Note(
                                id: 5,
                                title: "Netzwerktechnik",
                                description: "OSI Modell, TCP/IP, Subnetting",
                                date: "2025-10-24",
                                user: "Ali",
                                subject: "INFRA",
                                grade: 2
                            ),
                        ]
                    ),
                ]
            ),
            new School(
                id: 2,
                name: "Science College",
                country: "OtherCounty",
                city: "OtherCity",
                studentCount: 3000,
                degrees: [
                    new Degree(
                        id: 3,
                        schoolId: 2,
                        name: "Biology",
                        semesterCount: 6,
                        studentCount: 1200,
                        notes: [
                            new Note(
                                id: 3,
                                title: "Function pointer",
                                description: "Beispielapp mit hierarchischen Menüs",
                                date: "2025-10-23",
                                user: "Dario",
                                subject: "PROZ",
                                grade: 1
                            ),
                            new Note(
                                id: 4,
                                title: "SQL",
                                description: null,
                                date: "2025-10-22",
                                user: "Ali",
                                subject: "DBMG",
                                grade: 1
                            ),
                        ]
                    ),
                    new Degree(
                        id: 4,
                        schoolId: 2,
                        semesterCount: 6,
                        name: "Chemistry",
                        studentCount: 800
                    ),
                ]
            ),
        ];
    }

    /**
     * @return School[]
     */
    public function getAllSchools(): array
    {
        return $this->schools;
    }

    public function getSchoolById(int $id): ?School
    {
        foreach ($this->schools as $school) {
            if ($school->id === $id) {
                return $school;
            }
        }
        return null;
    }

    public function getSchoolByName(string $name): ?School
    {
        foreach ($this->schools as $school) {
            if ($school->name === $name) {
                return $school;
            }
        }
        return null;
    }

    public function addSchool(School $school): void
    {
        array_push($this->schools, $school);
    }

    public function removeSchool(int $schoolId): void
    {
        $this->schools = array_filter($this->schools, fn($school) => $school->id !== $schoolId);
    }
}
