<?php
include_once "../../utility/util.php";
if (!isset($_POST["email"]) || !isset($_POST["id"])) {
    errorResponse("Missing email or id");
    exit;
}
$email = validate_data($_POST["email"]);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    errorResponse("Invalid email syntax");
    exit;
}
$id = $_POST["id"];

if (empty($email)) {
    errorResponse("Invalid email syntax");
    exit;
}

$db = new DBController();
$db->runQueryNoResult('update emailAddress set email = ? where emailAddress.id = ?;', 'si', [$email, $id]);
?>