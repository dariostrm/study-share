<?php

//** @var int $schoolId */
use Domain\Degree;
use Domain\School;

if (isset($_SESSION['degreeId'])) {
    header("Location: /home");
    exit;
}
if (!isset($_SESSION['schoolId'])) {
    header("Location: /sign-up");
    exit;
}
$schoolId = $_SESSION['schoolId'];
$school = $schoolRepository->getSchoolById($schoolId);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $degreeName = htmlspecialchars($_POST['degree'] ?? '');
    $degree = $school?->getDegreeByName($degreeName);
    if ($degree) {
        $_SESSION['degreeId'] = $degree->id;
    }

    header("Location: /home");
    exit;
}

$degrees = $school->getDegrees();

?>

<div class="container h-100">
    <div class="row h-100 d-flex flex-column justify-content-center align-items-center">
        <div class="card col-10 col-md-8 col-lg-6 col-xl-4 bg-dark-subtle p-4 rounded-4">
            <div class="card-body d-flex flex-column align-items-center gap-4 w-100">
                <h2>Choose Degree</h2>
                <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post" class="d-flex flex-column gap-3 w-100">
                    <div class="form-floating">
                        <input list="degreeList" name="degree" class="form-control"
                            placeholder="Degree">
                        <label for="degree">Degree</label>
                        <datalist id="degreeList">
                            <?php foreach ($degrees as $degree): ?>
                                <option value="<?= htmlspecialchars($degree->name) ?>">
                                <?php endforeach; ?>
                        </datalist>
                    </div>

                    <button type="submit" class="btn btn-primary mt-4">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>