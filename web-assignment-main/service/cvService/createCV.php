<?php
include_once "../../utility/util.php";

// session_start();
if (!isset($_POST["userID"])) {
    errorResponse("Missing userID");
    exit;
}
$userID = $_POST["userID"];

$title = rand(1, 10000);
// $userID = 1;

$db = new DBController();
$db->runQueryNoResult2('insert into cv (userID, title) value (?, ?);', 'is', [$userID, $title]);
$db->runQueryJSON('select id from cv where title = ?', 's', [$title]);
$db->runQueryNoResult2('update cv set title = NULL where title = ?', 's', [$title]);
?>