<?php
include_once "../../utility/util.php";
if (!isset($_POST["cvID"])) {
    errorResponse("Missing cvID");
    exit;
}
$cvID = $_POST["cvID"];

$db = new DBController();
$db->runQueryNoResult('delete from cv where cv.id = ?;', 'i', [$cvID]);
