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
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Suggest a new one</button>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Test</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>