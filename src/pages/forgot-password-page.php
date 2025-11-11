<?php

?>

<div class="d-flex flex-column justify-content-center align-items-center vh-100">
    <div class="card bg-dark-subtle px-3 py-4 rounded-4">
        <div class="card-body d-flex flex-column align-items-center gap-1">
            <h2>Reset Password</h2>
            <p class="text-muted">
                Back to <a href="/login">Login</a>
            </p>
            <form action="./sign-up-page.php" method="post" class="d-flex flex-column gap-3">
                <div class="form-floating">
                    <input type="email" class="form-control" id="email"
                           name="email" placeholder="E-Mail" required>
                    <label for="email">E-Mail</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" placeholder="New Password"
                           id="password" name="password" required>
                    <label for="password">New Password</label>
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
