<?php

use domain\Session;
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
    if ($username !== $session->user->username) {
        /** @var mysqli $mysqli */
        $success = $session->user->changeUsername($username, $mysqli);
        if (!$success) {
            $error = 'Username is already taken.';
        }
    }

    if ($email !== $session->user->email) {
        /** @var mysqli $mysqli */
        $success = $session->user->changeEmail($email, $mysqli);
        if (!$success) {
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
    </div>
</form>