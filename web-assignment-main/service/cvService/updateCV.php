<?php
include_once "../../utility/util.php";
if(
    !isset($_POST["fname"])
    || !isset($_POST["lname"])
    || !isset($_POST["title"])
    || !isset($_POST["gender"])
    || !isset($_POST["dob"])
    || !isset($_POST["location"])
    || !isset($_POST["objective"])
    || !isset($_POST["hobby"])
    || !isset($_POST["cvID"])
) {
    errorResponse("Missing some cv data");
    exit;
}

if(
    empty($_POST["fname"])
    || empty($_POST["lname"])
    || empty($_POST["title"])
    || empty($_POST["gender"])
    || empty($_POST["dob"])
    || empty($_POST["location"])
    || empty($_POST["objective"])
    || empty($_POST["hobby"])
    || empty($_POST["cvID"])
) {
    errorResponse("empty some cv data");
    exit;
}

$fname = validate_data($_POST["fname"]);
$lname = validate_data($_POST["lname"]);
$title = validate_data($_POST["title"]);
$gender = validate_data($_POST["gender"]);
$dob = validate_data($_POST["dob"]);
$location = validate_data($_POST["location"]);
$objective = validate_data($_POST["objective"]);
$hobby = validate_data($_POST["hobby"]);
$cvID = $_POST["cvID"];

// // Not allowed empty $title only
// if(empty($title)) {
//     errorResponse("Invalid title of CV");
//     exit;
// }

$db = new DBController();
$db->runQueryNoResult(
    'update cv set fname = ?, lname = ?, title = ?, gender = ?, dob = ?, location = ?, objective = ?, hobby = ? where cv.id = ?'
    ,
    'ssssssssi'
    ,
    [$fname, $lname, $title, $gender, $dob, $location, $objective, $hobby, $cvID]
);
?>