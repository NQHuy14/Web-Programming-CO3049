<?php
include_once "../../utility/util.php";
if(!isset($_POST["link"]) || !isset($_POST["id"])){
    errorResponse("Missing link or id");
    exit;
}
$link = validate_data($_POST["link"]);
$id = $_POST["id"];

if(empty($link)){
    errorResponse("Invalid link");
    exit;
}

$db = new DBController();
$db->runQueryNoResult('update socialLink set link = ? where socialLink.id = ?;', 'si', [$link, $id]);
?>