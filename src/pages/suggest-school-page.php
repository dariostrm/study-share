<?php


/** @var mysqli $mysqli */
/** @var SchoolRepository $schoolRepository */

use domain\Location;
use lib\SchoolRepository;

$countries = Location::getAllCountries($mysqli);
$cities = Location::getAllCities($mysqli);

$name = htmlspecialchars($_GET['name']);
$countryId = htmlspecialchars($_GET['country']);
$cityName = htmlspecialchars($_GET['city']);
$studentCount = htmlspecialchars($_GET['studentCount']);

if (!isset($name) || !isset($countryId) || !isset($cityName)) {
    $generalError = 'The school could not be submitted. Please fill in all required fields.';
    header('Location: /error?error=' . urlencode($generalError));
    exit;
}
if (empty($name) || empty($countryId) || empty($cityName)) {
    $generalError = 'The school could not be submitted. Please fill in all required fields.';
    header('Location: /error?error=' . urlencode($generalError));
    exit;
}
// school name unique?
if ($schoolRepository->getSchoolByName($name) !== null) {
    $generalError = 'A school with this name already exists.';
    header('Location: /error?error=' . urlencode($generalError));
    exit;
}
if (!is_numeric($countryId)) {
    $generalError = 'Invalid country selected.';
    header('Location: /error?error=' . urlencode($generalError));
    exit;
}
if (!in_array($countryId, array_column($countries, 'id'))) {
    $generalError = 'Selected country does not exist.';
    header('Location: /error?error=' . urlencode($generalError));
    exit;
}
if (!in_array($cityName, array_column($cities, 'name'))) {
    $generalError = 'Selected city does not exist.';
    header('Location: /error?error=' . urlencode($generalError));
    exit;
}
$citiesInSelectedCountry = Location::getCitiesInCountry($mysqli, $countryId);
if (!in_array($cityName, array_column($citiesInSelectedCountry, 'name'))) {
    $generalError = 'Selected city does not belong to the selected country.';
    header('Location: /error?error=' . urlencode($generalError));
    exit;
}
//citiesInSelectedCountry is an array of associative arrays with 'id' and 'name' keys. Find the id of the selected city.
$cityId = null;
foreach ($citiesInSelectedCountry as $city) {
    if ($city['name'] === $cityName) {
        $cityId = $city['id'];
        break;
    }
}
if ($cityId === null) {
    $generalError = 'Selected city does not exist.';
    header('Location: /error');
    exit;
}

$stCount = !empty($studentCount) && (int)$studentCount > 0 ? (int)$studentCount : null;
$success = $schoolRepository->addSchool($name, $cityId, $stCount);
if ($success) {
    header('Location: /home');
    exit;
} else {
    $generalError = 'An error occurred while submitting the school suggestion. Please try again later.';
    header('Location: /error');
    exit;
}
