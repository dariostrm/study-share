<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyShare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/styles/styles.css">
</head>

<body data-bs-theme="dark" class="d-flex flex-column vh-100">

    <?php
    session_start();

    // Classes are automatically loaded via Composer (a dependency manager for PHP)
    require_once __DIR__ . '/../vendor/autoload.php';
    $db = require_once __DIR__ . '/../lib/db.php';

    use lib\SchoolRepository;

    $schoolRepository = new SchoolRepository($db);

    $isLoggedIn = isset($_SESSION['username']);

    //e.g. http://study-share.site/home will just return home
    $route = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    //e.g. splits /school/5/degree/10 into an array with school,5,degree,10
    $routeSegments = explode('/', $route);
    $page = $routeSegments[0] ?? '';
    ?>

    <?php include_once '../components/navbar.php'; ?>

    <?php
    switch ($page) {
        case 'home':
        case '': // same as home
            require __DIR__ . '/../pages/home-page.php';
            break;
        case 'login':
            require __DIR__ . '/../pages/login-page.php';
            break;
        case 'sign-up':
            require __DIR__ . '/../pages/sign-up-page.php';
            break;
        case 'choose-degree':
            require __DIR__ . '/../pages/choose-degree-page.php';
            break;
        case 'profile':
            require __DIR__ . '/../pages/profile-page.php';
            break;
        case 'logout':
            require __DIR__ . '/../pages/logout-page.php';
            break;
        case 'reset-password':
            require __DIR__ . '/../pages/reset-password-page.php';
            break;
        case 'browse':
            require __DIR__ . '/../pages/browse-page.php';
            break;
        case 'upload':
            require __DIR__ . '/../pages/upload_note_page.php';
            break;
        case 'school':
            $schoolId = $routeSegments[1] ?? null;

            if (!$schoolId) {
                http_response_code(404);
                echo "School not found";
                break;
            }

            // Check if next segment is "degree"
            if (isset($routeSegments[2]) && $routeSegments[2] === 'degree') {
                // Example: /school/5/degree/10
                $degreeId = $routeSegments[3] ?? null;

                if (!$degreeId) {
                    http_response_code(404);
                    echo "Degree not found";
                    break;
                }

                // Nested degree page
                require __DIR__ . '/../pages/degree-details-page.php';
                break;
            }

            // Default: school page
            require __DIR__ . '/../pages/school-details-page.php';
            break;
        default:
            http_response_code(404);
            echo "Page not found";
            break;
    }
    ?>

</body>

</html>