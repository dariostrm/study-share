<?php

use domain\Note;
use domain\Session;

if (isset($_POST['delete'])) {
    $noteIdToDelete = (int)$_POST['delete'];
    /** @var $schoolRepository */
    /** @var $schoolId */
    $school = $schoolRepository->getSchoolById($schoolId);
    /** @var $degreeId */
    $degree = $school->getDegreeById($degreeId);
    $note = $degree->getNoteById($noteIdToDelete);
    if (isset($session) && ($note->user->id === $session->user->id || $session->user->isAdmin)) {
        $degree->removeNote($noteIdToDelete);
        $absoluteFilePath = __DIR__ . '/../public' . $note->filePath;
        unlink($absoluteFilePath); // Delete the file from the server
        header("Location: /school/" . $school->id . "/degree/" . $degree->id);
        exit;
    } else {
        $error = "You do not have permission to delete this note.";
        header("Location: /error?error=" . urlencode($error));
        exit;
    }
}
