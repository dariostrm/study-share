<?php
require_once __DIR__ . '/../domain/Degree.php';

use Domain\Degree;

/** @var Degree $degree */
/** @var int $schoolId */
?>

<a href="<?php echo "/school/" . $schoolId . "/degree/" . $degree->id ?>" class="btn btn-dark border w-100 p-0">
    <div class="container p-0">
        <div class="row">
            <div class="col">
                <div class="d-flex flex-column align-items-start px-4 py-3">
                    <h4><?php echo htmlspecialchars($degree->name); ?></h4>
                    <div class="my-1 d-flex align-items-center gap-2 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock-icon lucide-clock">
                            <path d="M12 6v6l4 2" />
                            <circle cx="12" cy="12" r="10" />
                        </svg>
                        <p class="text-muted my-0"><?php echo htmlspecialchars($degree->semesterCount . ' semesters'); ?></p>
                    </div>
                    <div class="my-1 d-flex align-items-center gap-2 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users-icon lucide-users">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                            <path d="M16 3.128a4 4 0 0 1 0 7.744" />
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                            <circle cx="9" cy="7" r="4" />
                        </svg>
                        <p class="text-muted my-0"><?php echo htmlspecialchars($degree->studentCount . ' students'); ?></p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</a>