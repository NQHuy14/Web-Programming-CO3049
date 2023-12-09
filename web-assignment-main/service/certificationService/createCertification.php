<?php
include_once "../../utility/util.php";
// session_start();
if (
    !isset($_POST["year"])
    || !isset($_POST["detail"])
    || !isset($_POST["cvID"])
) {
    errorResponse("Missing some data of certification");
    exit;
}
$detail = validate_data($_POST["detail"]);
$year = $_POST["year"];
$cvID = $_POST["cvID"];

if (empty($detail)) {
    errorResponse("Invalid detail of certification");
    exit;
}
if (!is_numeric($year)) {
    errorResponse("Year must be a number");
    exit;
}

$db = new DBController();
$db->runQueryNoResult('insert into certification(year, detail, cvID) value (?, ?, ?);', 'isi', [$year, $detail, $cvID]);
