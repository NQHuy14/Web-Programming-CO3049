<?php
include_once "../../utility/util.php";
if(!isset($_POST["numbers"]) || !isset($_POST["id"])){
    errorResponse("Missing numbers or id");
    exit;
}
$numbers = validate_data($_POST["numbers"]);
$id = $_POST["id"];

if(empty($numbers) || !ctype_digit($numbers)){
    errorResponse("Invalid phoneNumber");
    exit;
}

$db = new DBController();
$db->runQueryNoResult('update phoneNumber set numbers = ? where phoneNumber.id = ?;', 'si', [$numbers, $id]);
?>