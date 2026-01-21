<?php

use domain\Note;

if (isset($_POST['delete'])) {
    $noteIdToDelete = $_POST['delete'];
    if (isset($session)) {
        /** @var Note $note */
        $note = $session->degree->getNoteById($noteIdToDelete);
        if (($note->user->id === $session->user->id || $session->user->isAdmin)) {
            $session->degree->removeNote($noteIdToDelete);
            $absoluteFilePath = __DIR__ . '/../public' . $note->filePath;
            unlink($absoluteFilePath); // Delete the file from the server
            header("Location: /school/" . $note->degree->school->id . "/degree/" . $note->degree->id);
            exit;
        }
    }
}
