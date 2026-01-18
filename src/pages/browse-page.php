<?php
require_once __DIR__ . '/../lib/SchoolRepository.php';

use Lib\SchoolRepository;

/** @var SchoolRepository $schoolRepository */
$schools = $schoolRepository->getAllSchools() ?? [];

$searchQuery = isset($_GET['query']) ? trim($_GET['query']) : '';

if (!empty($searchQuery)) {
    $filteredSchools = [];
    foreach ($schools as $school) {
        if (stripos($school->name, $searchQuery) !== false) {
            array_push($filteredSchools, $school);
        }
    }
    $schools = $filteredSchools;
}

?>
<div class="d-flex flex-column h-100 p-3">
    <div class="flex-grow-1">
        <?php foreach ($schools as $school): ?>
            <div class="row d-flex justify-content-center">
                <div class="col-12 col-md-10 col-xl-8 my-2">
                    <?php require '../components/school_card.php'; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="flex-shrink-0 d-flex justify-content-center align-items-center border-top pt-3">
        <p class="mb-0 mx-2">Cannot find your school?</p>
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#suggestModal">Suggest a new one</button>
    </div>
</div>

<?php require '../components/submit_school_modal.php'; ?>