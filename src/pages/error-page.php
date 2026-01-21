<?php

$error = $_GET['error'];

?>


<div class="container h-100">
    <div class="row h-100 d-flex flex-column justify-content-center align-items-center">
        <div class="card col-10 col-md-8 col-lg-6 col-xl-4 bg-dark-subtle p-4 rounded-4">
            <div class="card-body d-flex flex-column align-items-center gap-3 w-100">
                <h2 class="text-danger">Error</h2>
                <p class="text-muted">
                    <?php
                    echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
                </p>
                <a href="/" class="btn btn-primary mt-4">Go to Home</a>
            </div>
        </div>
    </div>
</div>
