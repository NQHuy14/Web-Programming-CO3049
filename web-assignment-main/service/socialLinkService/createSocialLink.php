<?php
include_once "../../utility/util.php";
if (!isset($_POST["link"]) || !isset($_POST["cvID"])) {
    errorResponse("Missing link or cvID");
    exit;
}
$link = validate_data($_POST["link"]);
$cvID = $_POST["cvID"];

if (empty($link)) {
    errorResponse("Invalid social link");
    exit;
}

$db = new DBController();
$db->runQueryNoResult('insert into socialLink(link, cvID) value (?, ?);', 'si', [$link, $cvID]);
