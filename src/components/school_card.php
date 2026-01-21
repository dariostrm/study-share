<?php
use domain\School;

/** @var School $school */
?>

    <div class="container p-0">
        <div class="row">
            <div class="col-4 d-none d-lg-block">
                <div class="bg-primary h-100 p-0 d-flex align-items-center justify-content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-school-icon lucide-school">
                        <path d="M14 21v-3a2 2 0 0 0-4 0v3" />
                        <path d="M18 5v16" />
                        <path d="m4 6 7.106-3.79a2 2 0 0 1 1.788 0L20 6" />
                        <path d="m6 11-3.52 2.147a1 1 0 0 0-.48.854V19a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-5a1 1 0 0 0-.48-.853L18 11" />
                        <path d="M6 5v16" />
                        <circle cx="12" cy="9" r="2" />
                    </svg>
                </div>
            </div>
            <div class="col">
                <div class="d-flex flex-column align-items-start px-4 py-3">
                    <h4><?php echo htmlspecialchars($school->name); ?></h4>
                    <div class="my-1 d-flex align-items-center gap-2 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin-icon lucide-map-pin">
                            <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                            <circle cx="12" cy="10" r="3" />
                        </svg>
                        <p class="text-muted my-0"><?php echo htmlspecialchars($school->location->cityName . '/' . $school->location->countryName); ?></p>
                    </div>
                    <div class="my-1 d-flex align-items-center gap-2 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users-icon lucide-users">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                            <path d="M16 3.128a4 4 0 0 1 0 7.744" />
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                            <circle cx="9" cy="7" r="4" />
                        </svg>
                        <p class="text-muted my-0"><?php echo $school->studentCount <= 0 ? 'Unknown' : ($school->studentCount . ' students'); ?></p>
                    </div>
                </div>

            </div>
        </div>
    </div>