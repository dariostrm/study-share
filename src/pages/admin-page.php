<?php

/** @var Session $session */

use domain\Session;

if (!isset($session) || !$session->user->isAdmin) {
    http_response_code(403);
    echo "Zugriff verweigert. Nur für Administratoren.";
    exit;
}

echo "Hallo admin"

?>