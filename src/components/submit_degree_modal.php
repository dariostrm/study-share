<?php
/** @var int $schoolId */
?>

<div class="modal fade" id="suggestDegreeModal" tabindex="-1" aria-labelledby="suggestDegreeModalLabel" aria-hidden="true">
    <form method="GET" action="/school/<?= $schoolId ?>/degree/suggest">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="suggestDegreeModalLabel">Suggest a new Degree</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex flex-column gap-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="name"
                               name="name" placeholder="Name" required>
                        <label for="name">Name</label>
                    </div>
                    <div class="form-floating">
                        <input type="number" class="form-control" id="gradeCount" value="1"
                               name="gradeCount" placeholder="Grade/Semester Count" min="1" max="100">
                        <label for="gradeCount">Grade/Semester Count</label>
                    </div>
                    <div class="form-floating">
                        <input type="number" class="form-control" id="studentCount" value="0"
                               name="studentCount" placeholder="Student Count" min="0" max="1000000">
                        <label for="studentCount">Student Count</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="suggest_degree" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>