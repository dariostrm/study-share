<?php


/** @var mysqli $mysqli */
/** @var int $schoolId */

use lib\SchoolRepository;
/** @var $schoolRepository */

$name = htmlspecialchars($_GET['name']);
$gradeCount = (int)htmlspecialchars($_GET['gradeCount']);
$studentCount = (int)htmlspecialchars($_GET['studentCount']);

$school = $schoolRepository->getSchoolById($schoolId);

if (!isset($name) || !isset($gradeCount)) {
    $generalError = 'The degree could not be submitted. Please fill in all required fields.';
    header('Location: /error?error=' . urlencode($generalError));
    exit;
}
if (empty($name) || empty($gradeCount)) {
    $generalError = 'The degree could not be submitted. Please fill in all required fields.';
    header('Location: /error?error=' . urlencode($generalError));
    exit;
}
// degree name unique?
if ($school->getDegreeByName($name) !== null) {
    $generalError = 'A degree with this name already exists.';
    header('Location: /error?error=' . urlencode($generalError));
    exit;
}
if (!is_numeric($gradeCount) || (int)$gradeCount <= 0) {
    $generalError = 'Invalid grade/semester count.';
    header('Location: /error?error=' . urlencode($generalError));
    exit;
}

$stCount = !empty($studentCount) && $studentCount > 0 ? $studentCount : null;
$success = $school->addDegree($name, $gradeCount, $school->id, $stCount);
if ($success) {
    header('Location: /home');
    exit;
} else {
    $generalError = 'An error occurred while submitting the degree suggestion. Please try again later.';
    header('Location: /error');
    exit;
}
