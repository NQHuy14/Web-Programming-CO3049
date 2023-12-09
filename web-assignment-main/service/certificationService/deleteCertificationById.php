<?php
include_once "../../utility/util.php";
if (!isset($_POST["id"])) {
    errorResponse("Missing id of certification");
    exit;
}
$id = $_POST["id"];

$db = new DBController();
$db->runQueryNoResult('delete from certification where id = ?;', 'i', [$id]);
?>