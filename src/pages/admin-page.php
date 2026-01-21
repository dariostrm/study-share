<?php

/** @var Session $session */
/** @var $adminPage */
/** @var $schoolRepository */

use domain\Session;
use lib\SchoolRepository;

if (!isset($session) || !$session->user->isAdmin) {
    http_response_code(403);
    echo "Only admins can access this page.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'], $_POST['school_id'])) {
        $schoolId = (int)$_POST['school_id'];
        $action = $_POST['action'];

        if ($adminPage === 'schools') {
            $school = $schoolRepository->getSchoolById($schoolId);
            if ($school) {
                if ($action === 'approve') {
                    $school->approve();
                } elseif ($action === 'reject') {
                    $schoolRepository->removeSchool($schoolId);
                }
            }
        } elseif ($adminPage === 'degrees') {
            foreach ($schoolRepository->getAllSchools() as $school) {
                $degree = $school->getDegreeById($schoolId);
                if ($degree) {
                    if ($action === 'approve') {
                        $degree->approve();
                    } elseif ($action === 'reject') {
                        $school->removeDegree($schoolId);
                    }
                    break;
                }
            }
        }

        // Redirect to avoid form resubmission
        header("Location: /admin/" . $adminPage);
        exit;
    }
}

/** @var SchoolRepository $schoolRepository */
$schools = $schoolRepository->getAllSchools();
$filteredSchools = array_filter($schools, function($school) { return !$school->isApproved; });

$degrees = [];
foreach ($schools as $school) {
    $schoolDegrees = $school->getDegrees();
    foreach ($schoolDegrees as $degree) {
        if (!$degree->isApproved)
            $degrees[] = $degree;
    }
}

?>

<nav class="navbar navbar-expand-lg justify-content-center p-3">
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a href="/admin/schools" class="nav-link <?= $adminPage === 'schools' ? 'active' : '' ?>">Schools</a>
        </li>
        <li class="nav-item">
            <a href="/admin/degrees" class="nav-link <?= $adminPage === 'degrees' ? 'active' : '' ?>">Degrees</a>
        </li>
    </ul>
</nav>

<?php if ($adminPage === 'schools') : ?>
    <div class="flex-grow-1">
        <?php foreach ($filteredSchools as $school): ?>
            <div class="row d-flex justify-content-center">
                <div class="col-12 col-md-10 col-xl-8 my-2">
                    <div class="d-flex flex-column flex-sm-row gap-2 align-items-stretch">
                        <div class="border flex-grow-1 p-0">
                            <?php require '../components/school_card.php'; ?>
                        </div>
                        <div class="d-flex flex-sm-column gap-2 justify-content-center">
                            <form method="POST" action="/admin/schools">
                                <input type="hidden" name="school_id" value="<?= $school->id ?>">
                                <button type="submit" name="action" value="approve" class="btn btn-success w-100">Approve</button>
                            </form>
                            <form method="POST" action="/admin/schools">
                                <input type="hidden" name="school_id" value="<?= $school->id ?>">
                                <button type="submit" name="action" value="reject" class="btn btn-danger w-100">Reject</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php elseif ($adminPage === 'degrees') : ?>
    <div class="flex-grow-1">
        <?php foreach ($degrees as $degree): ?>
            <div class="row d-flex justify-content-center">
                <div class="col-12 col-md-10 col-xl-8 my-2">
                    <div class="d-flex flex-column flex-sm-row gap-2 align-items-stretch">
                        <div class="border flex-grow-1 p-0">
                            <?php require '../components/degree_card.php'; ?>
                        </div>
                        <div class="d-flex flex-sm-column gap-2 justify-content-center">
                            <form method="POST" action="/admin/degrees">
                                <input type="hidden" name="school_id" value="<?= $degree->id ?>">
                                <button type="submit" name="action" value="approve" class="btn btn-success w-100">Approve</button>
                            </form>
                            <form method="POST" action="/admin/degrees">
                                <input type="hidden" name="school_id" value="<?= $degree->id ?>">
                                <button type="submit" name="action" value="reject" class="btn btn-danger w-100">Reject</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

