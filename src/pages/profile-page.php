<?php

use domain\Session;
use domain\User;
use lib\SchoolRepository;
/** @var SchoolRepository $schoolRepository */

if (!isset($session)) {
    header('Location: /login');
    exit();
}

$school = $session->school;
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);

    /** @var Session $session */
    /** @var mysqli $mysqli */
    if ($username !== $session->user->username) {
        if (User::checkUniqueUsername($username, $mysqli)) {
            $success = $session->user->changeUsername($username, $mysqli);
            if (!$success) {
                $error = 'Username is already taken.';
            }
        } else {
            $error = 'Username is already taken.';
        }
    }

    if ($email !== $session->user->email) {
        if (User::checkUniqueEmail($email, $mysqli)) {
            $success = $session->user->changeEmail($email, $mysqli);
            if (!$success) {
                $error = 'E-Mail is already in use.';
            }
        } else {
            $error = 'E-Mail is already in use.';
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
                            name="email" placeholder="E-Mail" required value="<?php echo $session->user->email ?>">
                        <label for="email">E-Mail</label>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 rounded-4 d-flex flex-column align-items-center gap-1 my-2">

                <div class="d-flex flex-column gap-3 w-100">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="username"
                            name="username" placeholder="Username" required value="<?php echo $session->user->username ?>">
                        <label for="username">Username</label>
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
        <!-- Dark mode toggle -->
        <div class="row my-3 d-flex justify-content-center">
            <div class="col-auto">
                <form action="<?= $_SERVER['REQUEST_URI']?>" method="post">
                    <button type="submit" name="toggle_dark_mode" class="btn btn-secondary mt-4">Toggle Dark Mode</button>
                </form>
            </div>
        </div>
        <!-- Error Message -->
        <?php if ($error): ?>
            <div class="row my-3 d-flex justify-content-center">
                <div class="col-auto">
                    <div class="alert alert-danger" role="alert">
                        <?php echo htmlspecialchars($error) ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</form>