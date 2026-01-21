<?php

//get all countries and cities for the form

/** @var mysqli $mysqli */
/** @var SchoolRepository $schoolRepository */

use domain\Location;
use lib\SchoolRepository;

$countries = Location::getAllCountries($mysqli);
$cities = Location::getAllCities($mysqli);
?>

<div class="modal fade" id="suggestModal" tabindex="-1" aria-labelledby="suggestModalLabel" aria-hidden="true">
    <form method="GET" action="/school/suggest">
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
                        <select class="form-select" id="countrySelect" name="country" aria-label="Select country">
                            <?php foreach ($countries as $country): ?>
                                <option value="<?= $country['id'] ?>">
                                    <?= $country['name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <label for="countrySelect">Country</label>
                    </div>
                    <div class="form-floating">
                        <input list="cityList" name="city" class="form-control"
                               placeholder="City" required>
                        <label for="city">City</label>
                        <datalist id="countyList">
                            <?php foreach (Location::getAllCities($mysqli) as $city): ?>
                                <option value="<?= htmlspecialchars($city['name']) ?>">
                            <?php endforeach; ?>
                        </datalist>
                    </div>
                    <div class="form-floating">
                        <input type="number" class="form-control" id="studentCount" value="0"
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