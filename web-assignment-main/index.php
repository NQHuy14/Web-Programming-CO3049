<?php
session_start();


include("./utility/database.php");


// Define an array of valid pages and their corresponding file names
$validPages = [
    'home' => 'view/home.php',
    'create-resume' => 'view/createResume.php',
    'update-resume' => 'view/updateResume.php',
    'login-register' => 'view/login-register.php',
    'manage-resume' => 'view/manageResume.php'

    // Add more pages as needed
    // name => path to file
    // example: 'create-cv' => 'cv/create-cv-view.php'
];

// Get the requested page from the query parameter
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Check if the requested page is valid; if not, use a default page
if(array_key_exists($page, $validPages)) {
    require_once($validPages[$page]);
} else {
    require_once('home.php'); // Create a default page or handle the error as needed
}
?>