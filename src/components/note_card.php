<?php

use domain\Note;
use domain\Session;

/** @var Note $note */
/** @var Session $session */
?>

<div class="card" style="width: 18rem;">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <div>
                <span class="badge text-bg-success mb-2">
                    <?= $note->subject ?>
                </span>
                <span class="badge text-bg-secondary mb-2">
                    <?= $note->grade ?>
                </span>
            </div>
            <?php if (isset($session) && ($note->user->id === $session->user->id || $session->user->isAdmin)): ?>
                <div>
                    <form action="<?= "notes/delete/" . $note->id ?>" method="POST">
                        <button type="submit" name="delete" value="<?= $note->id ?>"
                                class="btn btn-sm btn-outline-danger">Delete
                        </button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
        <h3 class="card-title">
            <?= $note->title ?>
        </h3>
        <small class="text-body-secondary">
            <?= $note->user->username . " - " . $note->date->format("d.m.Y") ?>
        </small>
        <p class="card-text">
            <?= $note->description ?>
        </p>
    </div>
    <div class="card-footer">
        <a href="<?= htmlspecialchars($note->filePath) ?>" download class="btn btn-primary">Download</a>
    </div>
</div>