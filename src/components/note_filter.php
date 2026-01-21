<?php
/** @var string $page */
?>

<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="/<?= htmlspecialchars($page) ?>">
            <div class="row g-3">
                <!-- Text Search -->
                <div class="col-12 col-md-6 col-lg-3">
                    <label for="search" class="form-label">Search</label>
                    <input type="text" class="form-control" id="search" name="search"
                           placeholder="Search notes..."
                           value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                </div>

                <!-- Subject Filter -->
                <div class="col-12 col-md-6 col-lg-3">
                    <label for="subject" class="form-label">Subject</label>
                    <input type="text" class="form-control" id="subject" name="subject"
                           placeholder="e.g. Math, Physics"
                           value="<?= htmlspecialchars($_GET['subject'] ?? '') ?>">
                </div>

                <!-- Grade Filter -->
                <div class="col-12 col-md-6 col-lg-3">
                    <label for="grade" class="form-label">Grade</label>
                    <input type="number" class="form-control" id="grade" name="grade"
                           placeholder="Grade number" min="1"
                           value="<?= htmlspecialchars($_GET['grade'] ?? '') ?>">
                </div>

                <!-- Date Filter -->
                <div class="col-12 col-md-6 col-lg-3">
                    <label for="date_range" class="form-label">Date</label>
                    <select class="form-select" id="date_range" name="date_range">
                        <option value="">All time</option>
                        <option value="today" <?= ($_GET['date_range'] ?? '') === 'today' ? 'selected' : '' ?>>Today</option>
                        <option value="week" <?= ($_GET['date_range'] ?? '') === 'week' ? 'selected' : '' ?>>This week</option>
                        <option value="month" <?= ($_GET['date_range'] ?? '') === 'month' ? 'selected' : '' ?>>This month</option>
                        <option value="year" <?= ($_GET['date_range'] ?? '') === 'year' ? 'selected' : '' ?>>This year</option>
                    </select>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="/<?= htmlspecialchars($page) ?>" class="btn btn-outline-secondary">Clear</a>
                </div>
            </div>
        </form>
    </div>
</div>
