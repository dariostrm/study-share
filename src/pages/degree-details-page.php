<?php

use lib\SchoolRepository;

/** @var int $schoolId */
/** @var int $degreeId */

/** @var SchoolRepository $schoolRepository */

$notes = $schoolRepository->getSchoolById($schoolId)?->getDegreeById($degreeId)?->getNotes() ?? [];

//filters
$notes = filterNotes($notes);


?>

<div class="container mt-3">
    <div class="row">
        <?php include '../components/note_filter.php'; ?>
    </div>
    <div class="row">
        <?php if (empty($notes)): ?>
            <div class="col-12 d-flex flex-column justify-content-center align-items-center gap-3">
                <h3>No notes available for this degree yet.</h3>
            </div>
        <?php endif; ?>
        <?php foreach ($notes as $note): ?>
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 my-3 d-flex justify-content-center align-items-stretch">
                <?php require '../components/note_card.php'; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>