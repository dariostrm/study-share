<?php

use domain\Session;

$noteId = $_GET['id'] ?? null;
if (!$noteId) {
    http_response_code(400);
    exit('Invalid request');
}

if (!isset($session)) {
    http_response_code(403);
    exit('Unauthorized');
}

// Fetch note from database
/** @var Session $session */
$note = $session->degree->getNoteById((int)$noteId);
if (!$note || !file_exists($note->filePath)) {
    http_response_code(404);
    exit('File not found');
}

$filename = basename($note->filePath);
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Content-Length: ' . filesize($note->filePath));
readfile($note->filePath);
exit;
