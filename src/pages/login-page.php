<?php

?>

<div class="d-flex flex-column justify-content-center align-items-center vh-100">
    <div class="card bg-dark-subtle px-3 py-4 rounded-4">
        <div class="card-body d-flex flex-column align-items-center gap-1">
            <h2>Login</h2>
            <p class="text-muted">
                First time here? <a href="/sign-up">Sign Up</a>
            </p>
            <form action="./login-page.php" method="post" class="d-flex flex-column gap-3">
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
                <a href="/forgot-password">Forgot Password?</a>

                <button type="submit" class="btn btn-primary mt-4">Login</button>
            </form>
        </div>
    </div>
</div>
