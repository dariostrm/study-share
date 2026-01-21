<?php
use domain\Note;

/** @var Note $note */
?>

<div class="card" style="width: 18rem;">
    <div class="card-body">
        <span class="badge text-bg-success mb-2">
            <?= $note->subject ?>
        </span>
        <span class="badge text-bg-secondary mb-2">
            <?= $note->grade ?>
        </span>
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