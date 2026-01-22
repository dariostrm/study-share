<?php

use domain\School;
use lib\SchoolRepository;

/** @var $darkMode */
/** @var bool $isLoggedIn */
/** @var SchoolRepository $schoolRepository */
/** @var School[] $schools */
$schools = $schoolRepository->getAllSchools() ?? [];

$searchQuery = isset($_GET['query']) ? trim($_GET['query']) : '';

$filteredSchools = [];
foreach ($schools as $school) {

    if ($school->isApproved) {
        if (!empty($searchQuery)) {
            if (stripos($school->name, $searchQuery) !== false) {
                $filteredSchools[] = $school;
            }
        }
        else {
            $filteredSchools[] = $school;
        }
    }
}


?>
    <div class="d-flex flex-column h-100 p-3">
        <div class="flex-grow-1">
            <?php foreach ($filteredSchools as $school): ?>
                <div class="row d-flex justify-content-center">
                    <div class="col-12 col-md-10 col-xl-8 my-2">
                        <a href="<?php echo "/school/" . $school->id ?>" class="btn btn-<?= $darkMode ? "dark" : "light" ?> border w-100 p-0">
                            <?php require '../components/school_card.php'; ?>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if ($isLoggedIn): ?>
            <div class="flex-shrink-0 d-flex justify-content-center align-items-center border-top pt-3">
                <p class="mb-0 mx-2">Cannot find your school?</p>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#suggestModal">Suggest a new one
                </button>
            </div>
        <?php endif; ?>
    </div>

<?php require_once '../components/submit_school_modal.php'; ?>