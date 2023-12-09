<?php
include_once "../../utility/util.php";
if(!isset($_GET["userID"])) {
    errorResponse("Missing userID");
    exit;
}
$userID = $_GET["userID"];
$db = new DBController();
$db->runQueryJSON('select * from cv where userID = ?;', 'i', [$userID]);
?>