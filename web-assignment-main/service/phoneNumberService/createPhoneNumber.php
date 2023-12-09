<?php
include_once "../../utility/util.php";
if (!isset($_POST["numbers"]) || !isset($_POST["cvID"])) {
    errorResponse("Missing numbers or cvID");
    exit;
}
$numbers = validate_data($_POST["numbers"]);
$cvID = $_POST["cvID"];

if (empty($numbers) || !ctype_digit($numbers)) {
    errorResponse("Invalid phone number");
    exit;
}

$db = new DBController();
$db->runQueryNoResult('insert into phoneNumber(numbers, cvID) value (?, ?);', 'si', [$numbers, $cvID]);
