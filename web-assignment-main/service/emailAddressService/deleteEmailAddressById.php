<?php
include_once "../../utility/util.php";
if (!isset($_POST["id"])) {
    errorResponse("Missing id of emailAddress");
    exit;
}
$id = $_POST["id"];

$db = new DBController();
$db->runQueryNoResult('delete from emailAddress where id = ?;', 'i', [$id]);
?>