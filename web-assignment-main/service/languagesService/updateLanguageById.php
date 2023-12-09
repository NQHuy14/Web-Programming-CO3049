<?php
include_once "../../utility/util.php";
if(!isset($_POST["lang"]) || !isset($_POST["id"])){
    errorResponse("Missing language or id");
    exit;
}
$lang = validate_data($_POST["lang"]);
$id = $_POST["id"];

if(empty($lang)){
    errorResponse("Invalid language");
    exit;
}

$db = new DBController();
$db->runQueryNoResult('update languages set lang = ? where languages.id = ?;', 'si', [$lang, $id]);
?>