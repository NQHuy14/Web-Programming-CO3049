<?php
include_once "../../utility/util.php";
if(!isset($_POST["id"])){
    errorResponse("Missing id of workExperience");
    exit;
}
$id = $_POST["id"];

$db = new DBController();
$db->runQueryNoResult('delete from workExperience where id = ?;', 'i', [$id]);
?>