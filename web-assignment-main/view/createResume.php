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
      <button type="button" class="btn-login btn btn-danger ms-lg-4 px-4 fs-18 mt-3 mt-lg-0" id="logout-btn">
        <a href="" class="text-decoration-none text-white">
          Sign out
        </a>
      </button>
    </div>
  </nav>
  <!-- </header> -->

  <main>
    <section id="about-sc" class="">
      <div class="container">
        <div class="about-cnt">
          <form action="" class="cv-form" id="cv-form">
            <div>
              <?php include_once("snippet/aboutSection.html"); ?>
            </div>
            <div>
              <?php include_once("snippet/phoneNo.html"); ?>
            </div>
            <div>
              <?php include_once("snippet/email.html"); ?>
            </div>
            <div>
              <?php include_once("snippet/socialLink.html"); ?>
            </div>

            <div id="certificationForm">
              <?php include_once("snippet/certification.html"); ?>
            </div>
            <div id="awardForm">
              <?php include_once("snippet/award.html"); ?>
            </div>
            <div id="educationForm">
              <?php include_once("snippet/education.html"); ?>
            </div>
            <div id="projectForm">
              <?php include_once("snippet/workExp.html"); ?>

            </div>
            <div id="activityForm">
              <?php include_once("snippet/activity.html"); ?>
            </div>
            <div id="languageForm">
              <?php include_once("snippet/language.html"); ?>
            </div>

            <div class="d-flex justify-content-end">
              <button type="button" class="btn btn-info" id="submit-btn">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </section>
  </main>
  <hr />
  <script>
    if (getCookie('userID') === "") {
      document.location.replace('home.php');
    }

    document.getElementById("logout-btn").addEventListener('click', function () {
      document.cookie = `${'userID'}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
      document.cookie = `${'username'}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
      document.location.replace('home.php');
    });
  </script>
</body>

<?php
include_once("view/createResume-controller.php");
include_once("component/footer.php");
?>