<?php 
use Domain\School;

/** @var School $school */
?>

<div class="btn btn-dark border w-100 d-flex flex-column align-items-start px-4 py-3">
    <h4><?php echo htmlspecialchars($school->name); ?></h4>
    <div class="my-1 d-flex align-items-center gap-2 text-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin-icon lucide-map-pin"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/></svg>
        <p class="text-muted my-0"><?php echo htmlspecialchars($school->city . '/' . $school->country); ?></p>
    </div>
    <div class="my-1 d-flex align-items-center gap-2 text-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users-icon lucide-users"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><path d="M16 3.128a4 4 0 0 1 0 7.744"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><circle cx="9" cy="7" r="4"/></svg>
        <p class="text-muted my-0"><?php echo htmlspecialchars($school->studentCount . ' students'); ?></p>
    </div>
</div>
