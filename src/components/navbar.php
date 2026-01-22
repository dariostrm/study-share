<?php
//the isLoggedIn variable is defined in index.php
/** @var bool $isLoggedIn */

//the route variable is defined in index.php
/** @var string $page */

/** @var Session $session */

use domain\Session;

?>

<nav class="navbar navbar-expand-lg p-3">
    <div class="container-fluid">
        <a class="navbar-brand d-lg-none" href="#">
            <img src="/images/logo.svg" alt="Logo" width="35" class="d-inline-block align-text-top img-fluid">
            Study Share
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navItemContainer" aria-controls="navItemContainer" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse row-cols-lg-3" id="navItemContainer">
            <ul class="navbar-nav col-lg order-lg-1">
                <a class="navbar-brand d-lg-block d-none" href="#">
                    <img src="/images/logo.svg" alt="Logo" width="35" class="d-inline-block align-text-top img-fluid">
                    Study Share
                </a>
                <li class="nav-item">
                    <a href="/home"
                       class="nav-link <?php echo $page === 'home' ? 'active' : ''; ?>">
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/browse"
                       class="nav-link <?php echo $page === 'browse' ? 'active' : ''; ?>">
                        Browse
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav col-lg order-lg-last d-lg-flex justify-content-end">
                <?php if (!isset($session)): ?>
                    <li class="nav-item">
                        <a href="/login"
                           class="nav-link <?php echo $page === 'login' ? 'active' : ''; ?>">
                            Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/sign-up"
                           class="nav-link <?php echo $page === 'sign-up' ? 'active' : ''; ?>">
                            Sign Up
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a href="/profile"
                           class="nav-link <?php echo $page === 'profile' ? 'active' : ''; ?>">
                            Profile
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/logout" class="nav-link link-danger">
                            Logout
                        </a>
                    </li>
                <?php endif; ?>
                <?php
                if (isset($session) && $session->user->isAdmin): ?>
                    <li class="nav-item">
                        <a href="/admin/schools"
                           class="nav-link link-primary <?php echo $page === 'admin' ? 'active' : ''; ?>">
                            Admin
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
            <form class="d-flex col-lg order-lg-2" role="search" action="browse" method="GET">
                <input class="form-control me-2" name="query" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-primary" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>