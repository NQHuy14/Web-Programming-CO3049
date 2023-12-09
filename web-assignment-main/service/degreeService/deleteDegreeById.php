<?php
include_once "../../utility/util.php";
if(!isset($_POST["id"])){
    errorResponse("Missing id of degree");
    exit;
}
$id = $_POST["id"];

$db = new DBController();
$db->runQueryNoResult('delete from degree where id = ?;', 'i', [$id]);
?>