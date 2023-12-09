<?php
include_once("component/header.php");
?>

<body>
  <!-- <header class="header"> -->
  <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
    <div class="container">
      <a class="navbar-brand fw-bold fs-2" href="index.php?page=home">
        <span>
          <img src="img/cvIcon.png" alt="" class="img-thumbnail" id="logo" loading="lazy" />
        </span>
        <span class="navbar-brand-text">CV</span> Design
      </a>
      <button type="button" class="btn btn-login btn-primary sm-lg-4 px-4 fs-18 mt-3 mt-lg-0 ms-auto" id="manage-btn">
        <a href="index.php?page=manage-resume" class="text-decoration-none text-white">
          View my CVs
        </a>
      </button>
    </div>
  </nav>
  <!-- </header> -->

  <?php
  if (!isset($_GET["cvID"])) {
    header("Location: component/pageNotFound.php");
    exit();
  } else {
    include_once("utility/util.php");

    $cvID = $_GET["cvID"];
    $db = new DBController();
  ?>
    <main>
      <div class="overlay" id="overlay">
        <div class="popup">
          <span class="close-btn" onclick="closePopup()">&times;</span>
          <div id="formContainer"></div>
        </div>
      </div>
      <div class="py-4">
        <?php include_once("snippet/update-aboutSectionCard.html"); ?>
      </div>
      <div class="py-4">
        <?php include_once("snippet/update-phoneNo.html"); ?>
      </div>
      <div class="py-4">
        <?php include_once("snippet/update-email.html"); ?>
      </div>
      <div class="py-4">
        <?php include_once("snippet/update-education.html"); ?>
      </div>
      <div class="py-4">
        <?php include_once("snippet/update-workExp.html"); ?>
      </div>
      <div class="py-4">
        <?php include_once("snippet/update-certification.html"); ?>
      </div>
      <div class="py-4">
        <?php include_once("snippet/update-award.html"); ?>
      </div>
      <div class="py-4">
        <?php include_once("snippet/update-activity.html"); ?>
      </div>
      <div class="py-4">
        <?php include_once("snippet/update-socialLink.html"); ?>
      </div>
      <div class="py-4">
        <?php include_once("snippet/update-language.html"); ?>
      </div>
    </main>
    <hr />
</body>
<?php } ?>
<?php
include_once("view/updateResume-controller.php");
include_once("component/footer.php");
?>