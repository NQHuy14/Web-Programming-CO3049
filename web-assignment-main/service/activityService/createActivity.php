<?php
include_once "../../utility/util.php";
if (
    !isset($_POST["title"])
    || !isset($_POST["detail"])
    || !isset($_POST["startYear"])
    || !isset($_POST["endYear"])
    || !isset($_POST["cvID"])
) {
    errorResponse("Missing some data of activity");
    exit;
}
$title = validate_data($_POST["title"]);
$detail = validate_data($_POST["detail"]);
$startYear = $_POST["startYear"];
$endYear = $_POST["endYear"];
$cvID = $_POST["cvID"];

if (empty($title)) {
    errorResponse("Invalid title name of activity");
    exit;
}
if (empty($detail)) {
    errorResponse("Invalid detail of activity");
    exit;
}
if (!is_numeric($startYear) || !is_numeric($endYear) || $startYear > $endYear) {
    errorResponse("Year must be a number and endYear is greater than startYear");
    exit;
}

$db = new DBController();
$db->runQueryNoResult('insert into activity(title, detail, startYear, endYear, cvID)  value (?, ?, ?, ?, ?);', 'ssiii', [$title, $detail, $startYear, $endYear, $cvID]);
