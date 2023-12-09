<?php
include_once "../../utility/util.php";
if (!isset($_POST["id"])) {
    errorResponse("Missing id of activity");
    exit;
}
$id = $_POST["id"];

$db = new DBController();
$db->runQueryNoResult('delete from activity where id = ?;', 'i', [$id]);
?>