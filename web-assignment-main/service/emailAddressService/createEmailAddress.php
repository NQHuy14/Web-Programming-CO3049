<?php
include_once "../../utility/util.php";

if (!isset($_POST["email"])) {
    errorResponse("Missing email");
    exit;
}

if (!isset($_POST["email"]) || !isset($_POST["cvID"])) {
    errorResponse("Missing email or cvID");
    exit;
}
$email = validate_data($_POST["email"]);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    errorResponse("Invalid email syntax");
    exit;
}
$cvID = $_POST["cvID"];

if (empty($email)) {
    errorResponse("Invalid email syntax");
    exit;
}

$db = new DBController();
$db->runQueryNoResult('insert into emailAddress(email, cvID) value (?, ?);', 'si', [$email, $cvID]);
