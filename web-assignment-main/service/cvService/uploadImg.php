<?php
include_once "../../utility/util.php";
if(!isset($_POST["cvID"])) {
    errorResponse("Missing cvID");
    exit;
}
if(empty($_FILES["file"]["name"])) {
    errorResponse("Missing upload file");
    exit;
}
$cvID = $_POST["cvID"];
$db = new DBController();
$isExistedCV = $db->runQuery('select * from cv where cv.id = ?;', 'i', [$cvID]);
if(!$isExistedCV) {
    errorResponse("CV is not existed");
    exit;
}

$uploadDir = "../../public/uploads/";
if(!file_exists($uploadDir)) {
    try {
        mkdir($uploadDir, 0777, true);
    } catch (Exception $e) {
        errorResponse($e->getMessage());
    }
}

$filename = "img-cv-".$cvID.".png";
$uploadPath = $uploadDir.$filename;
$fileTmpName = $_FILES["file"]["tmp_name"];

try {
    move_uploaded_file($fileTmpName, $uploadPath);

} catch (Exception $e) {
    errorResponse($e->getMessage());
}

$db->runQueryNoResult('update cv set img = ? where cv.id = ?', 'si', [$filename, $cvID]);
?>