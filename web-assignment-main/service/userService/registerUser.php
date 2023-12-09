<?php
include_once "../../utility/util.php";
if(!isset($_POST["username"]) || !isset($_POST["password"]) || !isset($_POST["confirm-password"])) {
    errorResponse("Missing username or password or confirm password");
    exit;
}

$username = validate_data($_POST["username"]);
$password = validate_data($_POST["password"]);
$confirmPassword = validate_data($_POST["confirm-password"]);

if(empty($username) || empty($password) || empty($confirmPassword)) {
    errorResponse("Invalid username or password or confirm password");
    exit;
}

if($password !== $confirmPassword) {
    errorResponse("Unmatched password");
    exit;
}

$db = new DBController();
$isExistedUsername = $db->runQuery('select * from user where username = ?', 's', [$username]);
if($isExistedUsername) {
    errorResponse("Username is already existed. Please try again!");
    exit;
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);


$db->runQueryNoResult('insert into user (username, password) value (?, ?);', 'ss', [$username, $hashedPassword]);
?>