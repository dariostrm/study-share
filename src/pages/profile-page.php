<?php
use lib\SchoolRepository;
/** @var SchoolRepository $schoolRepository */

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {
    $_SESSION['username'] = htmlspecialchars($_POST['username']);
    $_SESSION['email'] = htmlspecialchars($_POST['email']);
    $schoolName = htmlspecialchars($_POST['school'] ?? '');
    $degreeName = htmlspecialchars($_POST['degree'] ?? '');

    $school = $schoolRepository->getSchoolByName($schoolName);
    $degree = $school?->getDegreeByName($degreeName);
    $_SESSION['schoolId'] = $school?->id ?? null;
    $_SESSION['degreeId'] = $degree?->id ?? null;
    header("Location: /profile");
    exit;
}

$schools = $schoolRepository->getAllSchools() ?? [];
$degrees = [];
if (isset($_SESSION['schoolId'])) {
    $school = $schoolRepository->getSchoolById($_SESSION['schoolId']);
    if ($school) {
        $degrees = $school->getDegrees();
        if (isset($_SESSION['degreeId'])) {
            $degree = $school?->getDegreeById($_SESSION['degreeId']);
        }
    }
}

?>

<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
    <div class="container h-100">
        <div class="row my-3">
            <div class="d-lg-block d-flex justify-content-center">
                <h2>Profile</h2>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-12 col-lg-6 rounded-4 d-flex flex-column align-items-center gap-1 my-2">
                <div class="d-flex flex-column gap-3 w-100">
                    <div class="form-floating">
                        <input type="email" class="form-control" id="email"
                            name="email" placeholder="E-Mail" required value="<?php echo htmlspecialchars($_SESSION['email']) ?>">
                        <label for="email">E-Mail</label>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 rounded-4 d-flex flex-column align-items-center gap-1 my-2">

                <div class="d-flex flex-column gap-3 w-100">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="username"
                            name="username" placeholder="Username" required value="<?php echo htmlspecialchars($_SESSION['username']) ?>">
                        <label for="username">Username</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-12 col-lg-6 rounded-4 d-flex flex-column align-items-center gap-1 my-2">
                <div class="d-flex flex-column gap-3 w-100 form-floating">
                    <input list="schoolList" name="school" class="form-control"
                        placeholder="School" value="<?php echo htmlspecialchars($school->name ?? '') ?>">
                    <label for="school">School</label>
                    <datalist id="schoolList">
                        <?php foreach ($schools as $school): ?>
                            <option value="<?= htmlspecialchars($school->name) ?>">
                            <?php endforeach; ?>
                    </datalist>
                </div>
            </div>
            <div class="col-12 col-lg-6 rounded-4 d-flex flex-column align-items-center gap-1 my-2">
                <div class="d-flex flex-column gap-3 w-100 form-floating">
                    <div class="form-floating">
                        <select class="form-select" id="degreeSelect" name="degree" aria-label="Select degree">
                            <?php foreach ($degrees as $deg): ?>
                                <option value="<?= htmlspecialchars($deg->name) ?>"
                                    <?php if ($degree->name === $deg->name) echo 'selected'; ?>>
                                    <?= htmlspecialchars($deg->name) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <label for="degreeSelect">Degree</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row my-3">
            <div class="col rounded-4 d-flex flex-column align-items-center gap-1 w-100">
                <a href="/reset-password" class="btn btn-primary">Change Password</a>
            </div>
        </div>
        <div class="row my-3 d-flex justify-content-center">
            <div class="col-auto">
                <button name="save" type="submit" class="btn btn-primary mt-4">Save</button>
            </div>
        </div>
    </div>
</form>