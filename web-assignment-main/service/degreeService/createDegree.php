<?php
include_once "../../utility/util.php";
if (
    !isset($_POST["school"])
    || !isset($_POST["major"])
    || !isset($_POST["gpa"])
    || !isset($_POST["startYear"])
    || !isset($_POST["endYear"])
    || !isset($_POST["cvID"])
) {
    errorResponse("Missing some data of degree");
    exit;
}
$school = validate_data($_POST["school"]);
$major = validate_data($_POST["major"]);
$gpa = $_POST["gpa"];
$startYear = $_POST["startYear"];
$endYear = $_POST["endYear"];
$cvID = $_POST["cvID"];

if (empty($school)) {
    errorResponse("Invalid school name");
    exit;
}
if (empty($major)) {
    errorResponse("Invalid major name");
    exit;
}
if (!is_numeric($gpa) || $gpa > 10 || $gpa < 0) {
    errorResponse("GPA must be a number, from 0 to 10");
    exit;
}
if (!is_numeric($startYear) || !is_numeric($endYear) || $startYear > $endYear) {
    errorResponse("Year must be a number and endYear is greater than startYear");
    exit;
}

$db = new DBController();
$db->runQueryNoResult('insert into degree(school, major, gpa, startYear, endYear, cvID) value (?, ?, ?, ?, ?, ?);', 'ssdiii', [$school, $major, round($gpa, 2), $startYear, $endYear, $cvID]);
?>