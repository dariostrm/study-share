<?php
use Lib\SchoolRepository;

/** @var int $schoolId */
/** @var SchoolRepository $schoolRepository */

$selectedSchool = $schoolRepository->getSchoolById($schoolId);
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