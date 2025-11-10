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
<body data-bs-theme="dark">
    <?php include_once '../components/navbar.php'; ?>

    <?php

    $url = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

    switch($url) {
        case 'home':
        case '': // Default page (if no URL is specified)
            require __DIR__ . '/../pages/home-page.php';
            break;
        case 'login':
            require __DIR__ . '/../pages/login-page.php';
            break;
        default:
            http_response_code(404);
            echo "Page not found";
            break;
    }
    ?>

</body>
</html>