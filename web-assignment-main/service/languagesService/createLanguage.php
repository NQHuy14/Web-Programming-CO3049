<?php
include_once "../../utility/util.php";
if (!isset($_POST["lang"]) || !isset($_POST["cvID"])) {
    errorResponse("Missing language or cvID");
    exit;
}
$lang = validate_data($_POST["lang"]);
$cvID = $_POST["cvID"];

if (empty($lang)) {
    errorResponse("Invalid language");
    exit;
}

$db = new DBController();
$db->runQueryNoResult('insert into languages(lang, cvID) value (?, ?);', 'si', [$lang, $cvID]);
?>