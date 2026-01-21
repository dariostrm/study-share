<?php

use domain\Session;
use lib\SchoolRepository;
use domain\Note;

/** @var Session $session */
/** @var SchoolRepository $schoolRepository */
if (!isset($session)) {
    header('Location: /login');
    exit;
}

if (isset($_POST['uploadNote'])) {
    $title = htmlspecialchars($_POST['title']);
    $subject = htmlspecialchars($_POST['subject']);
    $grade = (int)$_POST['grade'];
    $description = htmlspecialchars($_POST['description'] ?? '');

    // Handle file upload
    if (isset($_FILES['noteFile']) && $_FILES['noteFile']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['noteFile']['tmp_name'];
        $fileName = $_FILES['noteFile']['name'];
        $fileSize = $_FILES['noteFile']['size'];
        $fileType = $_FILES['noteFile']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Allowed file extensions
        $allowedfileExtensions = ['pdf', 'docx', 'pptx', 'md', 'txt'];

        if (in_array($fileExtension, $allowedfileExtensions)) {
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $relativePath = '/uploads/' . $newFileName;
            $absolutePath = realpath(__DIR__ . "/../public") . $relativePath;

            $uploadFileDir = dirname($absolutePath);
            if (!is_dir($uploadFileDir)) {
                mkdir($uploadFileDir, 0755, true);
            }

            if (move_uploaded_file($fileTmpPath, $absolutePath)) {
                // Save note to database
                $success = $session->degree->addNote($title, $description, $session->user->id, $relativePath, $subject, $grade);
                if ($success) {
                    header('Location: /browse');
                    exit;
                } else {
                    $uploadNoteError = 'Error saving note to database.';
                }
            } else {
                $uploadNoteError = 'Error moving the uploaded file.';
            }
        } else {
            $uploadNoteError = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
        }
    } else {
        $uploadNoteError = 'No file uploaded or there was an upload error.';
    }
}

$uploadNoteError = '';

$degreeNotes = $session->degree->getNotes();
$subjects = array_map(fn($note) => $note->subject, $degreeNotes);
?>

<div class="container h-100">
    <div class="row h-100 d-flex flex-column justify-content-center align-items-center">
        <div class="card col-10 col-md-8 col-lg-6 col-xl-4 bg-dark-subtle p-4 rounded-4">
            <div class="card-body d-flex flex-column align-items-center gap-1 w-100">
                <h2>Upload Note</h2>
                <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post" class="d-flex flex-column gap-3 w-100" enctype="multipart/form-data">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="title"
                            name="title" placeholder="Title" required>
                        <label for="title">Title</label>
                    </div>
                    <div class="form-floating">
                        <input list="subjectList" name="subject" class="form-control"
                            placeholder="Subject" required>
                        <label for="subject">Subject</label>
                        <datalist id="subjectList">
                            <?php foreach ($subjects as $subject): ?>
                                <option value="<?= htmlspecialchars($subject) ?>">
                                <?php endforeach; ?>
                        </datalist>
                    </div>
                    <div class="form-floating">
                        <input type="number" class="form-control" id="grade"
                            name="grade" placeholder="Grade/Semester" min="1" max="<?php echo $session->degree->gradeCount ?>" required>
                        <label for="grade">Grade/Semester</label>
                    </div>
                    <div>
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" rows="3" name="description"></textarea>
                    </div>

                    <!-- File upload -->
                    <div>
                        <label for="noteFile" class="form-label">Upload Note (.pdf, .docx, .pptx, .md, .txt)</label>
                        <input class="form-control" type="file" id="noteFile" name="noteFile" accept=".pdf,.docx,.pptx,.md,.txt" required>
                    </div>

                    <?php if ($uploadNoteError): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $uploadNoteError ?>
                        </div>
                    <?php endif; ?>

                    <button type="submit" name="uploadNote" class="btn btn-primary mt-4">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>