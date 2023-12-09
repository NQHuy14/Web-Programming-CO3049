<?php
include_once "../../utility/util.php";
if(!isset($_POST["company"]) 
|| !isset($_POST["title"])
|| !isset($_POST["detail"])
|| !isset($_POST["startYear"])
|| !isset($_POST["endYear"])
|| !isset($_POST["id"])
){
    errorResponse("Missing some data of workExperience");
    exit;
}
$company = validate_data($_POST["company"]);
$title = validate_data($_POST["title"]);
$detail = validate_data($_POST["detail"]);
$startYear = $_POST["startYear"];
$endYear = $_POST["endYear"];
$id = $_POST["id"];

if (empty($company)){
    errorResponse("Invalid company name");
    exit;
}
if (empty($title)){
    errorResponse("Invalid title name");
    exit;
}
if(empty($detail)){
    errorResponse("Invalid detail");
    exit;
}
if(!is_numeric($startYear) || !is_numeric($endYear) || $startYear > $endYear){
    errorResponse("Year must be a number and endYear is greater than startYear");
    exit;
}

$db = new DBController();
$db->runQueryNoResult('update workExperience set company = ?, title = ?, detail = ?, startYear = ?, endYear = ? where workExperience.id = ?;', 'sssiii', [$company, $title, $detail, $startYear, $endYear, $id]);
?>