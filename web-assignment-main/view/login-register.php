<?php
include_once("component/header.php");
?>
<!-- <header class="header"> -->
<nav class="navbar navbar-expand-lg navbar-light bg-secondary">
  <div class="container">
    <a class="navbar-brand fw-bold fs-2" href="index.php?page=home">
      <span>
        <img src="img/cvIcon.png" alt="" class="img-thumbnail" id="logo" loading="lazy" />
      </span>
      <span class="navbar-brand-text">CV</span> Design
    </a>
  </div>
</nav>
<!-- </header> -->
<section class="vh-100" style="background-color:#eee;">
  <div class="container py-3" id="loginRegister">
    <div class="row d-flex justify-content-center align-items-center ">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" id="cardLoginRegister">
          <div class="card-body">
            <div class="row justify-content-center">
              <ul class="nav nav-pills d-flex justify-content-center align-items-center" id="pills-tab" role="tablist">
                <li class="nav-item text-center ">
                  <a class="nav-link active btl fs-6" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                    role="tab" aria-controls="pills-home" aria-selected="true">Login</a>
                </li>
                <li class="nav-item text-center">
                  <a class="nav-link btr fs-6" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                    role="tab" aria-controls="pills-profile" aria-selected="false">Signup</a>
                </li>
              </ul>
              <form action="">
                <div class="tab-content" id="pills-tabContent">
                  <div class="tab-pane fade show active " id="pills-home" role="tabpanel"
                    aria-labelledby="pills-home-tab">

                    <div class="form px-4 my-5">
                      <label for="#" class="inputTex">Email </label>
                      <input type="text" name="" class="form-control my-3" placeholder="Email" id="login-email">

                      <label for="#" class="inputTex">Password</label>
                      <input type="password" name="" class="form-control my-3" placeholder="Password"
                        id="login-password">

                      <button class="btn btn-dark btn-block my-3" id="login-btn" type="button">Login</button>
                    </div>
                  </div>

                  <div class="tab-pane fade my-5" id="pills-profile" role="tabpanel"
                    aria-labelledby="pills-profile-tab">
                    <div class="form px-4 ">
                      <label for="#" class="inputTex">Your name</label>
                      <input type="text" name="" class="form-control my-3" placeholder="Name">

                      <label for="#" class="inputTex">Email</label>
                      <input type="text" name="" class="form-control my-3" placeholder="Email" id="signup-email">

                      <label for="#" class="inputTex">Password</label>
                      <input type="password" name="" class="form-control my-3" placeholder="Password"
                        id="signup-password">

                      <label for="#" class="inputTex">Confirm Password</label>
                      <input type="password" name="" class="form-control my-3" placeholder="Confirm Password"
                        id="signup-conpassword">

                      <button class="btn btn-dark btn-block" id="signup-btn" type="button">Signup</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>

<?php
include_once("view/login-register-controller.php");
include_once("component/footer.php");
?>