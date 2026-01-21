<?php

use domain\Session;
use domain\User;

$error = '';
$choseSchool = false;

/** @var $schoolRepository */
$schools = $schoolRepository->getAllSchools(true) ?? [];

if (isset($_SESSION['user_id'])) {
    header("Location: /home");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $schoolName = htmlspecialchars($_POST['school'] ?? '');
    $school = $schoolRepository->getSchoolByName($schoolName) ?? null;
    if ($school === null) {
        $error = 'Selected school does not exist.';
    } elseif ($school->isApproved === false) {
        $error = 'Selected school is not approved yet.';
    }
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    if ($password !== $confirm) {
        $error = 'Passwords do not match.';
    } elseif (strlen($password) < 8) {
        $error = 'Password must be at least 8 characters long.';
    }

    /** @var mysqli $mysqli */
    if ($school && User::checkUnique($username, $email, $mysqli)) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        if ($school->hasMultipleDegrees()) {
            //redirect to degree selection
            $_SESSION['temp_user'] = [
                    'username' => $username,
                    'email' => $email,
                    'password' => $hashedPassword
            ];
            $_SESSION['school_id'] = $school->id;
            header("Location: /choose-degree");
            exit;
        }

        //The school has only one degree, assign it directly
        $degrees = $school->getDegrees();
        $degreeId = $degrees[0]->id ?? null;
        if ($degreeId) {
            $user = User::signUp($username, $email, $hashedPassword, $degreeId, $school->id, $mysqli);
            $session = new Session($user, $school, $school->getDegreeById($degreeId));
            $_SESSION['user_id'] = $user->id;
            header("Location: /home");
        } else {
            $error = 'An error occurred during sign up. Please try again.';
        }
        exit;
    } else {
        $error = 'Selected school does not exist.';
    }
}
?>

<div class="container h-100">
    <div class="row h-100 d-flex flex-column justify-content-center align-items-center">
        <div class="card col-10 col-md-8 col-lg-6 col-xl-4 bg-dark-subtle p-4 rounded-4">
            <div class="card-body d-flex flex-column align-items-center gap-1 w-100">
                <h2>Sign Up</h2>
                <p class="text-muted">
                    Already have an account? <a href="/login">Login</a>
                </p>
                <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post"
                      class="d-flex flex-column gap-3 w-100">
                    <div class="form-floating">
                        <input type="email" class="form-control" id="email"
                               name="email" placeholder="E-Mail" required>
                        <label for="email">E-Mail</label>
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control" id="username"
                               name="username" placeholder="Username" required>
                        <label for="username">Username</label>
                    </div>
                    <div class="form-floating">
                        <input list="schoolList" name="school" class="form-control"
                               placeholder="School" required>
                        <label for="school">School</label>
                        <datalist id="schoolList">
                            <?php foreach ($schools

                            as $school): ?>
                            <option value="<?= htmlspecialchars($school->name) ?>">
                                <?php endforeach; ?>
                        </datalist>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" placeholder="Password"
                               id="password" name="password" required>
                        <label for="password">Password</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" placeholder="Confirm Password"
                               id="confirm" name="confirm" required>
                        <label for="confirm">Confirm Password</label>
                    </div>

                    <?php if ($error): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo htmlspecialchars($error) ?>
                        </div>
                    <?php endif; ?>

                    <button type="submit" class="btn btn-primary mt-4">Continue</button>
                </form>
            </div>
        </div>
    </div>
</div>