<?php

use lib\SchoolRepository;

/** @var int $schoolId */
/** @var $isLoggedIn */
/** @var SchoolRepository $schoolRepository */

$selectedSchool = $schoolRepository->getSchoolById($schoolId);
?>

    <div class="d-flex flex-column h-100 p-3">
        <div class="flex-grow-1">
            <?php foreach ($selectedSchool->getDegrees(true) as $degree): ?>
                <div class="row d-flex justify-content-center">
                    <div class="col-12 col-md-10 col-xl-8 my-2">
                        <?php require '../components/degree_card.php'; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php
        if ($isLoggedIn): ?>
            <div class="flex-shrink-0 d-flex justify-content-center align-items-center border-top pt-3">
                <p class="mb-0 mx-2">Cannot find your degree?</p>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#suggestDegreeModal">Suggest a new one
                </button>
            </div>
        <?php endif; ?>
    </div>

<?php require_once '../components/submit_degree_modal.php'; ?>