<?php
include_once "../../utility/util.php";

if (
    !isset($_POST["year"])
    || !isset($_POST["detail"])
    || !isset($_POST["cvID"])
) {
    errorResponse("Missing some data of award");
    exit;
}
$detail = validate_data($_POST["detail"]);
$year = $_POST["year"];
$cvID = $_POST["cvID"];

if (empty($detail)) {
    errorResponse("Invalid detail of award");
    exit;
}
if (!is_numeric($year)) {
    errorResponse("Year must be a number");
    exit;
}

$db = new DBController();
$db->runQueryNoResult('insert into award(year, detail, cvID) value (?, ?, ?);', 'isi', [$year, $detail, $cvID]);
