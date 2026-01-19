<?php

use Lib\SchoolRepository;
use Domain\School;
use Domain\Degree;
use Domain\Note;

/** @var bool $isLoggedIn */
/** @var SchoolRepository $schoolRepository */
if (!$isLoggedIn) {
    header('Location: /login');
    exit;
}

if (isset($_POST['uploadNote'])) {
    // Handle the note upload logic here
    header('Location: /home');
    exit;
}

$uploadNoteError = '';
$date = date('Y-m-d');

$schoolId = $_SESSION['schoolId'];
$degreeId = $_SESSION['degreeId'];

$school = $schoolRepository->getSchoolById($schoolId);
$degree = $school?->getDegreeById($degreeId);
if ($degree === null) {
    header('Location: /home');
    exit;
}

$degreeNotes = $degree->getNotes();
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
                        <input type="date" class="form-control" id="date"
                            name="date" placeholder="Date" value="<?php echo $date ?>" max="<?php echo $date ?>" required>
                        <label for="date">Date</label>
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
                            name="grade" placeholder="Grade/Semester" min="1" max="<?php echo $degree->gradeCount ?>" required>
                        <label for="grade">Grade/Semester</label>
                    </div>
                    <div>
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" rows="3" name="description"></textarea>
                    </div>

                    <!-- File upload -->
                    <div>
                        <label for="noteFile" class="form-label">Upload Note (.pdf, .docx, .pptx, .md, .txt)</label>
                        <input class="form-control" type="file" id="noteFile" name="noteFile">
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