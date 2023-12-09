<?php
include_once "../../utility/util.php";
if (
    !isset($_POST["year"])
    || !isset($_POST["detail"])
    || !isset($_POST["id"])
) {
    errorResponse("Missing some data of award");
    exit;
}
$detail = validate_data($_POST["detail"]);
$year = $_POST["year"];
$id = $_POST["id"];

if (empty($detail)) {
    errorResponse("Invalid detail");
    exit;
}
if (!is_numeric($year)) {
    errorResponse("Year must be a number");
    exit;
}

$db = new DBController();
$db->runQueryNoResult('update award set detail = ?, year = ? where award.id = ?;', 'sii', [$detail, $year, $id]);
?>