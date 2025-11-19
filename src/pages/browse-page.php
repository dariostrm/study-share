<?php 
require_once __DIR__ . '/../lib/SchoolRepository.php';

use Lib\SchoolRepository;

/** @var SchoolRepository $schoolRepository */
$schools = $schoolRepository->getAllSchools() ?? [];

?>

<div class="container">

    <?php foreach ($schools as $school): ?>
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-10 col-xl-8 my-2">
                <?php require '../components/school_card.php'; ?>
            </div>
        </div>
    <?php endforeach; ?>

</div>