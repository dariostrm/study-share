<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['suggest_school'])) {
    $name = htmlspecialchars($_POST['name']);
    $country = htmlspecialchars($_POST['country']);
    $city = htmlspecialchars($_POST['city']);
    $studentCount = htmlspecialchars($_POST['studentCount']);

    //validate form
    if (empty($name) || empty($country) || empty($city) || empty($studentCount)) {
        //display error somewhere
    }

    //db stuff
}
?>

<div class="modal fade" id="suggestModal" tabindex="-1" aria-labelledby="suggestModalLabel" aria-hidden="true">
    <form method="POST">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="suggestModalLabel">Suggest a new School</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex flex-column gap-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="name"
                            name="name" placeholder="Name" required>
                        <label for="name">Name</label>
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control" id="country"
                            name="country" placeholder="Country" required>
                        <label for="country">Country</label>
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control" id="city"
                            name="city" placeholder="City" required>
                        <label for="city">City</label>
                    </div>
                    <div class="form-floating">
                        <input type="number" class="form-control" id="studentCount"
                            name="studentCount" placeholder="Student Count" min="0" max="1000000">
                        <label for="studentCount">Student Count</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="suggest_school" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>