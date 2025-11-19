<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyShare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
     <link rel="stylesheet" href="/styles/styles.css">
     <script src="script.js"></script>
</head>

<body data-bs-theme="dark" class="d-flex flex-column vh-100">

    <?php
    session_start();
    $isLoggedIn = isset($_SESSION['user_id']);

    //parse_url extracts the url path
    //e.g. http://study-share.site/home will just return home (it will cut off the domain)
    $route = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    //split into segments by /
    $routeSegments = explode('/', $route);
    $page = $routeSegments[0] ?? '';
    ?>

    <?php include_once '../components/navbar.php'; ?>

    <?php
    switch ($page) {
        case 'home':
        case '': // Default page (if no URL is specified)
            require __DIR__ . '/../pages/home-page.php';
            break;
        case 'login':
            require __DIR__ . '/../pages/login-page.php';
            break;
        case 'sign-up':
            require __DIR__ . '/../pages/sign-up-page.php';
            break;
        case 'profile':
            require __DIR__ . '/../pages/profile-page.php';
            break;
        case 'logout':
            require __DIR__ . '/../pages/logout-page.php';
            break;
        case 'forgot-password':
            require __DIR__ . '/../pages/forgot-password-page.php';
            break;
        case 'browse':
            require __DIR__ . '/../pages/browse-page.php';
            break;
        case 'schools':
            // Handle school details page
            $schoolId = $routeSegments[1] ?? null;
            if ($schoolId) {
                require __DIR__ . '/../pages/school-details-page.php';
            } else {
                http_response_code(404);
                echo "School not found";
            }
            break;
        case 'degrees':
            // Handle degree details page
            $degreeId = $routeSegments[1] ?? null;
            if ($degreeId) {
                require __DIR__ . '/../pages/degree-details-page.php';
            } else {
                http_response_code(404);
                echo "Degree not found";
            }
            break;
        default:
            http_response_code(404);
            echo "Page not found";
            break;
    }
    ?>

</body>

</html>