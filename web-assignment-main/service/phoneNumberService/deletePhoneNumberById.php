<?php
include_once "../../utility/util.php";
if(!isset($_POST["id"])){
    errorResponse("Missing id of phoneNumber");
    exit;
}
$id = $_POST["id"];

$db = new DBController();
$db->runQueryNoResult('delete from phoneNumber where id = ?;', 'i', [$id]);
?>