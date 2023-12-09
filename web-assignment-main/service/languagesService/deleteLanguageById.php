
<?php
include_once "../../utility/util.php";
if(!isset($_POST["id"])){
    errorResponse("Missing id of language");
    exit;
}
$id = $_POST["id"];

$db = new DBController();
$db->runQueryNoResult('delete from languages where id = ?;', 'i', [$id]);
?>