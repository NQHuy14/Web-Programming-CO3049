<?php
include_once "../../utility/util.php";
if(!isset($_POST["username"]) || !isset($_POST["password"])) {
    errorResponse("Missing username or password");
    exit;
}

$username = validate_data($_POST["username"]);
$password = validate_data($_POST["password"]);

if(empty($username) || empty($password)) {
    errorResponse("Invalid username or password");
    exit;
}

$db = new DBController();
$user = $db->runQuery('select * from user where username = ?', 's', [$username]);
if($user) {
    if(password_verify($password, $user[0]['password'])) {
        $user = $db->runQuery('select id, username from user where username = ?', 's', [$username]);

        successResponse($user, "Login successfully");
    } else {
        errorResponse("Password is incorrect");
    }
} else {
    errorResponse("Username is incorrect");
}
?>