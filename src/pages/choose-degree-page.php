<?php


use domain\Session;
use lib\SchoolRepository;
use domain\User;

if (!isset($_SESSION['school_id']) || !isset($_SESSION['temp_user'])) {
    header("Location: /sign-up");
    exit;
}
$schoolId = $_SESSION['school_id'];

/** @var $schoolRepository */
$school = $schoolRepository->getSchoolById($schoolId);
if (!$school) {
    header("Location: /sign-up");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $degreeId = $_POST['degree'];
    $tempUser = $_SESSION['temp_user'];
    /** @var mysqli $mysqli */
    /** @var $user */
    $user = User::signUp($tempUser['username'], $tempUser['email'], $tempUser['password'], (int)$degreeId, $school->id, $mysqli);
    unset($_SESSION['temp_user']);
    unset($_SESSION['school_id']);
    $_SESSION['user_id'] = $user->id;
    $session = new Session($user, $school, $school->getDegreeById((int)$degreeId));
    header("Location: /home");
    exit;
}

$degrees = $school->getDegrees(true);

?>

<div class="container h-100">
    <div class="row h-100 d-flex flex-column justify-content-center align-items-center">
        <div class="card col-10 col-md-8 col-lg-6 col-xl-4 bg-dark-subtle p-4 rounded-4">
            <div class="card-body d-flex flex-column align-items-center gap-4 w-100">
                <h2>Choose Degree</h2>
                <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post"
                      class="d-flex flex-column gap-3 w-100">
                    <div class="form-floating">
                        <select class="form-select" id="degreeSelect" name="degree" aria-label="Select degree">
                            <?php foreach ($degrees as $deg): ?>
                                <option value="<?= htmlspecialchars($deg->id) ?>">
                                    <?= htmlspecialchars($deg->name) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <label for="degreeSelect">Degree</label>
                    </div>

                    <button type="submit" class="btn btn-primary mt-4">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>