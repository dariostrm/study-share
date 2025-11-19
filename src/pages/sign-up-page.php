<?php
if (isset($_SESSION['user_id'])) {
    header("Location: /profile");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['user_id'] = htmlspecialchars($_POST['username']);
    $_SESSION['user_email'] = htmlspecialchars($_POST['email']);
    header("Location: /home");
    exit;
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
                <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post" class="d-flex flex-column gap-3 w-100">
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
                        <input type="password" class="form-control" placeholder="Password"
                            id="password" name="password" required>
                        <label for="password">Password</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" placeholder="Confirm Password"
                            id="confirm" name="confirm" required>
                        <label for="confirm">Confirm Password</label>
                    </div>

                    <button type="submit" class="btn btn-primary mt-4">Continue</button>
                </form>
            </div>
        </div>
    </div>
</div>