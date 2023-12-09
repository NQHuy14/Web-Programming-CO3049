<?php
include_once "../../utility/util.php";
if(!isset($_GET["cvID"])){
    errorResponse("Missing cvID");
    exit;
}
$cvID = $_GET["cvID"];
$db = new DBController();
$db -> runQueryJSON('select * from languages where cvID = ?;', 'i', [$cvID]);
?>