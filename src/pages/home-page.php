<?php

use domain\Session;

/** @var Session $session */
/**
 * @param array $notes
 */
function filterNotes(array $notes): array
{
    $search = $_GET['search'] ?? '';
    $subject = $_GET['subject'] ?? '';
    $grade = $_GET['grade'] ?? '';
    $dateRange = $_GET['date_range'] ?? ''; //today, week, month, year

    //apply filters
    return array_filter($notes, function ($note) use ($search, $subject, $grade, $dateRange) {
        //search (title and description)
        if (!empty($search)) {
            $searchLower = strtolower($search);
            if (stripos($note->title, $searchLower) === false &&
                    stripos($note->description ?? '', $searchLower) === false) {
                return false;
            }
        }
        //subject
        if (!empty($subject) && stripos($note->subject, $subject) === false) {
            return false;
        }
        //grade
        if (!empty($grade) && $note->grade !== (int)$grade) {
            return false;
        }
        //date range
        if (!empty($dateRange)) {
            $now = new DateTime();
            $noteDate = $note->date;
            switch ($dateRange) {
                case 'today':
                    if ($noteDate->format('Y-m-d') !== $now->format('Y-m-d')) {
                        return false;
                    }
                    break;
                case 'week':
                    $weekAgo = (clone($now))->modify('-7 days');
                    if ($noteDate < $weekAgo) {
                        return false;
                    }
                    break;
                case 'month':
                    $monthAgo = (clone($now))->modify('-1 month');
                    if ($noteDate < $monthAgo) {
                        return false;
                    }
                    break;
                case 'year':
                    $yearAgo = (clone($now))->modify('-1 year');
                    if ($noteDate < $yearAgo) {
                        return false;
                    }
                    break;
            }
        }

        return true;
    });
}

if ($session !== null) {
    $degreeNotes = $session->degree->getNotes() ?? [];
    $myNotes = array_filter($degreeNotes, fn($note) => $note->user->id === $session->user->id);

    //filters
    $myNotes = filterNotes($myNotes);
    $degreeNotes = filterNotes($degreeNotes);
}

?>

<div class="container mt-3">
    <?php if ($session === null): ?>
        <div class="row">
            <div class="col-12 d-flex flex-column justify-content-center align-items-center gap-3">
                <h3>Please <a href="/login">login</a> or <a href="/sign-up">sign up</a> to see myNotes of your school
                    and degree.</h3>
                <h5 class="text-muted">Or <a href="/browse">Browse</a> existing schools and degrees.</h5>
            </div>
        </div>
    <?php else: ?>
        <div class="row">
            <?php include '../components/note_filter.php'; ?>
        </div>
        <div class="row">
            <div class="d-flex align-items-center justify-content-between border-bottom pb-1">
                <h2>My Notes</h2>
                <a class="btn btn-primary btn-sm" href="notes/upload">Upload Note</a>
            </div>
            <?php if (empty($myNotes)): ?>
                <p>No notes available.</p>
            <?php endif; ?>
            <?php foreach ($myNotes as $note): ?>
                <div class="col-12 col-md-6 col-lg-4 col-xl-3 my-3 d-flex justify-content-center align-items-stretch">
                    <?php require '../components/note_card.php'; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="row mt-5">
            <div class="d-flex align-items-center justify-content-between border-bottom pb-1">
                <h2><?php echo $session->degree->name; ?> Notes</h2>
            </div>
            <?php if (empty($degreeNotes)): ?>
                <p>No notes available.</p>
            <?php endif; ?>
            <?php foreach ($degreeNotes as $note): ?>
                <div class="col-12 col-md-6 col-lg-4 col-xl-3 my-3 d-flex justify-content-center align-items-stretch">
                    <?php require '../components/note_card.php'; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>