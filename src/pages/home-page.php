<?php
require_once __DIR__ . '/../lib/SchoolRepository.php';

use Lib\SchoolRepository;

$notes = [];
if (isset($_SESSION['degreeId']) && isset($_SESSION['schoolId'])) {
    $schoolId = $_SESSION['schoolId'];
    $degreeId = $_SESSION['degreeId'];

    /** @var SchoolRepository $schoolRepository */
    $notes = $schoolRepository->getSchoolById($schoolId)?->getDegreeById($degreeId)?->getNotes() ?? [];
}

?>

<div class="container mt-3">
    <div class="row">
        <?php if (!isset($_SESSION['degreeId']) || !isset($_SESSION['schoolId'])): ?>
            <div class="col-12 d-flex flex-column justify-content-center align-items-center gap-3">
                <h3>Please <a href="/login">login</a> or <a href="/sign-up">sign up</a> to see notes of your school and degree.</h3>
                <h5 class="text-muted">Or <a href="/browse">Browse</a> existing schools and degrees.</h5>
            </div>
        <?php else: ?>
            <?php foreach ($notes as $note): ?>
                <div class="col-12 col-md-6 col-lg-4 col-xl-3 my-3 d-flex justify-content-center align-items-stretch">
                    <?php require '../components/note_card.php'; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>