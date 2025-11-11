<?php

?>

<div class="d-flex flex-column justify-content-center align-items-center vh-100">
    <div class="card bg-dark-subtle px-3 py-4 rounded-4">
        <div class="card-body d-flex flex-column align-items-center gap-1">
            <h2>Sign Up</h2>
            <p class="text-muted">
                Already have an account? <a href="/login">Login</a>
            </p>
            <form action="./sign-up-page.php" method="post" class="d-flex flex-column gap-3">
                <div class="form-floating">
                    <input type="text" class="form-control" id="username"
                           name="username" placeholder="username" required>
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

                <button type="submit" class="btn btn-primary mt-4">Sign Up</button>
            </form>
        </div>
    </div>
</div>
