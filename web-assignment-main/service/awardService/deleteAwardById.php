<?php
include_once "../../utility/util.php";
if (!isset($_POST["id"])) {
    errorResponse("Missing id of award");
    exit;
}
$id = $_POST["id"];

$db = new DBController();
$db->runQueryNoResult('delete from award where id = ?;', 'i', [$id]);
?>