<?php
require_once __DIR__ . '/../domain/School.php';
require_once __DIR__ . '/../domain/Degree.php';

use Domain\School;
use Domain\Degree;

$schools = [
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
                studentCount: 2000
            ),
            new Degree(
                id: 2,
                schoolId: 1,
                semesterCount: 6,
                name: "Information Technology",
                studentCount: 1500
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
                studentCount: 1200
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

/** @var int $schoolId */

$selectedSchool = null;
foreach ($schools as $school) {
    if ($school->id == $schoolId) {
        $selectedSchool = $school;
        break;
    }
}
?>

<div class="container">

    <?php foreach ($selectedSchool->getDegrees() as $degree): ?>
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-10 col-xl-8 my-2">
                <?php require '../components/degree_card.php'; ?>
            </div>
        </div>
    <?php endforeach; ?>

</div>