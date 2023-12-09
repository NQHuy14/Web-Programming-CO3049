<?php
include_once "../../utility/util.php";
if(!isset($_POST["id"])){
    errorResponse("Missing id of socialLink");
    exit;
}
$id = $_POST["id"];

$db = new DBController();
$db->runQueryNoResult('delete from socialLink where id = ?;', 'i', [$id]);
?>